<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_tourInfo extends MySQL {

    private $tabella;
    public $db;
    public $idTrup;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function GestioneTour($nome = null, $descrizione, $idTrap = null) {

        $tours['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $tours['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);

        if (isset($_POST['idTrap'])) {
            $ruolofiltro['idTrap'] = MySQL::SQLValue($idTrap, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.tourInfo', $tours, $ruolofiltro))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.tourInfo', $tours))
                echo $this->db->Kill();
        }
    }

    public function delTru($idTrap) {
        $toursf['idTrap'] = MySQL::SQLValue($idTrap, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.tourInfo', $toursf))
            echo $this->db->Kill();
    }

    public function varFissi($idTrup) {
        $this->idTrup = $idTrup;
    }

    public function GestioneOrari($idTras, $tipo, $durata, $arrivo, $idMezzo = null) {

        $dts['tipo'] = MySQL::SQLValue($tipo, MySQL::SQLVALUE_TEXT);
        $dts['idTras'] = MySQL::SQLValue($idTras, MySQL::SQLVALUE_TEXT);
        $dts['durata'] = MySQL::SQLValue($durata, MySQL::SQLVALUE_TEXT);
        $dts['arrivo'] = MySQL::SQLValue($arrivo, MySQL::SQLVALUE_TEXT);

        if (isset($idMezzo)) {
            $dtf['idMezzo'] = MySQL::SQLValue($idMezzo, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.tourInfoDett', $dts, $dtf))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.tourInfoDett', $dts)) {
                echo $this->db->Kill();
            }
        }
        $this->varFissi($idTras);
    }

    public function delMezzo($idMezzo, $idTras) {
        $toursfs['idMezzo'] = MySQL::SQLValue($idMezzo, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.tourInfoDett', $toursfs)) {
            echo $this->db->Kill();
        }
        $this->varFissi($idTras);
    }

}
