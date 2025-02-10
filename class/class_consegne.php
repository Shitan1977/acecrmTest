<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_consegne extends MySQL {

    private $tabella;
    public $db;


    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }
    
    public function insCon($rif_commessa,$spettabile,$oggetto,$id=null) {
        $insCon['idProdotto'] = MySQL::SQLValue($rif_commessa, MySQL::SQLVALUE_TEXT);
    }

   
}
