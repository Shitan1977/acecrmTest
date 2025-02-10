<?php

require_once 'libreria/mysql_class.php';

class class_cassa extends MySQL {

    public $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function totaleEntrate() {

        if (!$this->db->Query("SELECT SUM(entrate) AS entratetot from {$this->tabella}.cassa WHERE  idAzienda={$_SESSION['idAzienda']}"))
            ;
        $gestionecassan = $this->db->Row();
        echo number_format($gestionecassan->entratetot, 2);
    }

    public function totaleUscite() {

        if (!$this->db->Query("SELECT SUM(uscite) AS uscitetot from {$_SESSION['tabella']}.cassa WHERE  idAzienda={$_SESSION['idAzienda']}"))
            echo $this->db->Kill();

        $gestionecassaen = $this->db->Row();
        echo number_format($gestionecassaen->uscitetot, 2);
    }

    public function totalecassa() {


        if (!$this->db->Query("SELECT SUM(entrate) as totale_entrate, SUM(uscite) as totale_uscite FROM {$_SESSION['tabella']}.cassa WHERE idAzienda={$_SESSION['idAzienda']}")) {
            echo $this->db->Kill();
        }

        $gestionecassaen = $this->db->Row();
        $saldo_cassa = $gestionecassaen->totale_entrate - $gestionecassaen->totale_uscite;
        echo number_format($saldo_cassa, 2);
    }

    public function totalecassaNonIncassato() {


        if (!$this->db->Query("SELECT SUM(daIncassare) as totale_entrateIncassare FROM {$_SESSION['tabella']}.cassa WHERE idAzienda={$_SESSION['idAzienda']}")) {
            echo $this->db->Kill();
        }

        $gestionecassaen = $this->db->Row();
        echo number_format($gestionecassaen->totale_entrateIncassare, 2);
    }

