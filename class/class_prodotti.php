<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_prodotti extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
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

    public function prodottiInsert($prodotto, $idMarca, $qyt, $idCategorie, $descrizione, $condizioni, $barcode, $idLotto, $idProdotto = null) {

        $prodot['prodotto'] = MySQL::SQLValue($prodotto, MySQL::SQLVALUE_TEXT);
        $prodot['idMarca'] = MySQL::SQLValue($idMarca, MySQL::SQLVALUE_TEXT);
        $prodot['qyt'] = MySQL::SQLValue($qyt, MySQL::SQLVALUE_TEXT);
        $prodot['idCategorie'] = MySQL::SQLValue($idCategorie, MySQL::SQLVALUE_TEXT);
        $prodot['condizioni'] = MySQL::SQLValue($condizioni, MySQL::SQLVALUE_TEXT);
        if (empty($barcode)) {
            $this->generatoreBarcode();
            $this->calcolaCifraControlloEAN13($this->barcodeGenerato);
            $barcodeCompleto = $this->barcodeGenerato . $this->check;
            $prodot['barcode'] = MySQL::SQLValue($barcodeCompleto, MySQL::SQLVALUE_TEXT);
        } else {
            $prodot['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);
        }

        $prodot['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        $prodot['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $prodot['idNegozio'] = MySQL::SQLValue($_POST['idNegozio'], MySQL::SQLVALUE_TEXT);
        $prodot['idLotto'] = MySQL::SQLValue($idLotto, MySQL::SQLVALUE_TEXT);
        if (!empty($idProdotto)) {
            $prodF['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows("$this->tabella.prodotto", $prodot, $prodF))
                ;
        } else {
            if (!$this->db->InsertRow("$this->tabella.prodotto", $prodot))
                ;
        }

        @header('header:gestione-prodotto.php');
    }

    public function generatoreBarcode() {
        $comb = '1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $this->barcodeGenerato = implode($pass);
    }

    // Metodo per calcolare la cifra di controllo EAN-13
    public function calcolaCifraControlloEAN13($barcode) {
        $somma = 0;
        for ($i = 0; $i < 12; $i++) {
            $somma += $barcode[$i] * ($i % 2 == 0 ? 1 : 3);
        }
        $cifraControllo = (10 - $somma % 10) % 10;
        $this->check = $cifraControllo;
    }

# carrello prodotti

    public function carrelloProdotti() {
        $this->db->Query("SELECT count(*) as totale FROM $this->tabella.carrello_online");
        $cont = $this->db->Row();
        echo $cont->totale;
    }

    public function carrelloProdottiTot() {
        $this->db->Query("SELECT count(*) as totale FROM $this->tabella.prodotto");
        $cont = $this->db->Row();
        echo $cont->totale;
    }

    public function sincronizzazioneProdotti($idProdotto) {
        $web['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
        $web['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        if (!$this->db->InsertRow("$this->tabella.carrello_online", $web))
            ;
        $this->messaggio();
    }

#cancellazione prodotti

    public function delProdotti($idProdotto) {
        $delProd['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows("$this->tabella.prodotto", $delProd))
            ;
    }

    public function duplica() {
        $this->db->Query("SELECT * from {$_SESSION['tabella']}.prodotto where idProdotto={$_POST['duplica']}");
        $duplicaP = $this->db->Row();
        $this->insDuplicaProdotto($duplicaP->prodotto, $duplicaP->idMarca, $duplicaP->qyt, $duplicaP->idCategorie, $duplicaP->descrizione, $duplicaP->condizioni, $duplicaP->barcode, $duplicaP->idLotto);
    }

    public function insDuplicaProdotto($prodotto, $idMarca, $qyt, $idCategorie, $descrizione, $condizioni, $barcode, $idLotto) {
        $prodot['prodotto'] = MySQL::SQLValue($prodotto, MySQL::SQLVALUE_TEXT);
        $prodot['idMarca'] = MySQL::SQLValue($idMarca, MySQL::SQLVALUE_TEXT);
        $prodot['qyt'] = MySQL::SQLValue($qyt, MySQL::SQLVALUE_TEXT);
        $prodot['idCategorie'] = MySQL::SQLValue($idCategorie, MySQL::SQLVALUE_TEXT);
        $prodot['condizioni'] = MySQL::SQLValue($condizioni, MySQL::SQLVALUE_TEXT);
        if (empty($barcode)) {
            $this->generatoreBarcode();
            $this->calcolaCifraControlloEAN13($this->barcodeGenerato);
            $barcodeCompleto = $this->barcodeGenerato . $this->check;
            $prodot['barcode'] = MySQL::SQLValue($barcodeCompleto, MySQL::SQLVALUE_TEXT);
        } else {
            $prodot['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);
        }

        $prodot['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        $prodot['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $prodot['idLotto'] = MySQL::SQLValue($idLotto, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow("$this->tabella.prodotto", $prodot))
            ;
    }

    // inserimento varianti
    public function Insvarianti() {
		
        if (!empty($_POST['colore']) && is_array($_POST['colore'])) {
            // Cicla attraverso gli array dei dati inviati dal form
            for ($i = 0; $i < count($_POST['colore']); $i++) {
                // Controlla se è stata richiesta la cancellazione per l'indice corrente
                if (isset($_POST['cancella'][$i]) && $_POST['cancella'][$i] == 'si') {
                    if (!empty($_POST['idVarianti'][$i])) {
                        $variantiF = ['idVariante' => MySQL::SQLValue($_POST['idVarianti'][$i], MySQL::SQLVALUE_TEXT)];

                        if (!$this->db->DeleteRows("$this->tabella.variantiProdotti", $variantiF)) {
                            echo "Errore nella cancellazione: " . $this->db->Kill();
                        }
                    }
                    continue; // Passa alla prossima iterazione del ciclo, ignorando l'inserimento/aggiornamento
                }

                // Prepara l'array delle varianti per l'inserimento o l'aggiornamento
                $varianti = [
                    'idProdotto' => MySQL::SQLValue($_POST['variante'], MySQL::SQLVALUE_TEXT),
                    'colore' => MySQL::SQLValue($_POST['colore'][$i], MySQL::SQLVALUE_TEXT),
                    'taglia' => MySQL::SQLValue($_POST['taglia'][$i], MySQL::SQLVALUE_TEXT),
                    'scarpe' => MySQL::SQLValue($_POST['scarpe'][$i], MySQL::SQLVALUE_TEXT),
                    'cravatte' => MySQL::SQLValue($_POST['cravatte'][$i], MySQL::SQLVALUE_TEXT),
                    'cinture' => MySQL::SQLValue($_POST['cinture'][$i], MySQL::SQLVALUE_TEXT),
                    'materiale' => MySQL::SQLValue($_POST['materiale'][$i], MySQL::SQLVALUE_TEXT),
                    'quantita' => MySQL::SQLValue($_POST['qnt'][$i], MySQL::SQLVALUE_TEXT),
                        // Assumi che 'barcode' sia gestito qui sotto
                ];

                // Gestione del barcode
                if (empty($_POST['barcode'][$i])) {
                    $this->generatoreBarcode(); // Genera un nuovo barcode
                    $this->calcolaCifraControlloEAN13($this->barcodeGenerato); // Calcola la cifra di controllo
                    $barcodeCompleto = $this->barcodeGenerato . $this->check; // Combina il barcode con la sua cifra di controllo
                    $varianti['barcode'] = MySQL::SQLValue($barcodeCompleto, MySQL::SQLVALUE_TEXT);
                } else {
                    $varianti['barcode'] = MySQL::SQLValue($_POST['barcode'][$i], MySQL::SQLVALUE_TEXT);
                }

                // Controlla se esiste un ID variante per decidere tra l'aggiornamento e l'inserimento
                if (!empty($_POST['idVarianti'][$i])) {
                    // Prepara il filtro per l'aggiornamento
                    $variantiF = ['idVariante' => MySQL::SQLValue($_POST['idVarianti'][$i], MySQL::SQLVALUE_TEXT)];

                    if (!$this->db->UpdateRows("$this->tabella.variantiProdotti", $varianti, $variantiF)) {
                        echo "Errore nell'aggiornamento: " . $this->db->Kill();
                    }
                } else {
                    // Esegue l'inserimento

                    if (!$this->db->InsertRow("$this->tabella.variantiProdotti", $varianti)) {
                        echo "Errore nell'inserimento: " . $this->db->Kill();
                    }
                }
            }
            $this->messaggio(); // Assumi che questo metodo mostri un messaggio di successo o di stato
        }
    }

    public function messaggioBello($prova, $pagina, $ordine, $idMasterDocumentale, $formId, $currentTabId = null) {
        // ... il tuo codice PHP ...
        $updateSuccess = $prova; // o false a seconda del risultato
        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include la libreria
        if ($updateSuccess) {
            echo "<script>
Swal.fire({
    title: 'Successo!',
    text: 'Dati aggiornati con successo.',
    icon: 'success',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.value) {
        // Crea un form temporaneo per inviare i dati via POST
        var form = $('<form id=\"" . $formId . "\" action=\"" . $pagina . "\" method=\"post\">' +
            '<input type=\"hidden\" name=\"ordine\" value=\"" . $ordine . "\">' +
            '<input type=\"hidden\" name=\"id_masterDocumentale\" value=\"" . $idMasterDocumentale . "\">' +
                '<input type=\"hidden\" name=\"current_tab_id\" value=\"" . $currentTabId . "\">' +
            '</form>');
        
        // Aggiungi il form al body e invialo
        $('body').append(form);
        form.submit();
    }
});
</script>";
        }
    }

    // select dei prodotti
    public function selectProdottoAuto() {

        $this->db->Query("SELECT  prodotto FROM {$this->tabella}.prodotto Order by prodotto");
        $prodotto = '';
        while ($prod = $this->db->Row()) {

            $prodotto .= '"' . addslashes($prod->prodotto) . '",';
        }
        echo $prodotto;
    }
}
