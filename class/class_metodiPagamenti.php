<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_metodiPagamenti extends MySQL {

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

    public function gestMetodi() {
        $gMet['metodo'] = MySQL::SQLValue($_POST['metodo'], MySQL::SQLVALUE_TEXT);
        $gMet['tempo'] = MySQL::SQLValue($_POST['tempo'], MySQL::SQLVALUE_TEXT);
       
        $gMet['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);

        if (!empty($_POST['idMetodo'])) {
            $gFMet['idMetodo'] = MySQL::SQLValue($_POST['idMetodo'], MySQL::SQLVALUE_TEXT);
            $gCMet['idMetodo'] = MySQL::SQLValue($_POST['cancella'], MySQL::SQLVALUE_TEXT);
            
            if (!empty($_POST['cancella'])) {
                
                if (!$this->db->DeleteRows($this->tabella . '.metodiPatamento',$gCMet)) {
                    echo $this->db->Kill();
                }
             
            } else {
                if (!$this->db->UpdateRows($this->tabella . '.metodiPatamento', $gMet, $gFMet)) {
                    echo $this->db->Kill();
                }
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.metodiPatamento', $gMet)) {
                echo $this->db->Kill();
            }
        }
        $this->messaggio();
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
        public function selectMetodo($idMetodo = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.metodiPatamento"))
            ;
        while ($estremo = $this->db->Row()) {
            echo "<option value='{$estremo->idMetodo}'";
            if ($idMetodo == $estremo->idMetodo) {
                echo 'selected';
            }
            echo ">{$estremo->metodo}</option>";
        }
    }
}
