<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_commenti extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

     public function selectCommenti($descrizione= null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.commenti"))
            ;
        while ($commenti = $this->db->Row()) {
            echo "<option value='{$commenti->descrizione}'";
            if ($descrizione == $commenti->descrizione) {
                echo 'selected';
            }
            echo ">".utf8_encode($commenti->descrizione)."</option>";
        }
    }


    public function insCommenti($codice, $descrizione, $note, $id = null) {
        $insCommenti['codice'] = MySQL::SQLValue($codice, MySQL::SQLVALUE_TEXT);
        $insCommenti['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insCommenti['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);

        if (!empty($id)) {
            $insCommentiF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.commenti', $insCommenti, $insCommentiF))
                echo $this->db->Kill();
            $this->messaggio();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.commenti', $insCommenti))
                echo $this->db->Kill();
            $this->messaggio();
        }
    }

    public function delCommenti($id) {
        $insComF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.commenti', $insComF))
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
