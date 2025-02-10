<?php

require_once 'libreria/mysql_class.php';

class class_abbonamento extends MySQL {

    private $tabella;
    public $prezzo;
    public $portale;
    public $percentuale;
    public $idAbbonamento;
    public $datainizio;
    public $datascadenza;
    public $mesi;
    public $mensile;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function gestioneMesi($mesi) {
        switch ($mesi) {
            case 1:
                echo "Abbonamento Mensile";
                break;
            case 3:
                echo "Abbonamento Trimestale";
                break;
            case 6:
                echo "Abbonamento Semestrale";
                break;
            case 12:
                echo "Abbonamento Annuale";
                break;
        }
    }

    public function abbonamentoQuery() {
       
        $this->db->Query("SELECT DATE_FORMAT(inizio, '%d/%m/%Y') as datainizio, DATE_FORMAT(scadenza, '%d/%m/%Y')as datascadenza, abbonamento.*, prezzario.*  FROM admin_acecrm.abbonamento LEFT OUTER JOIN admin_acecrm.prezzario ON prezzario.idPortale=abbonamento.idServizio  WHERE abbonamento.idAzienda={$_SESSION['idAzienda']}");
        $abbonamento = $this->db->Row();
        switch ($abbonamento->mesi) {
            case 1:
                $this->prezzo = $abbonamento->mensile;
                break;
            case 3:
                $this->prezzo = $abbonamento->trimestrale;
                break;
            case 6:
                $this->prezzo = $abbonamento->semestrale;
                break;
            case 12:
                $this->prezzo = $abbonamento->annuale;
                break;
        }
        $this->mensile = $abbonamento->mensile;
        $this->mesi = $abbonamento->mesi;
        $this->portale = $abbonamento->portale;
        $this->idAbbonamento = $abbonamento->idAbbonamento;
        $this->datainizio = $abbonamento->datainizio;
        $this->scadenza = $abbonamento->scadenza;
    }

    public function agentePercentuale() {
       
        $this->db->Query("SELECT agenti.idAgente, percentuale_portale.idAgente AS agente, percentuale_portale.idAzienda, percentuale_portale.percentuale FROM admin_acecrm.agenti INNER JOIN admin_acecrm.percentuale_portale ON agenti.idAgente=percentuale_portale.idAgente WHERE percentuale_portale.idAzienda={$_SESSION['idAzienda']}");
        $agentepercentuale = $this->db->Row();
        $this->percentuale = $agentepercentuale->percentuale;
    }

    public function speseCommercialista($prezzo, $percentuale) {
        $calcolo = ($prezzo * $percentuale) / 100;
        $prezzoScorporato = $prezzo + $calcolo;
        //inserisco la percentuale amministrazione
        $speseamministrative = ($prezzoScorporato * 15) / 100;
        $prezzodefinitivo = $prezzoScorporato + $speseamministrative;
        echo number_format($prezzodefinitivo, 2);
    }

}
