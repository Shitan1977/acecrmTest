<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_prodottiRFQ extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function controlloProdotti($prodotto, $idProd = null) {
        if (!empty($idProd)) {
            $this->updProdottiRFQ($prodotto, $idProd);
        } else {
            $this->insProdottiRFQ($prodotto);
        }
    }

    public function insProdottiRFQ($prodotto) {
        $insMar['prodotto'] = MySQL::SQLValue($prodotto, MySQL::SQLVALUE_TEXT);
        $insMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.prodotti_rfq', $insMar))
            echo $this->db->Kill();
    }

    public function updProdottiRFQ($prodotto, $idProd) {
        $updMar['prodotto'] = MySQL::SQLValue($prodotto, MySQL::SQLVALUE_TEXT);
        $updMar['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $updMarF['idProd'] = MySQL::SQLValue($idProd, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.prodotti_rfq', $updMar, $updMarF))
            echo $this->db->Kill();
    }

    public function delProdottiRFQ($idProd) {

        $delMarF['idProd'] = MySQL::SQLValue($idProd, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.prodotti_rfq', $delMarF))
            echo $this->db->Kill();

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function selectProdottiRFQ($idProd = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.prodotti_rfq"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idProd}'";
            if ($idProd == $pat->idProd) {
                echo 'selected';
            }
            echo ">{$pat->prodotto}</option>";
        }
    }

}

?>