    public function GestioneCassa($dataIncasso, $tipo, $descrizione, $importo, $idFornitori = NULL, $idCollaboratori = NULL, $idAvvocati = NULL, $idCommercialisti = NULL, $estratto = NULL, $idAnagrafica = NULL) {

        $gestioneCassa['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $gestioneCassa['dataincasso'] = MySQL::SQLValue($_POST['dataIncasso'], MySQL::SQLVALUE_DATE);
        if ($tipo == 'entrata') {
            $gestioneCassa['entrate'] = MySQL::SQLValue($_POST['importo'], MySQL::SQLVALUE_TEXT);
        } elseif ($tipo == 'daIncassare') {
            $gestioneCassa['daIncassare'] = MySQL::SQLValue($_POST['importo'], MySQL::SQLVALUE_TEXT);
        } else {
            $gestioneCassa['uscite'] = MySQL::SQLValue($_POST['importo'], MySQL::SQLVALUE_TEXT);
        }
        $gestioneCassa['Descrizione'] = MySQL::SQLValue($_POST['descrizione'], MySQL::SQLVALUE_TEXT);
        $gestioneCassa['idOperatore'] = MySQL::SQLValue($_SESSION['idAmministratore'], MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.cassa';
        if (!$this->db->InsertRow($nomedb, $gestioneCassa))
            echo $this->db->Kill();
        if (isset($estratto)) {
            if (!$this->db->Query("SELECT idCassa from {$_SESSION['tabella']}.cassa WHERE  cassa.idAzienda={$_SESSION['idAzienda']} order by idCassa Desc limit 1"))
                ;
            $viewCassa = $this->db->Row();
            $estrattoConto['idAnagrafica'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
            $estrattoConto['idFornitori'] = MySQL::SQLValue($idFornitori, MySQL::SQLVALUE_TEXT);
            $estrattoConto['idCollaboratori'] = MySQL::SQLValue($idCollaboratori, MySQL::SQLVALUE_TEXT);
            $estrattoConto['idAvvocati'] = MySQL::SQLValue($idAvvocati, MySQL::SQLVALUE_TEXT);
            $estrattoConto['idCommercialista'] = MySQL::SQLValue($idCommercialisti, MySQL::SQLVALUE_TEXT);
            $estrattoConto['idCassa'] = MySQL::SQLValue($viewCassa->idCassa, MySQL::SQLVALUE_TEXT);
            $nomedb2 = $this->tabella . '.estrattoConto';
            if (!$this->db->InsertRow($nomedb2, $estrattoConto))
                echo $this->db->Kill();
        }
        @header('location:gestione-cassa.php');
    }

    public function totaleEstratto() {


        if (!$this->db->Query("SELECT SUM(entrate-uscite) AS totalecassa from $this->tabella.cassa INNER JOIN $this->tabella.estrattoConto ON cassa.idCassa=estrattoConto.idCassa WHERE  idAzienda={$_SESSION['idAzienda']}"))
            echo $this->db->Kill();

        $gestionecassaen = $this->db->Row();
        echo number_format($gestionecassaen->totalecassa, 2);
    }

    public function totaleEntrateEstratto() {

        if (!$this->db->Query("SELECT SUM(entrate) AS entratetot from $this->tabella.cassa INNER JOIN $this->tabella.estrattoConto ON cassa.idCassa=estrattoConto.idCassa WHERE  idAzienda={$_SESSION['idAzienda']}"))
            ;
        $gestionecassan = $this->db->Row();
        echo number_format($gestionecassan->entratetot, 2);
    }

    public function totaleUsciteEstratto() {

        if (!$this->db->Query("SELECT SUM(uscite) AS uscitetot from $this->tabella.cassa INNER JOIN $this->tabella.estrattoConto ON cassa.idCassa=estrattoConto.idCassa WHERE  idAzienda={$_SESSION['idAzienda']}"))
            echo $this->db->Kill();

        $gestionecassaen = $this->db->Row();
        echo number_format($gestionecassaen->uscitetot, 2);
    }

    public function cancellaCassa() {
        $nomedb = $this->tabella . '.cassa';

        $cancella['idCassa'] = MySQL::SQLValue($_POST['idCassa'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($nomedb, $cancella))
            echo $this->db->Kill();
    }

    #modifica dell'accredito della cassa

    public function accreditoSospesi() {
        $nomedb = $this->tabella . '.cassa';

        $accreditoF['idCassa'] = MySQL::SQLValue($_POST['idCassa'], MySQL::SQLVALUE_TEXT);
        $accredito['entrate'] = MySQL::SQLValue($_POST['incasso'], MySQL::SQLVALUE_TEXT);
        $accredito['daIncassare'] = MySQL::SQLValue(null, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($nomedb, $accredito, $accreditoF))
            echo $this->db->Kill();
    }

    #carrello cassa tour

    public function carrelloTerzi() {
        // select per il numero ordine
        if (!$this->db->Query("SELECT nOrdine from {$this->tabella}.ordini_pagamentiTerzi"))
            ;
        if ($this->db->RowCount() > 0) {
            $nOrdine = $this->db->Row();
            $ordine = ++$nOrdine->nOrdine;
        } else {
            $ordine = 0;
        }
        $this->aggCarrello($ordine);
    }

    public function aggCarrello($ordine) {
        $carrello['ordine'] = MySQL::SQLValue($ordine, MySQL::SQLVALUE_TEXT);
        if (!empty($_POST['idFornitore'])) {
            $carrello['idFornitori'] = MySQL::SQLValue($_POST['idFornitore'], MySQL::SQLVALUE_TEXT);
        } else {
            $carrello['idAlbergo'] = MySQL::SQLValue($_POST['idAlbergo'], MySQL::SQLVALUE_TEXT);
        }
        $carrello['stato'] = MySQL::SQLValue(0, MySQL::SQLVALUE_TEXT);
        $carrello['totale'] = MySQL::SQLValue($_POST['totale'], MySQL::SQLVALUE_TEXT);
        $carrello['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $carrello['idTour'] = MySQL::SQLValue($_POST['idTour'], MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow("{$this->tabella}.carrello_pagamentiTerzi", $carrello))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>
    Swal.fire({
        title: 'Successo!',
        text: 'Aggiornamento riuscito con successo.',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
    </script>";
    }

    public function elementoInCarrello($idTour, $idFornitore = null, $idStruttura = null) {
        $query = "SELECT * FROM {$this->tabella}.carrello_pagamentiTerzi WHERE idTour = " . MySQL::SQLValue($idTour, MySQL::SQLVALUE_NUMBER);

        if ($idFornitore !== null) {
            $query .= " AND idFornitori = " . MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_NUMBER);
        } else if ($idStruttura !== null) {
            $query .= " AND idAlbergo = " . MySQL::SQLValue($idStruttura, MySQL::SQLVALUE_NUMBER);
        } else {
            return false; // Nessun id fornito
        }

        if ($this->db->Query($query) && $this->db->RowCount() > 0) {
            return true;
        }
        return false;
    }

    public function conteggioCarrello($idFornitore = null, $idStruttura = null) {
        $query = "SELECT COUNT(*) AS conteggio FROM {$this->tabella}.carrello_pagamentiTerzi WHERE stato = 0";

        if ($idFornitore !== null) {
            $query .= " AND idFornitori IS NOT NULL";
        } else if ($idStruttura !== null) {
            $query .= " AND idAlbergo IS NOT NULL";
        } else {
            return 0; // Nessun id fornito
        }

        if ($this->db->Query($query)) {
            $result = $this->db->Row();
            return $result->conteggio;
        }
        return 0;
    }

    public function conteggioCarrelloTotale($idFornitore = null, $idStruttura = null) {
        $query = "SELECT SUM(c.totale) AS conteggio, ";
        if ($idFornitore !== null) {
            $query .= "f.nome, f.cognome, f.ragioneSociale, c.idFornitori AS id ";
            $query .= "FROM {$this->tabella}.carrello_pagamentiTerzi AS c ";
            $query .= "INNER JOIN {$this->tabella}.fornitori AS f ON f.idFornitori = c.idFornitori ";
        } else {
            $query .= "f.nome, f.cognome, f.struttura AS ragioneSociale, c.idAlbergo AS id ";
            $query .= "FROM {$this->tabella}.carrello_pagamentiTerzi AS c ";
            $query .= "INNER JOIN {$this->tabella}.alberghi AS f ON f.idAl = c.idAlbergo ";
        }

        $query .= "WHERE c.stato = 0 ";

        if ($idFornitore !== null) {
            $query .= "AND c.idFornitori IS NOT NULL ";
            $query .= "GROUP BY c.idFornitori, f.nome, f.cognome, f.ragioneSociale";
        } else if ($idStruttura !== null) {
            $query .= "AND c.idAlbergo IS NOT NULL ";
            $query .= "GROUP BY c.idAlbergo, f.nome, f.cognome, f.struttura";
        } else {
            return 0; // Nessun id fornito
        }


        if ($this->db->Query($query)) {
            while ($result = $this->db->Row()) {
                echo "<tr>";
                echo "<td>{$result->nome} {$result->cognome} {$result->ragioneSociale}</td>";
                echo "<td>{$result->conteggio}</td>";
                echo "<td>
                  <form action='gestione-riepilogoCassa.php' method='post'>
                        <input type='hidden' name='totale' value='{$result->conteggio}'>
                        <input type='hidden' name='id' value='{$result->id}'>";
                if ($idFornitore !== null) {
                    echo "<input type='hidden' name='fornitore' value='fornitore'>";
                } else {
                    echo "<input type='hidden' name='struttura' value='struttura'>";
                }
                echo "   <button type='submit' class='btn btn-twitter m-b-10 m-l-10 waves-effect waves-light'><i class='fab fa-cc-mastercard'></i></button>
                    </form>
                  </td>";
                echo "</tr>";
            }
        }
        return 0;
    }

    public function getDettagliCarrello($idFornitore = null, $idStruttura = null) {
        $query = "SELECT c.idCarrello, c.dataCreazione, t.titolo, ";
        if ($idFornitore !== null) {
            $query .= "f.nome, f.cognome, f.ragioneSociale, c.totale AS prezzo ";
            $query .= "FROM {$this->tabella}.carrello_pagamentiTerzi AS c ";
            $query .= "INNER JOIN {$this->tabella}.tour AS t ON c.idTour = t.idTour ";
            $query .= "INNER JOIN {$this->tabella}.fornitori AS f ON f.idFornitori = c.idFornitori ";
        } else {
            $query .= "f.nome, f.cognome, f.struttura AS ragioneSociale, c.totale AS prezzo ";
            $query .= "FROM {$this->tabella}.carrello_pagamentiTerzi AS c ";
            $query .= "INNER JOIN {$this->tabella}.tour AS t ON c.idTour = t.idTour ";
            $query .= "INNER JOIN {$this->tabella}.alberghi AS f ON f.idAl = c.idAlbergo ";
        }

        $query .= "WHERE c.stato = 0 ";

        if ($idFornitore !== null) {
            $query .= "AND c.idFornitori IS NOT NULL";
        } else if ($idStruttura !== null) {
            $query .= "AND c.idAlbergo IS NOT NULL";
        } else {
            return []; // Nessun id fornito
        }


        if ($this->db->Query($query)) {
            $result = [];
            while ($row = $this->db->Row()) {
                $result[] = $row;
            }
            return $result;
        }
        return [];
    }

    public function generaNumeroOrdine($tipologia) {
        $query = "SELECT MAX(nOrdine) AS maxOrdine FROM {$this->tabella}.ordini_pagamentiTerzi";
        $this->db->Query($query);
        $row = $this->db->Row();
        $nOrdine = $row ? $row->maxOrdine + 1 : 1;

        $dataCreazione = date('Y-m-d');
        $stato = 'pagato';

        $insertQuery = "INSERT INTO {$this->tabella}.ordini_pagamentiTerzi (nOrdine, dataCreazione, stato, tipologia, importo) 
                    VALUES ({$nOrdine}, '{$dataCreazione}', '{$stato}', '{$tipologia}', {$_POST['totale']})";
        if ($this->db->Query($insertQuery)) {
            return $this->db->GetLastInsertID();
        }
        return false;
    }

    public function aggiornaCarrello($id, $nOrdine, $tipo) {
        $query = "UPDATE {$this->tabella}.carrello_pagamentiTerzi 
              SET stato = 1, ordine = {$nOrdine} 
              WHERE stato = 0 AND ";
        if ($tipo == 'fornitore') {
            $query .= "idFornitori = {$id}";
        } else {
            $query .= "idAlbergo = {$id}";
        }

       // $this->cassaFiscaleAggiornamento($id, $nOrdine, $tipo);
        return $this->db->Query($query);
    }

    public function cassaFiscaleAggiornamento($id, $nOrdine, $tipo) {

        if ($tipo === 'fornitore') {
            $infoQuery = "SELECT nome, cognome, ragioneSociale FROM {$this->tabella}.fornitori WHERE idFornitori = {$id}";
        } elseif ($tipo === 'struttura') {
            $infoQuery = "SELECT nome, cognome, struttura FROM {$this->tabella}.alberghi WHERE idAl = {$id}";
        } else {
            return false;
        }

        $this->db->Query($infoQuery);
        $infoRow = $this->db->Row();
        $dataCreazione = date('Y-m-d');
// Step 6: Inserire un record nella tabella cassa
       $insertQuery = "INSERT INTO {$this->tabella}.cassa (dataIncasso, Descrizione, uscite,idAzienda, idOperatore) 
                    VALUES ('{$dataCreazione}', '{$nOrdine} - {$infoRow->nome} {$infoRow->nome} -{$tipo}', '{$_POST['totale']}','{$_SESSION['idAzienda']}','{$_SESSION['idAmministratore']}')";
                 
        if ($this->db->Query($insertQuery)) {
            return $this->db->GetLastInsertID();
        }
        return false;
    }

    public function conteggioPrenotazioni(){

        $this->db->Query("SELECT count(*) as prenotazioni from {$_SESSION['tabella']}.prenotazione as p inner join {$_SESSION['tabella']}.tour as t on t.idTour=p.idTour left join {$_SESSION['tabella']}.fornitori as f on p.idFornitore=f.idFornitori inner join {$_SESSION['tabella']}.alberghi as a on p.idStruttura=a.idAl where a.email='{$_SESSION['email']}' AND a.idAzienda={$_SESSION['idAzienda']} AND cancellazione=1");
        $conteggio = $this->db->Row();
        return $conteggio->prenotazioni;
    }

    #conteggio cassa strutture
    public function conteggioCassaTour(){

        $this->db->Query("SELECT sum(commissioneSt) as guadagno from {$_SESSION['tabella']}.cassa_tour as c INNER join {$_SESSION['tabella']}.tour as t on t.idTour=c.idTour INNER JOIN {$_SESSION['tabella']}.prenotazione as p on p.idPrenotazione=c.idPrenotazione inner join {$_SESSION['tabella']}.alberghi as a on p.idStruttura=a.idAl  where cancellazione=1 and a.email='{$_SESSION['email']}'  order by c.dataCreazione 
        ");
        $guad = $this->db->Row();
        return $guad->guadagno;
    }
}
