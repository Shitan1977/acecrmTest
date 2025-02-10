<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_avvisi extends MySQL {

    private $tabella;
    public $db;
    public $attributo;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insAvvisi($avviso, $scadenza, $id = null) {
        $insAvv['avviso'] = MySQL::SQLValue($avviso, MySQL::SQLVALUE_TEXT);
        $insAvv['scadenza'] = MySQL::SQLValue($scadenza, MySQL::SQLVALUE_DATE);
        $insAvvF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!empty($id)) {
            if (!$this->db->UpdateRows($this->tabella . '.avvisi', $insAvv, $insAvvF)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.avvisi', $insAvv)) {
                echo $this->db->Kill();
            }
        }

        $this->messaggio();
    }

    public function delAvv($id) {
        $insAvvD['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.avvisi', $insAvvD)) {
            echo $this->db->Kill();
        }
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

}

?>