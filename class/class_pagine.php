<?php

session_start();
ob_start();
include_once 'libreria/mysql_class.php';

//

class class_pagine extends MySQL {

    private $tabella;
    public $db;
    public $db2;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
        $this->db2 = new MySQL();
    }

// gestione del menu
    public function PagineCRM($pag_menu) {
        
        $this->db->Query("SELECT * FROM admin_acecrm.page WHERE  url='{$pag_menu}'");
        $pagine = $this->db->Row();
        if (isset($pag_menu)) {
            switch ($pag_menu) {
                case $pagine->url:
                    include("./moduli/$pagine->cartella/$pagine->page");
                    break;
            }
        } else {
//faccio un controllo della sessione per caricare di default la pagina che l'utente vedrà a secondo del suo livello
            if ($_SESSION['livello'] == '1') {
                include("./moduli/default/default.php");
            }elseif ($_SESSION['livello'] == '2') {
                include("./moduli/default/default_struttura.php");
            }
        }
    }

}
