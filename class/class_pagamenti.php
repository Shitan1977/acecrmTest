<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_pagamenti extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    #modalità di pagamento select

    public function selectMetodoPagamenti($id = null) {
        echo "SELECT * FROM {$this->tabella}.mod_pagamento";
        if ($this->db->Query("SELECT * FROM {$this->tabella}.mod_pagamento"))
            ;
        while ($pag = $this->db->Row()) {
            echo "<option value='{$pag->descrizione}'";
            if ($id == $pag->descrizione) {
                echo 'selected';
            }
            echo ">{$pag->descrizione}</option>";
        }
    }

    public function insPagamenti($codice, $descrizione, $note, $id = null) {
        $insPagamento['codice'] = MySQL::SQLValue($codice, MySQL::SQLVALUE_TEXT);
        $insPagamento['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insPagamento['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);

        if (!empty($id)) {
            $insPagamentoF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.mod_pagamento', $insPagamento, $insPagamentoF)) {
                echo $this->db->Kill();
            }
            $this->messaggio();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.mod_pagamento', $insPagamento)) {
                echo $this->db->Kill();
            }
            $this->messaggio();
        }
    }

    public function delPagamento($id) {
        $insPagF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.mod_pagamento', $insPagF)) {
            echo $this->db->Kill();
        }
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

}
