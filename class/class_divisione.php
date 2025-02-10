<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_divisione extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function divisione() {
        $updDiv['divisione'] = MySQL::SQLValue($_POST['divisione'], MySQL::SQLVALUE_TEXT);
        $updDiv['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $updMarF['idDiv'] = MySQL::SQLValue($_POST['idDiv'], MySQL::SQLVALUE_TEXT);
        if (!empty($_POST['idDiv']) && empty($_POST['cancella'])) {
            if (!$this->db->UpdateRows($this->tabella . '.divisioneAziendale', $updDiv, $updMarF))
                echo $this->db->Kill();
        } elseif (!empty($_POST['cancella'])) {

            if (!$this->db->DeleteRows($this->tabella . '.divisioneAziendale', $updDiv, $updMarF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.divisioneAziendale', $updDiv))
                echo $this->db->Kill();
        }
    }

    public function selectDivisione() {

        $this->db->Query("SELECT * FROM {$this->tabella}.divisioneAziendale");
        $commenti = '<option value="">scegli...</option>';
        while ($commenti1 = $this->db->Row()) {
            $commenti .= '<option value="' . $commenti1->idDiv . '">' . utf8_encode($commenti1->divisione) . '</option>';
        }

        echo $commenti;
    }
}
