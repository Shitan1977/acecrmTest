<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_listini extends MySQL {

    private $tabella;
    public $db;
    public $nomedb;
    public $varListino;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
        $this->nomedb = "admin_" . $tabella;
    }

    public function inserimentoListini($listino, $idFornitore, $default, $idListino = null) {

        $mar['listino'] = MySQL::SQLValue($listino, MySQL::SQLVALUE_TEXT);
        $mar['idFornitore'] = MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_TEXT);
        $mar['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        $mar['default'] = MySQL::SQLValue($default, MySQL::SQLVALUE_TEXT);

        if (!empty($idListino)) {

            $marF['idListino'] = MySQL::SQLValue($idListino, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->nomedb . ".listini", $mar, $marF))
                ;
        } else {

            if (!$this->db->InsertRow($this->nomedb . ".listini", $mar))
                ;
        }
        $this->messaggio();
    }

    public function inserimentoDettListino($idListino, $idProdotto, $prezzoF, $prezzo, $idDettList = null) {
        $listD['idListino'] = MySQL::SQLValue($idListino, MySQL::SQLVALUE_TEXT);
        $listD['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
        $listD['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        $listD['prezzoF'] = MySQL::SQLValue($prezzoF, MySQL::SQLVALUE_TEXT);
        $listD['iva'] = MySQL::SQLValue($_POST['iva'], MySQL::SQLVALUE_TEXT);
        if ($_POST['iva'] != 0) {
            $prezzo = $prezzo + ($prezzo * $_POST['iva']) / 100;
        }
        $listD['prezzo'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);
        if (!empty($idDettList)) {

            $listF['idDettList'] = MySQL::SQLValue($idDettList, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->nomedb . ".dettList", $listD, $listF))
                ;
        } else {

            if (!$this->db->InsertRow($this->nomedb . ".dettList", $listD))
                ;
        }
        $this->varListino = $idListino;
        $this->messaggio();
    }

    public function cancellaListino($idListino) {
        $cancID['idListino'] = MySQL::SQLValue($idListino, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->nomedb . ".listini", $cancID))
            ;
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function selezioneVar($idListino) {
        $this->varListino = $idListino;
    }

    public function cancellaDetListino($dettList) {
        $cancIDD['idDettList'] = MySQL::SQLValue($dettList, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->nomedb . ".dettList", $cancIDD))
            ;
    }
}
