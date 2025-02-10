<?php

session_start();
ob_start();
require_once 'libreria/mysql_class.php';

class class_clienti extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function GestioneClienti($idAnagrafica = null, $nome, $cognome, $indirizzo = null, $cap = null, $idProvincia = null, $idComune = null, $idRegione = null, $fisso = null, $mobile = null, $ragioneSociale = null, $email = null, $codiceFiscale = null, $iva = null, $pws = null, $sesso = null, $cancella = null) {

        $db = new MySQL();
        $cliente['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $cliente['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $cliente['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $cliente['cap'] = MySQL::SQLValue($cap, MySQL::SQLVALUE_TEXT);
        $cliente['idProvincia'] = MySQL::SQLValue($idProvincia, MySQL::SQLVALUE_TEXT);
        $cliente['idComune'] = MySQL::SQLValue($idComune, MySQL::SQLVALUE_TEXT);
        $cliente['idRegione'] = MySQL::SQLValue($idRegione, MySQL::SQLVALUE_TEXT);
        $cliente['fisso'] = MySQL::SQLValue($fisso, MySQL::SQLVALUE_TEXT);
        $cliente['mobile'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);
        $cliente['ragioneSociale'] = MySQL::SQLValue($ragioneSociale, MySQL::SQLVALUE_TEXT);
        $cliente['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $cliente['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $cliente['codiceFiscale'] = MySQL::SQLValue($codiceFiscale, MySQL::SQLVALUE_TEXT);
        $cliente['iva'] = MySQL::SQLValue($iva, MySQL::SQLVALUE_TEXT);
        $cliente['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        if (!empty($pws)) {
            $cliente['pws'] = MySQL::SQLValue(md5($pws), MySQL::SQLVALUE_TEXT);
        }
        $cliente['sesso'] = MySQL::SQLValue($sesso, MySQL::SQLVALUE_TEXT);
        $cliente['livello'] = MySQL::SQLValue(2, MySQL::SQLVALUE_TEXT);
        $cliente['username'] = MySQL::SQLValue($_SESSION['username'], MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.anagrafica';

        if (isset($_POST['idAnagrafica'])) {
            $clientifiltro['idAnagrafica'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
            if (isset($cancella)) {

                if (!$db->DeleteRows($nomedb, $clientifiltro))
                    echo $db->Kill();
            } else {
                if (!$db->UpdateRows($nomedb, $cliente, $clientifiltro))
                    echo $db->Kill();
            }
        } else {
            if (!$db->InsertRow($nomedb, $cliente))
                echo $db->Kill();
        }

        @header('location:gestione-clienti.php');
    }
    
        public function GestioneReferenti($nome, $cognome, $idCliente = null, $telefono = null, $email = null, $tipo = null, $idComune = null, $cancella = null,$idRef = null) {

        $db = new MySQL();
        $ref['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $ref['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $ref['idCliente'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $ref['telefono'] = MySQL::SQLValue($telefono, MySQL::SQLVALUE_TEXT);
        $ref['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $ref['tipo'] = MySQL::SQLValue($tipo, MySQL::SQLVALUE_TEXT);
      
        $nomedb = $this->tabella . '.referenti_clienti';

        if (isset($_POST['idRef'])) {
            $reffiltro['idRef'] = MySQL::SQLValue($idRef, MySQL::SQLVALUE_TEXT);
            if (isset($cancella)) {

                if (!$db->DeleteRows($nomedb, $reffiltro)) {
                    echo $db->Kill();
                }
            } else {
                if (!$db->UpdateRows($nomedb, $ref, $reffiltro)) {
                    echo $db->Kill();
                }
            }
        } else {
            if (!$db->InsertRow($nomedb, $ref))
                echo $db->Kill();
        }

      
    }

}
