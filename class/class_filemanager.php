<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_filemanager extends MySQL {

    private $tabella;
    public $db;
    public $idFile;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insCartella($cartella) {

        $cart['cartella'] = MySQL::SQLValue($cartella, MySQL::SQLVALUE_TEXT);
        $cart['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . ".fileManagement", $cart))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function canCartella($idFile) {
        $cartF['idFile'] = MySQL::SQLValue($idFile, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".fileManagement", $cartF))
            echo $this->db->Kill();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function fileName($idFile) {
        $this->idFile = $idFile;
    }

    public function caricamentoFile($tmp, $nome, $idAzienda, $idFile) {

        $path = "archivioFIle/$idAzienda/";
        if (!is_dir($path)) {

            mkdir($path);
        }
        $path = $path . DIRECTORY_SEPARATOR . $nome;
        // Upload filenome
        move_uploaded_file($tmp, $path);
        $this->inserFile($nome, $idFile);
    }

    public function inserFile($filename, $idFile) {
        $fil['idFile'] = MySQL::SQLValue($idFile, MySQL::SQLVALUE_TEXT);
        $fil['nome'] = MySQL::SQLValue($filename, MySQL::SQLVALUE_TEXT);
        $fil['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . ".archivioFile", $fil))
            echo $this->db->Kill();
        $this->idFile = $idFile;
    }

}
