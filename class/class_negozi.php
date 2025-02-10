<?php


class class_negozi extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function controlloNegozio($negozio, $idNegozio = null) {
        if (!empty($idNegozio)) {
            $this->updNegozio($negozio, $idNegozio);
        } else {
            $this->insNegozio($negozio);
        }
    }

    public function insNegozio($negozio) {
        $insMar['negozio'] = MySQL::SQLValue($negozio, MySQL::SQLVALUE_TEXT);
        $insMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.negozi', $insMar))
            echo $this->db->Kill();
    }

    public function updNegozio($negozio, $idNegozio) {
        $updMar['negozio'] = MySQL::SQLValue($negozio, MySQL::SQLVALUE_TEXT);
        $updMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $updMarF['idNegozio'] = MySQL::SQLValue($idNegozio, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.negozi', $updMar, $updMarF))
            echo $this->db->Kill();
    }

    public function delNegozio($idNegozio) {

        $delMarF['idNegozio'] = MySQL::SQLValue($idNegozio, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.negozi', $delMarF))
            echo $this->db->Kill();

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function selectNegozio($idNegozio = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.negozi"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idNegozio}'";
            if ($idNegozio == $pat->idNegozio) {
                echo 'selected';
            }
            echo ">{$pat->negozio}</option>";
        }
    }

}

?>