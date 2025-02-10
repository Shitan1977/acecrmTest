<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_ordiniBanco extends MySQL {

    private $tabella;
    public $db;
    public $prezzo;
    public $nordine;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insOrdiniBanco($idCliente = null, $barcode, $quantita) {

        $this->db->Query("SELECT *  FROM $this->tabella.ordineBanco");

        if ($this->db->RowCount() > 0) {
            $this->db->Query("SELECT *  FROM $this->tabella.ordineBanco where evaso=0 ORDER BY idOrdineBanco DESC ");
            if ($this->db->RowCount() > 0) {
                $evadi = $this->db->Row();
                $ordine = $evadi->ordine;
                $evaso = 0;

                $this->insOrdine($idCliente = null, $barcode, $quantita, $evaso, $ordine);
            } else {
                $this->db->Query("SELECT *  FROM $this->tabella.ordineBanco where evaso=1 ORDER BY idOrdineBanco DESC ");
                $evadi = $this->db->Row();
                $ordine = $evadi->ordine;
                $ordine += 1;

                $evaso = 0;
                $this->insOrdine($idCliente = null, $barcode, $quantita, $evaso, $ordine);
            }
        } else {

            $this->origine($idCliente = null, $barcode, $quantita);
        }
    }

    public function origine($idCliente = null, $barcode, $quantita) {
        $ordine = 1;
        $evaso = 0;

        $this->insOrdine($idCliente = null, $barcode, $quantita, $evaso, $ordine);
    }

    public function insOrdine($idCliente = null, $barcode, $quantita, $evaso, $ordine) {

        $insOrd['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);
        $insOrd['idCliente'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $insOrd['qnt'] = MySQL::SQLValue($quantita, MySQL::SQLVALUE_TEXT);
        $insOrd['dataCreazione'] = MySQL::SQLValue(date('y-m-d'), MySQL::SQLVALUE_TEXT);
        $insOrd['evaso'] = MySQL::SQLValue($evaso, MySQL::SQLVALUE_TEXT);
        $insOrd['ordine'] = MySQL::SQLValue($ordine, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.ordineBanco', $insOrd))
            echo $this->db->Kill();
    }

    public function cancellaBanco($idOrdineBanco) {
        $cancOrd['idOrdineBanco'] = MySQL::SQLValue($idOrdineBanco, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.ordineBanco', $cancOrd))
            echo $this->db->Kill();
    }

    # Diminuzione delle quantità

    public function diminuireQUantita($idOperatore, $nordine, $prezzo, $idAzienda) {

        $this->db->Query("SELECT *  FROM $this->tabella.ordineBanco as o inner join $this->tabella.prodotto as p on p.barcode=o.barcode where evaso=0 and ordine=$nordine");
        while ($minqnt = $this->db->Row()) {

            $this->dimq($idOperatore, $nordine, $prezzo, $minqnt->qyt, $minqnt->qnt, $minqnt->barcode, $idAzienda);
        }
    }

    public function dimq($idOperatore, $nordine, $prezzo, $qyt, $qnt, $barcode, $idAzienda) {
        $dim = $qyt - $qnt;
        $updProd['qyt'] = MySQL::SQLValue($dim, MySQL::SQLVALUE_TEXT);
        $updProdF['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.prodotto', $updProd, $updProdF))
            echo $this->db->Kill();
        $this->updateBanco($idOperatore, $nordine, $prezzo, $idAzienda);
    }

    public function updateBanco($idOperatore, $nordine, $prezzo, $idAzienda) {

        $aggOrd['evaso'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $aggOrdF['evaso'] = MySQL::SQLValue(0, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.ordineBanco', $aggOrd, $aggOrdF))
            echo $this->db->Kill();
        $this->cassaAggio($idOperatore, $nordine, $prezzo, $idAzienda);
    }

    public function prezzoCalc($prezzo, $nordine) {

        $this->prezzo = $prezzo;
        $this->nordine = $nordine;
    }

    public function cassaAggio($idOperatore, $nordine, $prezzo, $idAzienda) {
        $updCassa['Descrizione'] = MySQL::SQLValue("numero di ordine  $nordine", MySQL::SQLVALUE_TEXT);
        $updCassa['entrate'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);
        $updCassa['idOperatore'] = MySQL::SQLValue($idOperatore, MySQL::SQLVALUE_TEXT);
        $updCassa['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $updCassa['dataIncasso'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($this->tabella . '.cassa', $updCassa))
            echo $this->db->Kill();
    }

    #ordine totale

    public function ordineTotale() {
        $this->db->Query("SELECT 
    SUM(o.qnt * COALESCE(d.prezzo, 0)) AS tot 
FROM 
    {$_SESSION['tabella']}.ordineBanco AS o 
INNER JOIN 
    {$_SESSION['tabella']}.prodotto AS p ON p.barcode = o.barcode 
    OR p.idProdotto IN (
        SELECT idProdotto 
        FROM {$_SESSION['tabella']}.variantiProdotti 
        WHERE barcode = o.barcode
    )
LEFT JOIN 
    {$_SESSION['tabella']}.variantiProdotti AS vari ON vari.barcode = o.barcode 
LEFT JOIN 
    {$_SESSION['tabella']}.dettList AS d ON COALESCE(vari.idProdotto, p.idProdotto) = d.idProdotto 
LEFT JOIN 
    {$_SESSION['tabella']}.listini AS l ON l.idListino = d.idListino 
LEFT JOIN 
    {$_SESSION['tabella']}.anagrafica AS a ON a.idAnagrafica = o.idCliente 
WHERE 
    evaso = 0;");
        $totali = $this->db->Row();
        return $totali->tot;
    }

    #sconto

    public function scontoOrdine($sconto) {

        $this->db->Query("SELECT ordine from {$_SESSION['tabella']}.ordineBanco as o where evaso=0");
        $ordine = $this->db->Row();

        $this->insSconto($sconto, $ordine->ordine);
    }

    public function insSconto($sconto, $ordine) {
        $this->db->Query("SELECT * from {$_SESSION['tabella']}.ordineBanco as o INNER JOIN {$_SESSION['tabella']}.scontoProdotti as p on o.ordine=p.ordine where evaso=0");
        if ($this->db->RowCount() > 0) {
            echo "<script>alert('Sconto già presente')</script>";
        } else {
            $scontos['perentualeSconto'] = MySQL::SQLValue($sconto, MySQL::SQLVALUE_TEXT);
            $scontos['ordine'] = MySQL::SQLValue($ordine, MySQL::SQLVALUE_TEXT);
            $scontos['sconto'] = MySQL::SQLValue($_POST['importoScontatoHidden'], MySQL::SQLVALUE_TEXT);
            $scontos['totaleImporto'] = MySQL::SQLValue($_POST['importoTotaleHidden'], MySQL::SQLVALUE_TEXT);
            $scontos['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
            if (!$this->db->InsertRow($this->tabella . '.scontoProdotti', $scontos))
                echo $this->db->Kill();
        }
    }

    public function visSconto($prezzo) {

        $this->db->Query("SELECT * from {$_SESSION['tabella']}.ordineBanco as o INNER JOIN {$_SESSION['tabella']}.scontoProdotti as p on o.ordine=p.ordine where evaso=0");
        $scon = $this->db->Row();

        return $prezzo - ($prezzo * $scon->sconto) / 100;
    }

    public function modSconto() {

        $this->db->Query("SELECT * from {$_SESSION['tabella']}.ordineBanco as o INNER JOIN {$_SESSION['tabella']}.scontoProdotti as p on o.ordine=p.ordine where evaso=0");
        $sconti = $this->db->Row();
        echo $sconti->sconto;
    }

    public function cancoloIva($prezzo) {
        return $prezzo;
    }

    public function caricoProdotti($barcode, $carico) {

        $this->db->Query("SELECT * from {$_SESSION['tabella']}.prodotto  where barcode='{$barcode}'");
        if($this->db->RowCount()>0){
            $caricos = $this->db->Row();
        $this->updCarico($caricos->qyt, $barcode, $carico);
        }else{
            $this->db->Query("SELECT * from {$_SESSION['tabella']}.variantiProdotti  where barcode='{$barcode}'");  
            $caricosv = $this->db->Row();
            $this->updCaricoVarianti($caricosv->quantita, $barcode, $carico);
        }
        
    }

    public function updCarico($qnt, $barcode, $carico) {
        if ($carico == 1) {
            $car['qyt'] = MySQL::SQLValue($qnt - 1, MySQL::SQLVALUE_TEXT);
        } else {
            $car['qyt'] = MySQL::SQLValue($qnt + 1, MySQL::SQLVALUE_TEXT);
        }
        $carf['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.prodotto', $car, $carf))
            echo $this->db->Kill();

        $this->messaggio2();
    }

    public function updCaricoVarianti($qnt, $barcode, $carico) {
        if ($carico == 1) {
            $car['quantita'] = MySQL::SQLValue($qnt - 1, MySQL::SQLVALUE_TEXT);
        } else {
            $car['quantita'] = MySQL::SQLValue($qnt + 1, MySQL::SQLVALUE_TEXT);
        }
        $carf['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.variantiProdotti', $car, $carf))
            echo $this->db->Kill();

        $this->messaggio2();
    }
    
    
    
    public function messaggio() {
        echo "<script>
    Swal.fire({
        title: 'Successo!',
        text: 'Aggiornamento riuscito con successo.',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
    </script>";
    }

    public function messaggio2() {
        echo "<script>alert('aggiornamento riuscito') </script>";
    }
}
