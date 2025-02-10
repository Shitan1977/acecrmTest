<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_struttura extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function gestStruttura($strutura, $email, $nome, $cognome, $telefono, $indirizzo, $civico, $commssioni, $idRegione, $idProvince, $idComuni, $note, $username, $pws, $idAl = null) {
        $gestioneSetF['idAl'] = MySQL::SQLValue($idAl, MySQL::SQLVALUE_TEXT);
        $gestioneSet['struttura'] = MySQL::SQLValue($strutura, MySQL::SQLVALUE_TEXT);
        $gestioneSet['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $gestioneSet['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $gestioneSet['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $gestioneSet['telefono'] = MySQL::SQLValue($telefono, MySQL::SQLVALUE_TEXT);
        $gestioneSet['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $gestioneSet['civico'] = MySQL::SQLValue($civico, MySQL::SQLVALUE_TEXT);
        $gestioneSet['commissioni'] = MySQL::SQLValue($commssioni, MySQL::SQLVALUE_TEXT);
        $gestioneSet['idRegione'] = MySQL::SQLValue($idRegione, MySQL::SQLVALUE_TEXT);
        $gestioneSet['idProvince'] = MySQL::SQLValue($idProvince, MySQL::SQLVALUE_TEXT);
        $gestioneSet['idComuni'] = MySQL::SQLValue($idComuni, MySQL::SQLVALUE_TEXT);
        $gestioneSet['iva'] = MySQL::SQLValue($_POST['iva'], MySQL::SQLVALUE_TEXT);
        $gestioneSet['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $gestioneSet['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $gestioneSet['username'] = MySQL::SQLValue($username, MySQL::SQLVALUE_TEXT);
        if (!empty($pws)) {
            $gestioneSet['pws'] = MySQL::SQLValue(md5($pws), MySQL::SQLVALUE_TEXT);
        }
        $gestioneSet['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);

        if (!empty($idAl)) {
            if (!$this->db->UpdateRows($this->tabella . '.alberghi', $gestioneSet, $gestioneSetF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.alberghi', $gestioneSet))
                echo $this->db->Kill();
        }
    }

    public function delStruttura($idAl) {
        $gestioneSetF['idAl'] = MySQL::SQLValue($idAl, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.alberghi', $gestioneSetF))
            echo $this->db->Kill();
    }

    public function selectStruttura($idAl = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.alberghi"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idAl}'";
            if ($idAl == $pat->idAl) {
                echo 'selected';
            }
            echo ">{$pat->struttura}</option>";
        }
    }

    public function estremiPagamento() {
        $gestionePag['idMetodo'] = MySQL::SQLValue($_POST['idMetodo'], MySQL::SQLVALUE_TEXT);
        $gestionePag['banca'] = MySQL::SQLValue($_POST['banca'], MySQL::SQLVALUE_TEXT);
        $gestionePag['iban'] = MySQL::SQLValue($_POST['iban'], MySQL::SQLVALUE_TEXT);
        $gestionePag['idStruttura'] = MySQL::SQLValue($_POST['idStruttura'], MySQL::SQLVALUE_TEXT);
        if(!empty($_POST['idEstremo'])){
            
        }else{
             if (!$this->db->InsertRow($this->tabella . '.estremiTerzeParti', $gestionePag))
                echo $this->db->Kill();
        }
    }
}
