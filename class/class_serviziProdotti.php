<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_serviziProdotti extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

   
    public function gestioneServizi() {

        $insSer['servizio'] = MySQL::SQLValue($_POST['servizio'], MySQL::SQLVALUE_TEXT);
        $insSer['commissioneStruttura'] = MySQL::SQLValue($_POST['commissioneStruttura'], MySQL::SQLVALUE_TEXT);
        $insSer['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
       
        if(!empty($_POST['idServizi'])){
            $updSer['idServizi'] = MySQL::SQLValue($_POST['idServizi'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.serviziProdotti', $insSer,$updSer))
            echo $this->db->Kill();
        }else{
            if (!$this->db->InsertRow($this->tabella . '.serviziProdotti', $insSer))
            echo $this->db->Kill();
        }
        
    }

    public function delServizioProdotti() {

        $delSer['idServizi'] = MySQL::SQLValue($_POST['delser'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.serviziProdotti', $delSer))
            echo $this->db->Kill();

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function selectServiziProdotti($idServizi = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.serviziProdotti"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idServizi}'";
            if ($idServizi == $pat->idServizi) {
                echo 'selected';
            }
            echo ">{$pat->servizio}</option>";
        }
    }

}

?>