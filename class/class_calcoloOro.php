<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_calcoloOro extends MySQL {

    private $tabella;
    public $db;
    public $calcolos;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function calcolo() {

        $this->db->Query("SELECT *  FROM $this->tabella.calcoloOro");
        $oro = $this->db->Row();
        echo $oro->calcolo;
    }

    public function prezzoCalcolato($prezzo) {
        
        echo $this->calcolos * $prezzo;
    }

    public function gestioneOro($oro) {

        $this->db->Query("SELECT *  FROM $this->tabella.calcoloOro");
        
        if ($this->db->RowCount() > 0) {
            
            $gOro = $this->db->Row();
            $this->updOro($oro, $gOro->idOro);
        } else {
          
            $this->insOro($oro);
        }
    }

    public function insOro($oro) {

        $oroCal['calcolo'] = MySQL::SQLValue($oro, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.calcoloOro', $oroCal))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function updOro($oro, $idOro) {
       
        $oroCal['calcolo'] = MySQL::SQLValue($oro, MySQL::SQLVALUE_TEXT);
        $oroCalFil['idOro'] = MySQL::SQLValue($idOro, MySQL::SQLVALUE_TEXT);
      
        if (!$this->db->UpdateRows($this->tabella . '.calcoloOro', $oroCal, $oroCalFil))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function VarOro() {
        $this->db->Query("SELECT *  FROM $this->tabella.calcoloOro");
        $oro = $this->db->Row();
        $this->calcolos = $oro->calcolo;
    }

}
