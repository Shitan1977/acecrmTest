<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_produzione extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;
    public $translations;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();

        // Costruisce il percorso completo al file di traduzione e lo carica
        $translationsPath = $_SERVER["DOCUMENT_ROOT"] . '/languages/' . ($_SESSION['selectedLanguage'] ?? 'it') . '.php';
        if (file_exists($translationsPath)) {
            $this->translations = require $translationsPath;
        } else {
            die("Il file di traduzione non esiste: $translationsPath");
        }
    }

    public function incremento() {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.produzione ORDER BY idProd desc"))
            ;
        if ($this->db->RowCount() > 0) {
            $prod = $this->db->Row();
            $nOrdine = ++$prod->nOrdine;
        } else {
            $nOrdine = 1;
        }

        $this->gestCliente($nOrdine);
    }

    public function gestCliente($nOrdine) {

        $input = $_POST['nominativo'];

        $parts = explode(' ', $input, 2); // Divide la stringa in base allo spazio

        $nome = $parts[0] ?? null;
        $cognome = $parts[1] ?? null;

        if (!is_null($nome) && !is_null($cognome)) {

            // Assumendo che $this->db sia un'istanza di PDO o di un wrapper che supporta le dichiarazioni preparate
            $sql = "SELECT idAnagrafica FROM {$this->tabella}.anagrafica WHERE nome = '$nome' AND cognome = '$cognome'";

            // Esegue la query con i parametri
            $this->db->Query($sql);
            $clienteProd = $this->db->Row();

            $this->gestioneProduzione($nOrdine, $clienteProd->idAnagrafica);
        }
    }

    public function gestioneProduzione($nOrdine, $idAnagrafica) {

        $insPr['nOrdine'] = MySQL::SQLValue($nOrdine, MySQL::SQLVALUE_TEXT);
        $insPr['idCliente'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        $insPr['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insPr['dataEvento'] = MySQL::SQLValue($_POST['dataEvento'], MySQL::SQLVALUE_DATE);
        $insPr['ClienteCommissionario'] = MySQL::SQLValue($_POST['ClienteCommissionario'], MySQL::SQLVALUE_TEXT);
        if (!empty($_POST['idProd'])) {
            $updSer['idProd'] = MySQL::SQLValue($_POST['idProd'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.produzione', $insPr, $updSer))
                echo $this->db->Kill();
        } else {

            if (!$this->db->InsertRow($this->tabella . '.produzione', $insPr))
                echo $this->db->Kill();
        }
    }

    public function deleteProduzione() {
        $delSer['idProd'] = MySQL::SQLValue($_POST['deleteProd'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.produzione', $delSer))
            echo $this->db->Kill();
    }

    public function gestioneMisure() {
        $insMisure['circonferenzaTesta'] = MySQL::SQLValue($_POST['circonferenzaTesta'], MySQL::SQLVALUE_TEXT);
        $insMisure['profonditaScollatura'] = MySQL::SQLValue($_POST['profonditaScollatura'], MySQL::SQLVALUE_TEXT);
        $insMisure['altezzaVita'] = MySQL::SQLValue($_POST['altezzaVita'], MySQL::SQLVALUE_TEXT);
        $insMisure['altezzaVitaDietro'] = MySQL::SQLValue($_POST['altezzaVitaDietro'], MySQL::SQLVALUE_TEXT);
        $insMisure['distanzaSeni'] = MySQL::SQLValue($_POST['distanzaSeni'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaSottoSeno'] = MySQL::SQLValue($_POST['circonferenzaSottoSeno'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaSeni'] = MySQL::SQLValue($_POST['circonferenzaSeni'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaFianchi'] = MySQL::SQLValue($_POST['circonferenzaFianchi'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaVita'] = MySQL::SQLValue($_POST['circonferenzaVita'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaBacino'] = MySQL::SQLValue($_POST['circonferenzaBacino'], MySQL::SQLVALUE_TEXT);
        $insMisure['altezzaVitaInizio'] = MySQL::SQLValue($_POST['altezzaVitaInizio'], MySQL::SQLVALUE_TEXT);
        $insMisure['inizioSpaccoGonna'] = MySQL::SQLValue($_POST['inizioSpaccoGonna'], MySQL::SQLVALUE_TEXT);
        $insMisure['giroSpallaCompleto'] = MySQL::SQLValue($_POST['giroSpallaCompleto'], MySQL::SQLVALUE_TEXT);
        $insMisure['larghezzaTrattoSchiena'] = MySQL::SQLValue($_POST['larghezzaTrattoSchiena'], MySQL::SQLVALUE_TEXT);
        $insMisure['larghezzaSottoAscella'] = MySQL::SQLValue($_POST['larghezzaSottoAscella'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaGlutei'] = MySQL::SQLValue($_POST['circonferenzaGlutei'], MySQL::SQLVALUE_TEXT);
        $insMisure['lunghezzaBraccio'] = MySQL::SQLValue($_POST['lunghezzaBraccio'], MySQL::SQLVALUE_TEXT);
        $insMisure['circonferenzaPolso'] = MySQL::SQLValue($_POST['circonferenzaPolso'], MySQL::SQLVALUE_TEXT);
        $insMisure['altezzaCavalloDietro'] = MySQL::SQLValue($_POST['altezzaCavalloDietro'], MySQL::SQLVALUE_TEXT);
        $insMisure['lunghezzaGonna'] = MySQL::SQLValue($_POST['lunghezzaGonna'], MySQL::SQLVALUE_TEXT);
        $insMisure['modelloCorsetto'] = MySQL::SQLValue($_POST['modelloCorsetto'], MySQL::SQLVALUE_TEXT);
        $insMisure['tessutoCorsetto'] = MySQL::SQLValue($_POST['tessutoCorsetto'], MySQL::SQLVALUE_TEXT);
        $insMisure['modelloGonna'] = MySQL::SQLValue($_POST['modelloGonna'], MySQL::SQLVALUE_TEXT);
        $insMisure['tessutoGonna'] = MySQL::SQLValue($_POST['tessutoGonna'], MySQL::SQLVALUE_TEXT);
        $insMisure['idProd'] = MySQL::SQLValue($_POST['dett'], MySQL::SQLVALUE_TEXT);
        if (!empty($_POST['idMisure'])) {
            $updMis['idMisure'] = MySQL::SQLValue($_POST['idMisure'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.produzioneMisure', $insMisure, $updMis))
                echo $this->db->Kill();
        } else {

            if (!$this->db->InsertRow($this->tabella . '.produzioneMisure', $insMisure))
                echo $this->db->Kill();
        }
        $this->messaggioBello($prova = true, 'gestione-produzioneMisure.php', $_POST['dett'], $_POST['idMisure'], 'produzioneMisure');
    }

    public function prodDettaglio() {
        $insMisureDett['idProdD'] = MySQL::SQLValue($_POST['idProdD'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['modello'] = MySQL::SQLValue($_POST['modello'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['taglia'] = MySQL::SQLValue($_POST['taglia'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['tessuto'] = MySQL::SQLValue($_POST['tessuto'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['trasparenza'] = MySQL::SQLValue($_POST['trasparenza'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['chiusura'] = MySQL::SQLValue($_POST['chiusura'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['stecche'] = MySQL::SQLValue($_POST['stecche'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['idProd'] = MySQL::SQLValue($_POST['dettProduzione'], MySQL::SQLVALUE_TEXT);
        $insMisureDett['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);

        if (!empty($_POST['idProdD'])) {
            $updMisDett['idProdD'] = MySQL::SQLValue($_POST['idProdD'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.produzioneDettaglio', $insMisureDett, $updMisDett))
                echo $this->db->Kill();
        } else {

            if (!$this->db->InsertRow($this->tabella . '.produzioneDettaglio', $insMisureDett))
                echo $this->db->Kill();
        }
    }

    public function deleteDettaglio() {
        $delMisureDett['idProdD'] = MySQL::SQLValue($_POST['cancellaDett'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.produzioneDettaglio', $delMisureDett))
            echo $this->db->Kill();
    }

    public function messaggioBello($prova, $pagina, $dett, $idMisure, $formId, $currentTabId = null) {
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
            '<input type=\"hidden\" name=\"dett\" value=\"" . $dett . "\">' +
            '<input type=\"hidden\" name=\"idMisure\" value=\"" . $idMisure . "\">' +
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
}
