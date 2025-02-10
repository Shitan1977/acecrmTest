<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_gestioneiva extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insIva($codice, $descrizione, $note,$valore, $id = null) {
        $insIva['codice'] = MySQL::SQLValue($codice, MySQL::SQLVALUE_TEXT);
        $insIva['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insIva['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $insIva['valore'] = MySQL::SQLValue($valore, MySQL::SQLVALUE_TEXT);
      
        if (!empty($id)) {
            $insIvaF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.iva', $insIva, $insIvaF)) {
                echo $this->db->Kill();
            }
            $this->messaggio();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.iva', $insIva)) {
                echo $this->db->Kill();
            }
            $this->messaggio();
        }
    }

    public function delIva($id) {
        $insComF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.iva', $insComF)) {
            echo $this->db->Kill();
        }
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

}
