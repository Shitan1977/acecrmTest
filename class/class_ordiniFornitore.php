<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_ordiniFornitore extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function controlloFornitore($idProdotto, $quantita, $idFornitore) {

        $this->db->Query("SELECT * FROM $this->tabella.carrello_ordini where evaso=0");
        if ($this->db->RowCount() > 0) {

            $nOrdine = $this->db->Row();

            $this->invioFornitore($idFornitore, $idProdotto, $quantita, $nOrdine->ordine);
        } else {
            $this->db->Query("SELECT * FROM $this->tabella.carrello_ordini where evaso=1 ORDER BY idOrdine DESC");
            if ($this->db->RowCount() > 0) {

                $numero = $this->db->Row();
                $numero->ordine++;

                $this->invioFornitore($idFornitore, $idProdotto, $quantita, $nOrdine->ordine);
            } else {
                $nOrdine = 0;
                $this->invioFornitore($idFornitore, $idProdotto, $quantita, $nOrdine);
            }
        }
    }

    public function invioFornitore($idFornitore, $idProdotto, $quantita, $nOrdine) {
        $forn['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
        $forn['idFornitore'] = MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_TEXT);
        $forn['quantita'] = MySQL::SQLValue($quantita, MySQL::SQLVALUE_TEXT);
        $forn['ordine'] = MySQL::SQLValue($nOrdine, MySQL::SQLVALUE_TEXT);
        $forn['evaso'] = MySQL::SQLValue(0, MySQL::SQLVALUE_TEXT);
        $forn['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        if (!$this->db->InsertRow($this->tabella . ".carrello_ordini", $forn))
            ;
    }

    public function conteggioPrezziFornitore($ordine) {
        $this->db->Query("SELECT sum(d.prezzoF) as somma FROM $this->tabella.carrello_ordini as o inner join $this->tabella.prodotto as p on p.idProdotto=o.idProdotto inner join $this->tabella.dettList as d on d.idProdotto=p.idProdotto where ordine=$ordine");

        $conteggio = $this->db->Row();
        echo $conteggio->somma;
    }

    public function accettazione($idFornitore, $ordine) {
        $updFormF['ordine'] = MySQL::SQLValue($ordine, MySQL::SQLVALUE_TEXT);
        $updForm['evaso'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $updForm['idFornitore'] = MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . ".carrello_ordini", $updForm, $updFormF))
            ;
        $this->datiFornitore($ordine);
    }

    public function datiFornitore($ordine) {

        $this->db->Query("SELECT * FROM $this->tabella.carrello_ordini as c INNER JOIN $this->tabella.fornitori as f ON c.idFornitore=f.idFornitori WHERE ordine='{$ordine}'");
        $fornitore = $this->db->Row();

        $this->invioEmail($fornitore->email, $fornitore->fornitore, $ordine);
    }

    public function invioEmail($email, $fornitore, $ordine) {
        $userEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        $userMessage = "
  <html>
    <head>
      <title>Gentile $fornitore </title>
    </head>
    <body>
      <h1>Richiesta ordine n. $ordine</h1>";
        $userMessage .= "<table>";
        $userMessage .= "<tr>";

        $this->db->Query("SELECT * FROM $this->tabella.carrello_ordini as c INNER JOIN $this->tabella.prodotto as p ON c.idProdotto=p.idProdotto WHERE ordine='{$ordine}'");
        while ($prod = $this->db->Row()) {
            $userMessage .= "<td>Prodotto richiesto :$prod->prodotto</td>";
            $userMessage .= "<td>Quantità richiesta : $prod->quantita</td>";
        }
        $userMessage .= "
            </tr>
            </table>   
    </body>
  </html>
";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        mail($userEmail, "Richiesta di Ordine $ordine", $userMessage, implode("\r\n", $headers));
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function rifornimentoOttenuto($ordine) {
        $riforn['evaso'] = MySQL::SQLValue(2, MySQL::SQLVALUE_TEXT);
        $rifornF['ordine'] = MySQL::SQLValue($ordine, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . ".carrello_ordini", $riforn, $rifornF))
            ;
        $this->messaggio();
    }

    public function cancellaProdottiOridne($idProdotto) {
        $canc['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
      
        if (!$this->db->DeleteRows($this->tabella . ".carrello_ordini", $canc))
            ;
        $this->messaggio();
    }

}
