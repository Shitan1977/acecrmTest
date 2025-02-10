<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';
class class_prescrizione extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function controlloPrescrizione($descrizione, $idPrescrizione = null) {
        if (!empty($idPrescrizione)) {
            $this->updPrescrizione($descrizione, $idPrescrizione);
        } else {
            $this->insPrescrizione($descrizione);
        }
    }

    public function insPrescrizione($descrizione) {
        $insMar['testo'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
       
        $insMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.prescrizione', $insMar))
            echo $this->db->Kill();
    }

    public function updPrescrizione($descrizione, $idPrescrizione) {
        $updMar['testo'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $updMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $updMarF['idPrescrizione'] = MySQL::SQLValue($idPrescrizione, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.prescrizione', $updMar, $updMarF))
            echo $this->db->Kill();
    }

    public function delPrescrizione($idPrescrizione) {

        $delMarF['idPrescrizione'] = MySQL::SQLValue($idPrescrizione, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.prescrizione', $delMarF))
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
