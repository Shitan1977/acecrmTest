<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_abbonamentoBooking extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function clienteSele($idCliente, $idPacchetto, $stato) {

        if ($this->db->Query("SELECT * FROM {$this->tabella}.anagrafica where concat(nome,' ', cognome)='{$idCliente}'"))
            ;
        $pat = $this->db->Row();

        $this->insAbbBoo($pat->idAnagrafica, $idPacchetto, $stato, $pat->durata);
    }

    public function insAbbBoo($idCliente, $idPacchetto, $stato, $dataFine) {
        $servizioins['idCliente'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $servizioins['idPacchetto'] = MySQL::SQLValue($idPacchetto, MySQL::SQLVALUE_TEXT);
        $servizioins['dataInizio'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $servizioins['stato'] = MySQL::SQLValue($stato, MySQL::SQLVALUE_TEXT);
        $servizioins['dataFine'] = MySQL::SQLValue(date('Y-m-d') + $dataFine, MySQL::SQLVALUE_DATE);

        if (!$this->db->InsertRow($this->tabella . '.abbonamentoBooking', $servizioins)) {
            echo $this->db->Kill();
        }
    }

    public function insCassaBooking($idAnagrafica, $idPacc, $prezzo, $idAb) {

        if ($this->db->Query("SELECT sum(prezzo) as prezzoT FROM {$this->tabella}.pacchetti where idPacchetto={$idPacc}"))
            ;
        $pr = $this->db->Row();
       
        
        $insCassaAb['idAnagrafica'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        $insCassaAb['idPacc'] = MySQL::SQLValue($idPacc, MySQL::SQLVALUE_TEXT);
        $insCassaAb['prezzo'] = MySQL::SQLValue($pr->prezzoT, MySQL::SQLVALUE_TEXT);
        $insCassaAb['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insCassaAb['attivo'] = MySQL::SQLValue("Pagato", MySQL::SQLVALUE_TEXT);
        
      
        if (!$this->db->InsertRow($this->tabella . '.cassaBooking', $insCassaAb)) {
            echo $this->db->Kill();
        }
        $this->aggAbb($idAb);
    }

    public function aggAbb($idAb) {


        $aggCassaAb['stato'] = MySQL::SQLValue("Pagamento Confermato", MySQL::SQLVALUE_TEXT);
        $aggCassaAbF['idAb'] = MySQL::SQLValue($idAb, MySQL::SQLVALUE_TEXT);
        $aggCassaAb['incassato'] = MySQL::SQLValue('Si', MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.abbonamentoBooking', $aggCassaAb,$aggCassaAbF)) {
            echo $this->db->Kill();
        }
    }

}

?>