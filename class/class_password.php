<?php

require_once 'libreria/mysql_class.php';

class class_password extends MySQL {

    public $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function AggiornaPassword($user = null, $password = null, $domandaChiave = null, $tipo = null, $idPersonale = null, $cancella = null) {

        
        $gestionePass['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $gestionePass['idOperatore'] = MySQL::SQLValue($_SESSION['idAmministratore'], MySQL::SQLVALUE_TEXT);
        $gestionePass['tipo'] = MySQL::SQLValue($tipo, MySQL::SQLVALUE_TEXT);
        $gestionePass['domandaChiave'] = MySQL::SQLValue($domandaChiave, MySQL::SQLVALUE_TEXT);
        $gestionePass['password'] = MySQL::SQLValue($password, MySQL::SQLVALUE_TEXT);
        $gestionePass['user'] = MySQL::SQLValue($user, MySQL::SQLVALUE_TEXT);
        $nomedb = 'admin_' . $this->tabella . '.pws_personali';
        if (isset($_POST['idPersonale'])) {
            $pwsfiltro['idPersonale'] = MySQL::SQLValue($idPersonale, MySQL::SQLVALUE_TEXT);
            if (isset($cancella)) {

                if (!$this->db->DeleteRows($nomedb, $pwsfiltro))
                    echo $this->db->Kill();
            } else {
                if (!$this->db->UpdateRows($nomedb, $gestionePass, $pwsfiltro))
                    echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($nomedb, $gestionePass))
                echo $this->db->Kill();
        }

        @header('location:gestione-password.php');
    }

}
