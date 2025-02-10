<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_tour extends MySQL {

    private $tabella;
    public $db;
    public $tour;

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

    public function gestTour($idStruttura = null, $titolo, $costoTour, $nPersone, $durata, $partenza, $puntoIncontro, $commissioneUfficio, $commissioneTour, $commissioneFornitore, $file_name, $file_tmp, $idAzienda, $tipologia, $idCategorie, $idtour = null) {

        $file_dir = "tour_image/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }

        $gtourF['idtour'] = MySQL::SQLValue($idtour, MySQL::SQLVALUE_TEXT);
        $gtour['idStruttura'] = MySQL::SQLValue($idStruttura, MySQL::SQLVALUE_TEXT);
        if (!empty($titolo)) {
            $gtour['titolo'] = MySQL::SQLValue($titolo, MySQL::SQLVALUE_TEXT);
        }
        $gtour['costoTour'] = MySQL::SQLValue($costoTour, MySQL::SQLVALUE_TEXT);
        $gtour['nPersone'] = MySQL::SQLValue($nPersone, MySQL::SQLVALUE_TEXT);
        $gtour['colore'] = MySQL::SQLValue($_POST['colore'], MySQL::SQLVALUE_TEXT);
        $gtour['durata'] = MySQL::SQLValue($durata, MySQL::SQLVALUE_TEXT);
        $gtour['partenza'] = MySQL::SQLValue($partenza, MySQL::SQLVALUE_TIME);
        $gtour['puntoIncontro'] = MySQL::SQLValue($puntoIncontro, MySQL::SQLVALUE_TEXT);
        $gtour['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $gtour['nPersone'] = MySQL::SQLValue($nPersone, MySQL::SQLVALUE_TEXT);
        $gtour['commissioneUfficio'] = MySQL::SQLValue($commissioneUfficio, MySQL::SQLVALUE_TEXT);
        $gtour['commissioneTour'] = MySQL::SQLValue($commissioneTour, MySQL::SQLVALUE_TEXT);
        $gtour['commissioneFornitore'] = MySQL::SQLValue($commissioneFornitore, MySQL::SQLVALUE_TEXT);
        if (!empty($file_name)) {
            $gtour['avatar'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        }
        $gtour['tipologia'] = MySQL::SQLValue($tipologia, MySQL::SQLVALUE_TEXT);
        $gtour['idCategorie'] = MySQL::SQLValue($idCategorie, MySQL::SQLVALUE_TEXT);
        $gtour['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        if (!empty($idtour)) {
            if (!$this->db->UpdateRows($this->tabella . '.tour', $gtour, $gtourF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.tour', $gtour))
                echo $this->db->Kill();
        }
        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }
    }

    public function deltour($idtour) {
        $gtourFS['idtour'] = MySQL::SQLValue($idtour, MySQL::SQLVALUE_TEXT);

        if (!$this->db->DeleteRows($this->tabella . '.tour', $gtourFS)) {
            echo $this->db->Kill();
        }
    }

    public function descrizioneWeb($tour, $descrizione) {

        $gtourFF['idtour'] = MySQL::SQLValue($tour, MySQL::SQLVALUE_TEXT);
        $dett = htmlspecialchars($descrizione, ENT_QUOTES, 'UTF-8');
        $gtourS['descrizione'] = MySQL::SQLValue($dett, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.tour', $gtourS, $gtourFF))
            echo $this->db->Kill();
        $this->ric($tour);
    }

    public function ric($tour) {
        $this->tour = $tour;
    }

    public function duplicazione($idtour) {
        $this->db->Query("SELECT * from {$_SESSION['tabella']}.tour where idtour={$idtour}");
        $dup = $this->db->Row();
        $this->insDupli($dup->idStruttura, $dup->titolo, $dup->descrizione, $dup->costoTour, $dup->durata, $dup->partenza, $dup->puntoIncontro, $dup->nPersone, $dup->commissioneUfficio, $dup->commissioneTour, $dup->avatar, $dup->commissioneFornitore, $dup->tipologia, $dup->idCategorie);
    }

    public function insDupli($idStruttura, $titolo, $descrizione, $costoTour, $durata, $partenza, $puntoIncontro, $nPersone, $commissioneUfficio, $commissioneTour, $avatar, $commissioneFornitore, $tipologia, $idCategorie) {
        $gtour['idStruttura'] = MySQL::SQLValue($idStruttura, MySQL::SQLVALUE_TEXT);
        $gtour['titolo'] = MySQL::SQLValue($titolo, MySQL::SQLVALUE_TEXT);
        $gtour['costoTour'] = MySQL::SQLValue($costoTour, MySQL::SQLVALUE_TEXT);
        $gtour['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $gtour['nPersone'] = MySQL::SQLValue($nPersone, MySQL::SQLVALUE_TEXT);
        $gtour['durata'] = MySQL::SQLValue($durata, MySQL::SQLVALUE_TEXT);
        $gtour['partenza'] = MySQL::SQLValue($partenza, MySQL::SQLVALUE_TIME);
        $gtour['puntoIncontro'] = MySQL::SQLValue($puntoIncontro, MySQL::SQLVALUE_TEXT);
        $gtour['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $gtour['nPersone'] = MySQL::SQLValue($nPersone, MySQL::SQLVALUE_TEXT);
        $gtour['commissioneUfficio'] = MySQL::SQLValue($commissioneUfficio, MySQL::SQLVALUE_TEXT);
        $gtour['commissioneTour'] = MySQL::SQLValue($commissioneTour, MySQL::SQLVALUE_TEXT);
        $gtour['commissioneFornitore'] = MySQL::SQLValue($commissioneFornitore, MySQL::SQLVALUE_TEXT);
        $gtour['avatar'] = MySQL::SQLValue($avatar, MySQL::SQLVALUE_TEXT);
        $gtour['tipologia'] = MySQL::SQLValue($tipologia, MySQL::SQLVALUE_TEXT);
        $gtour['idCategorie'] = MySQL::SQLValue($idCategorie, MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($this->tabella . '.tour', $gtour))
            echo $this->db->Kill();
    }

    public function gestioneLingue() {
        $ltour['idTour'] = MySQL::SQLValue($_POST['tour'], MySQL::SQLVALUE_TEXT);
        $ltour['titolo'] = MySQL::SQLValue($_POST['titolo'], MySQL::SQLVALUE_TEXT);
        $ltour['descrizione'] = MySQL::SQLValue($_POST['descrizione'], MySQL::SQLVALUE_TEXT);
        $ltour['durata'] = MySQL::SQLValue($_POST['durata'], MySQL::SQLVALUE_TEXT);
        $ltour['lingua'] = MySQL::SQLValue($_POST['idLingue'], MySQL::SQLVALUE_TEXT);
        if (!empty($_POST['idtour_lingue'])) {
            $lftour['idtour_lingue'] = MySQL::SQLValue($_POST['idtour_lingue'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.tour_lingue', $ltour, $lftour))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.tour_lingue', $ltour))
                echo $this->db->Kill();
        }
        $this->messaggioBello($prova = true, $pagina = 'gestione-tour-lingue.php', $_POST['tour'], $_POST['idLingue'], "tourlingue");
    }

    public function messaggioBello($prova, $pagina, $tour, $idLingue, $formId, $currentTabId = null) {
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
            '<input type=\"hidden\" name=\"tour\" value=\"" . $tour . "\">' +
            '<input type=\"hidden\" name=\"idLingue\" value=\"" . $idLingue . "\">' +
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

    public function selectTour($idtour = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.tour"))
            ;
        while ($tour = $this->db->Row()) {
            echo "<option value='{$tour->idtour}'";
            if ($idtour == $tour->idtour) {
                echo 'selected';
            }
            echo ">{$tour->titolo}</option>";
        }
    }
}
