<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_riunioni extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insProgramma() {

        // vedo se è presente e se è l'anno in corso
        $anno = date('Y');

        if ($this->db->Query("SELECT * FROM {$this->tabella}.v_riunione where year(data)='$anno' order by id desc"))
            ;
        if ($this->db->RowCount() > 0) {
            $progressivoCount = $this->db->Row();

            $progressivo = $progressivoCount->id;
        } else {
            $progressivo = 1;
        }
        // inserisco i dati all'interno della tabella
        $this->insDati($progressivo);
    }

    public function insDati($progressivo) {
        if (!empty($_POST['progressivo'])) {
            $inssDati['id'] = MySQL::SQLValue($_POST['progressivo'], MySQL::SQLVALUE_TEXT);
        } else {
            $inssDati['id'] = MySQL::SQLValue($progressivo, MySQL::SQLVALUE_TEXT);
        }
        $inssDati['id'] = MySQL::SQLValue($progressivo, MySQL::SQLVALUE_TEXT);
        $inssDati['programma'] = MySQL::SQLValue($_POST['programma'], MySQL::SQLVALUE_TEXT);
        $inssDati['oggetto'] = MySQL::SQLValue($_POST['oggetto'], MySQL::SQLVALUE_TEXT);
        $inssDati['luogo'] = MySQL::SQLValue($_POST['luogo'], MySQL::SQLVALUE_TEXT);
        $inssDati['data'] = MySQL::SQLValue($_POST['data'], MySQL::SQLVALUE_DATE);
        $inssDati['firma'] = MySQL::SQLValue($_SESSION['cognome'], MySQL::SQLVALUE_TEXT);
        $fileNames = array();
        foreach ($_FILES["allegati"]["name"] as $filename) {
            $fileNames[] = MySQL::SQLValue($filename, MySQL::SQLVALUE_TEXT);
        }
        $inssDati['allegati'] =  MySQL::SQLValue(implode(',', $fileNames), MySQL::SQLVALUE_TEXT);

        // $inssDati['allegati'] = MySQL::SQLValue($_FILES["allegati"]["name"], MySQL::SQLVALUE_TEXT);
        $inssDati['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        echo "<pre>";
        print_r($inssDati);
        echo "</pre>";
        if (!empty($_POST['id_master'])) {
            $inssDati['updated_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
            $updDati['id_master'] = MySQL::SQLValue($_POST['id_master'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . ".v_riunione", $inssDati, $updDati))
                ;
        } else {
            $inssDati['created_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
            if (!$this->db->InsertRow($this->tabella . ".v_riunione", $inssDati))
                ;
        }
        $this->upLoadfile();
    }

    public function upLoadfile() {
        // Controlla se i file sono stati caricati
        if (isset($_FILES['allegati'])) {
            // Itera su ogni file caricato
            foreach ($_FILES['allegati']['name'] as $key => $name) {
                // Controlla se il file è stato caricato correttamente
                if ($_FILES['allegati']['error'][$key] === UPLOAD_ERR_OK) {
                    $tempName = $_FILES['allegati']['tmp_name'][$key];
                    $originalName = $_FILES['allegati']['name'][$key];
                    $uploadDir = "pdf_riunione/{$_SESSION['idAzienda']}/";

                    // Controlla se la cartella esiste, altrimenti la crea
                    if (!file_exists($uploadDir) && !mkdir($uploadDir) && !is_dir($uploadDir)) {
                        echo "Si è verificato un errore durante la creazione della cartella.\n";
                        continue; // Passa al prossimo file
                    }

                    $destination = $uploadDir . $originalName;
                    // Sposta il file nella cartella di destinazione
                    if (move_uploaded_file($tempName, $destination)) {
                        // echo 'File caricato con successo!';
                        $this->messaggio(); // Chiamata alla tua funzione personalizzata
                    } else {
                        echo "Si è verificato un errore durante il caricamento del file '$originalName'.\n";
                    }
                } else {
                    echo "Si è verificato un errore durante il caricamento del file '$originalName'.\n";
                }
            }
        } else {
            echo "Nessun file è stato caricato.\n";
        }
    }

    public function delRiunine() {
        $delDati['id_master'] = MySQL::SQLValue($_POST['cancellaRiunione'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".v_riunione", $delDati))
            ;
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
}
