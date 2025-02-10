<?php

ini_set('error_reporting', E_ALL);
ini_set("display_errors", "1");
error_reporting(1);
include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_prestashop extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->db->tabella = $tabella;
        $this->db= new MySQL();
    }

    public function pubblica() {
        $this->db->Query("SELECT *, c.idProdotto as prodotto  from carrello_online as c inner join prodotto as p on p.idProdotto=c.idProdotto left join listini as l on l.idProdotto=p.idProdotto left join categorie as ca on ca.idCategorie=c.idProdotto left join marche as m on p.idMarca=m.idMarche");

        while ($webP = $this->Row()) {

            $this->db->aggProdotti($webP->prodotto, $webP->prodotto, $webP->margine, $webP->qyt, $webP->categoria, $webP->marca, $webP->barcode, $webP->condizioni);
        }
    }

    public function aggProdotti($idProdotto, $prodotto, $margine, $qyt, $categoria, $marca, $barcode, $condizioni) {
        //connessione a prestashop e aggiornamento del database

        $prodot['web'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $prodotF['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);

        if (!$this->UpdateRows("prodotto", $prodot, $prodotF))
            ;
        $this->db->eliminaprodotti($idProdotto);
    }

    public function eliminaprodotti($idProdotto) {
        $prodotD['idProdotto'] = MySQL::SQLValue($idProdotto, MySQL::SQLVALUE_TEXT);
        if (!$this->DeleteRows("carrello_online", $prodotD))
            ;
        //$this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

}
