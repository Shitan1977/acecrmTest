<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_prenotazioni extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function updPrenotatore($idFornitore, $idTour) {
        $prenot['idFornitore'] = MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_TEXT);
        $prenotF['idtour'] = MySQL::SQLValue($idTour, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.prenotazione', $prenot, $prenotF))
            echo $this->db->Kill();
    }

    public function delPrenotatore($idPrenotazione) {
        $preno['idPrenotazione'] = MySQL::SQLValue($idPrenotazione, MySQL::SQLVALUE_TEXT);

        if (!$this->db->DeleteRows($this->tabella . '.prenotazione', $preno))
            echo $this->db->Kill();
    }

    public function accredito($idPrenotazione, $idTour) {
        $prenoA['cancellazione'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $prenof['idPrenotazione'] = MySQL::SQLValue($idPrenotazione, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.prenotazione', $prenoA, $prenof))
            echo $this->db->Kill();
        $this->selCassa($idPrenotazione, $idTour);
    }

    public function selCassa($idPrenotazione, $idTour) {
        $this->db->Query("SELECT *  from $this->tabella.tour as t inner join $this->tabella.prenotazione as p on p.idtour=t.idtour where p.idPrenotazione=$idPrenotazione");
        $tor = $this->db->Row();
        $this->insCassa($idTour, $tor->idStruttura, $tor->costoTour, $tor->commissioneUfficio, $tor->commissioneTour, $tor->commissioneFornitore, $tor->nPersone, $tor->dataCreazione, $tor->idFornitore, $idPrenotazione);
    }

    public function insCassa($idtour, $idStruttura, $costoTour, $commissioneUfficio, $commissioneTour, $commissioneFornitore, $nPersone, $dataCreazione, $idFornitore, $idPrenotazione) {
        // prezzo
        $costoTour *= $nPersone;
        $commissioneUfficio *= $nPersone;
        $commissioneTour *= $nPersone;
        $commissioneFornitore *= $nPersone;

        $cass['prezzoEscursione'] = MySQL::SQLValue($costoTour, MySQL::SQLVALUE_TEXT);
        $cass['dataCreazione'] = MySQL::SQLValue($dataCreazione, MySQL::SQLVALUE_TEXT);
        $cass['idtour'] = MySQL::SQLValue($idtour, MySQL::SQLVALUE_TEXT);
        $cass['idStruttura'] = MySQL::SQLValue($idStruttura, MySQL::SQLVALUE_TEXT);
        $cass['prezzoUfficio'] = MySQL::SQLValue($commissioneUfficio, MySQL::SQLVALUE_TEXT);
        $cass['prezzoStruttura'] = MySQL::SQLValue($commissioneTour, MySQL::SQLVALUE_TEXT);
        $cass['prezzoFornitore'] = MySQL::SQLValue($commissioneFornitore, MySQL::SQLVALUE_TEXT);
        $cass['idFornitore'] = MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_TEXT);
        $cass['idPrenotazione'] = MySQL::SQLValue($idPrenotazione, MySQL::SQLVALUE_TEXT);
        $cass['Pax'] = MySQL::SQLValue($nPersone, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.cassa_tour', $cass))
            echo $this->db->Kill();
        header("location:gestione-prenotazioni.php");
    }

#inserimento prenotazione

    public function insCliente($nome, $cognome, $mobile, $email, $idTour, $npersone, $dataPartenza, $idStruttura) {
        $cliente['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $cliente['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $cliente['mobile'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);
        $cliente['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $cliente['livello'] = MySQL::SQLValue(4, MySQL::SQLVALUE_TEXT);
        $cliente['username'] = MySQL::SQLValue('SorrentoTravel', MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.anagrafica';
        $this->db->Query("SELECT * from admin_SorrentoTravel.anagrafica where email='{$email}'");
        if ($this->db->RowCount() > 0) {
            // esiste
        } else {
            if (!$this->db->InsertRow($nomedb, $cliente))
                echo $this->db->Kill();
        }
        $this->cliente($idTour, $npersone, $dataPartenza, $idStruttura, $email, $cognome);
    }

    public function cliente($idTour, $npersone, $dataPartenza, $idStruttura, $email, $cognome) {
        $this->db->Query("SELECT * from admin_SorrentoTravel.anagrafica where email='{$email}'");
        $tit = $this->db->Row();
        $this->insPrenotatore($idTour, $npersone, $dataPartenza, $idStruttura, $tit->idAnagrafica, $email, $cognome);
    }

    public function insPrenotatore($idTour, $npersone, $dataPartenza, $idStruttura, $idCliente, $email, $cognome) {

        $preno['idTour'] = MySQL::SQLValue($idTour, MySQL::SQLVALUE_TEXT);
        $preno['idStruttura'] = MySQL::SQLValue($idStruttura, MySQL::SQLVALUE_TEXT);
        $preno['idFornitore'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $preno['dataCreazione'] = MySQL::SQLValue($dataPartenza, MySQL::SQLVALUE_TEXT);
        $preno['cancellazione'] = MySQL::SQLValue(0, MySQL::SQLVALUE_TEXT);
        $preno['nPersone'] = MySQL::SQLValue($npersone, MySQL::SQLVALUE_TEXT);
        $preno['idCliente'] = MySQL::SQLValue($idCliente, MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.prenotazione';

        if (!$this->db->InsertRow($nomedb, $preno))
            echo $this->db->Kill();
      
    }
}
