<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_attributi extends MySQL {

    private $tabella;
    public $db;
    public $attributo;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function aggAttributo($attributo, $idAttributi = null) {
        if (!empty($idAttributi)) {

            $this->updAttributo($attributo, $idAttributi);
        } else {
            $this->insAttributo($attributo);
        }
    }

    public function insAttributo($attributo) {
        $insAtt['attributo'] = MySQL::SQLValue($attributo, MySQL::SQLVALUE_TEXT);
        $insAtt['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!$this->db->InsertRow($this->tabella . '.attributi', $insAtt))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function updAttributo($attributo, $idAttributo) {
        $updAtt['attributo'] = MySQL::SQLValue($attributo, MySQL::SQLVALUE_TEXT);
        $updAttF['idAttributi'] = MySQL::SQLValue($idAttributo, MySQL::SQLVALUE_TEXT);
        $updAtt['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!$this->db->UpdateRows($this->tabella . '.attributi', $updAtt, $updAttF))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function cancdAttributo($idAttributo) {
        $cancAttF['idAttributi'] = MySQL::SQLValue($idAttributo, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.attributi', $cancAttF))
            echo $this->db->Kill();
        echo "<pre>";
        print_r($cancAttF);
        echo "</pre>";
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function insAttributoVal($idAttributo, $valore) {
        $insAttVal['idAttributo'] = MySQL::SQLValue($idAttributo, MySQL::SQLVALUE_TEXT);
        $insAttVal['valore'] = MySQL::SQLValue($valore, MySQL::SQLVALUE_TEXT);
        $insAttVal['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!$this->db->InsertRow($this->tabella . '.attributiValori', $insAttVal))
            echo $this->db->Kill();
        $this->attributo;
        $this->messaggio();
    }
   
      public function updAttributoVal($idAttributoVal, $valore) {
        $updAttValFil['idAttributoVal'] = MySQL::SQLValue($idAttributoVal, MySQL::SQLVALUE_TEXT);
        $updAttVal['valore'] = MySQL::SQLValue($valore, MySQL::SQLVALUE_TEXT);
        $updAttVal['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!$this->db->UpdateRows($this->tabella . '.attributiValori',$updAttVal, $updAttValFil))echo $this->db->Kill();
        $this->attributo;
        $this->messaggio();
    }
    
    public function selezione($idAttributo) {
        $this->attributo=$idAttributo;
    }
    
}

?>