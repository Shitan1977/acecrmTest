<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_cassaTour extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insSconto() {

        $scontoF['idCato'] = MySQL::SQLValue($_POST['idCato'], MySQL::SQLVALUE_TEXT);
        $scontov['commissioneSt'] = MySQL::SQLValue($_POST['commissioneSt'], MySQL::SQLVALUE_TEXT);
        $scontov['idOperatore'] = MySQL::SQLValue($_SESSION['idAmministratore'], MySQL::SQLVALUE_TEXT);
        $scontov['note'] = MySQL::SQLValue($_POST['note'], MySQL::SQLVALUE_TEXT);
        $scontov['commissioneUfficio'] = MySQL::SQLValue($_POST['commissioneUfficio'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.cassa_tour', $scontov, $scontoF))
            echo $this->db->Kill();
    }

    public function accredito($idCato, $idPrenotazione, $idOperatore, $idAzienda) {

        $accF['idCato'] = MySQL::SQLValue($idCato, MySQL::SQLVALUE_TEXT);

        $acc['accreditato'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.cassa_tour', $acc, $accF))
            echo $this->db->Kill();
        $this->selecPreno($idPrenotazione, $idOperatore, $idAzienda);
    }

    public function selecPreno($idPrenotazione, $idOperatore, $idAzienda) {

        $this->db->Query("SELECT * from {$_SESSION['tabella']}.prenotazione as p inner join {$_SESSION['tabella']}.cassa_tour as t on p.idPrenotazione=t.idPrenotazione inner join {$_SESSION['tabella']}.tour as tt on tt.idtour=p.idTour inner join {$_SESSION['tabella']}.anagrafica as a on a.idAnagrafica=p.idCliente  where p.idPrenotazione=$idPrenotazione");
        $dati = $this->db->Row();
        $descrizione = $dati->titolo;
        $descrizione .= $dati->struttura . ' - ';
        $descrizione .= $dati->cognome . ' - ';
        $descrizione .= $dati->nPersone . 'pax';
        $this->insCasseUf($dati->prezzoUfficio, $descrizione, $idPrenotazione, $idOperatore, $idAzienda);
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
}
