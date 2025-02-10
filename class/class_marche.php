<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_marche extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function controlloMarche($marche, $idMarca = null) {
        if (!empty($idMarca)) {
            $this->updMarche($marche, $idMarca);
        } else {
            $this->insMarche($marche);
        }
    }

    public function insMarche($marca) {
        $insMar['marca'] = MySQL::SQLValue($marca, MySQL::SQLVALUE_TEXT);
        $insMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.marche', $insMar))
            echo $this->db->Kill();
    }

    public function updMarche($marca, $idMarca) {
        $updMar['marca'] = MySQL::SQLValue($marca, MySQL::SQLVALUE_TEXT);
        $updMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $updMarF['idMarca'] = MySQL::SQLValue($idMarca, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.marche', $updMar, $updMarF))
            echo $this->db->Kill();
    }

    public function delMarche($idMarca) {

        $delMarF['idMarca'] = MySQL::SQLValue($idMarca, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.marche', $delMarF))
            echo $this->db->Kill();

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function selectMarche($idMarche = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.marche"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idMarche}'";
            if ($idMarche == $pat->idMarche) {
                echo 'selected';
            }
            echo ">{$pat->marca}</option>";
        }
    }

}

?>