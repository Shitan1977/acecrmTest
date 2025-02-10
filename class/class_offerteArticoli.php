<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_offerteArticoli extends MySQL {

    private $tabella;
    public $db;


    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

   
}
