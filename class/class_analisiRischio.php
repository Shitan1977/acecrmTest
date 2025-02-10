<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_analisiRischio extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function controlloRischio($descrizione, $idRischio = null) {
        if (!empty($idRischio)) {
            $this->updRischio($descrizione, $idRischio);
        } else {
            $this->insRischio($descrizione);
        }
    }

    public function insRischio($descrizione) {
        $insMar['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insMar['titolo'] = MySQL::SQLValue($_POST['titolo'], MySQL::SQLVALUE_TEXT);
        $insMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.analisiRischi', $insMar))
            echo $this->db->Kill();
    }

    public function updRischio($descrizione, $idRischio) {
        $updMar['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
         $updMar['titolo'] = MySQL::SQLValue($_POST['titolo'], MySQL::SQLVALUE_TEXT);       
        $updMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $updMarF['idRischio'] = MySQL::SQLValue($idRischio, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.analisiRischi', $updMar, $updMarF))
            echo $this->db->Kill();
    }

    public function delRischio($idRischio) {

        $delMarF['idRischio'] = MySQL::SQLValue($idRischio, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.analisiRischi', $delMarF))
            echo $this->db->Kill();

        $this->messaggio();
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
