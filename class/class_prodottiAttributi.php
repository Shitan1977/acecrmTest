<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_prodottiAttributi extends MySQL {

    private $tabella;
    public $db;
    public $selezione;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function seleziones($attributoProdotto) {
        $this->selezione = $attributoProdotto;
    }

    public function insValore($idProdotto, $idaccessori) {
        $insV['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
        $insV['idaccessori'] = MySQL::SQLValue($idaccessori, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.attibutiProdotto', $insV))
            echo $this->db->Kill();
        $this->selezione = $idProdotto;
    }

    public function updValore($idaccessori, $quantita, $idProdotto) {
        $upV['quantita'] = MySQL::SQLValue($quantita, MySQL::SQLVALUE_TEXT);
        $upF['idAttributi'] = MySQL::SQLValue($idaccessori, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.attibutiProdotto', $upV,$upF))
            echo $this->db->Kill();
        $this->selezione = $idProdotto;
    }
     public function delValore($idaccessori, $idProdotto) {
      
        $delF['idAttributi'] = MySQL::SQLValue($idaccessori, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.attibutiProdotto', $delF))
            echo $this->db->Kill();
        $this->selezione = $idProdotto;
    }

}
