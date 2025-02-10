
<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_cassaBooking {

    public $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function Aggpagato($attivo, $icb, $idOperatore, $idAzienda) {

        $aggStato['attivo'] = MySQL::SQLValue($attivo, MySQL::SQLVALUE_TEXT);
        $aggStatoU['idCB'] = MySQL::SQLValue($icb, MySQL::SQLVALUE_TEXT);
      
        if (!$this->db->UpdateRows($this->tabella . '.cassaBooking', $aggStato, $aggStatoU))
            echo $this->db->Kill();

        $this->selecPreno($icb, $idOperatore, $idAzienda);
    }

    public function selecPreno($icb, $idOperatore, $idAzienda) {

        $this->db->Query("SELECT * from {$_SESSION['tabella']}.cassaBooking as c INNER join {$_SESSION['tabella']}.anagrafica as t on t.idAnagrafica=c.idAnagrafica INNER JOIN {$_SESSION['tabella']}.pacchetti as p on p.idPacchetto=c.idPacc  where c.idCB=$icb");
        $dati = $this->db->Row();
       
        $descrizione = $dati->nome;
        $descrizione .= $dati->cognome . ' - ';
        $descrizione .= $dati->pacchetto . ' - ';

        $this->insCasseUf($dati->prezzo, $descrizione, $icb, $idOperatore, $idAzienda);
    }

    public function insCasseUf($entrata, $descrizione, $idPrenotazione, $idOperatore, $idAzienda) {
        $cassa['dataIncasso'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        $cassa['entrate'] = MySQL::SQLValue($entrata, MySQL::SQLVALUE_TEXT);
        $cassa['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $cassa['idOperatore'] = MySQL::SQLValue($idOperatore, MySQL::SQLVALUE_TEXT);
        $cassa['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $cassa['codiceOperazione'] = MySQL::SQLValue($idPrenotazione, MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($this->tabella . '.cassa', $cassa))
            echo $this->db->Kill();
    }

    public function insAmmCassa($idAnagrafica, $idPacc, $prezzo) {
        $cassaAbb['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $cassaAbb['idAnagrafica'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        $cassaAbb['idPacc'] = MySQL::SQLValue($idPacc, MySQL::SQLVALUE_TEXT);
        $cassaAbb['prezzo'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);
        $cassaAbb['attivo'] = MySQL::SQLValue('Pagato', MySQL::SQLVALUE_TEXT);
          if (!$this->db->InsertRow($this->tabella . '.cassaBooking', $cassa))
            echo $this->db->Kill();
    }

}
