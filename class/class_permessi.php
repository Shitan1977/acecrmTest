<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_permessi extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function GestionePermessi($idRuolo, $modulo, $idPermesso = null) {

       
        $nomedb = $this->tabella . '.permessi';
        $gestionepermessi['idAzienda'] = MySql::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $gestionepermessi['idRuolo'] = MySql::SQLValue($idRuolo, MySQL::SQLVALUE_TEXT);
        $gestionepermessi['idModuli'] = MySql::SQLValue($modulo, MySQL::SQLVALUE_TEXT);
        
        if (isset($idPermesso)) {
            $ruolofiltro['idPermesso'] = MySQL::SQLValue($idPermesso, MySQL::SQLVALUE_TEXT);

            if (!$this->db->DeleteRows($nomedb, $ruolofiltro))
                echo $this->db->Kill();
        } else {

            if (!$this->db->InsertRow($nomedb, $gestionepermessi))
                echo $this->db->Kill();
        }

        @header("location:gestione-gestione_permessi.php");
    }

}
