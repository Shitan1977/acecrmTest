<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_fornitori extends MySQL {

    public $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function GestioneFornitori($idFornitori = null, $nome, $cognome, $indirizzo = null, $cap = null, $idProvincia = null, $idComune = null, $idRegione = null, $fisso = null, $mobile = null, $ragioneSociale = null, $email = null, $codiceFiscale = null, $iva = null, $pws = null, $sesso = null, $cancella = null) {


        $fornitori['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $fornitori['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $fornitori['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $fornitori['cap'] = MySQL::SQLValue($cap, MySQL::SQLVALUE_TEXT);
        $fornitori['idProvincia'] = MySQL::SQLValue($idProvincia, MySQL::SQLVALUE_TEXT);
        $fornitori['idComune'] = MySQL::SQLValue($idComune, MySQL::SQLVALUE_TEXT);
        $fornitori['idRegione'] = MySQL::SQLValue($idRegione, MySQL::SQLVALUE_TEXT);
        $fornitori['fisso'] = MySQL::SQLValue($fisso, MySQL::SQLVALUE_TEXT);
        $fornitori['mobile'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);
        $fornitori['ragioneSociale'] = MySQL::SQLValue($ragioneSociale, MySQL::SQLVALUE_TEXT);
        $fornitori['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $fornitori['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $fornitori['codiceFiscale'] = MySQL::SQLValue($codiceFiscale, MySQL::SQLVALUE_TEXT);
        $fornitori['iva'] = MySQL::SQLValue($iva, MySQL::SQLVALUE_TEXT);
        $fornitori['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $fornitori['pec'] = MySQL::SQLValue($_POST['pec'], MySQL::SQLVALUE_TEXT);
        $fornitori['cod_fornitore'] = MySQL::SQLValue($_POST['cod_fornitore'], MySQL::SQLVALUE_TEXT);        
        $fornitori['tipo'] = MySQL::SQLValue($_POST['tipo'], MySQL::SQLVALUE_TEXT);
        if (!empty($pws)) {
            $passcriptata = md5($pws);

            $fornitori['pws'] = MySQL::SQLValue($passcriptata, MySQL::SQLVALUE_TEXT);
        }

        $fornitori['livello'] = MySQL::SQLValue(4, MySQL::SQLVALUE_TEXT);
        $fornitori['username'] = MySQL::SQLValue($_SESSION['username'], MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.fornitori';

        if (isset($_POST['idFornitori'])) {
            $fornitorifiltro['idFornitori'] = MySQL::SQLValue($idFornitori, MySQL::SQLVALUE_TEXT);
            if (isset($cancella)) {

                if (!$this->db->DeleteRows($nomedb, $fornitorifiltro))
                    echo $this->db->Kill();
            } else {
                if (!$this->db->UpdateRows($nomedb, $fornitori, $fornitorifiltro))
                    echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($nomedb, $fornitori))
                echo $this->db->Kill();
        }

        @header('location:gestione-fornitori.php');
    }

    public function FornitoriSelect($idFornitore = null) {


        $this->db->Query("SELECT * FROM $this->tabella.fornitori");
        $forn = '<option value="">scegli...</option>';
        while ($forn1 = $this->db->Row()) {
            $forn .= '<option value="' . $forn1->idFornitori . '"';
            if ($idFornitore == $forn1->idFornitori) {
                $forn .= 'selected';
            }
            $forn .= '>' . utf8_encode($forn1->nome . ' ' . $forn1->cognome . ' ' . $forn1->ragioneSociale) . '</option>';
        }

        echo $forn;
    }

    #parte del carello utenti

    public function carrelloOrdini($ordine) {
        $this->db->Query("SELECT count(*) as totaleOrdini FROM $this->tabella.carrello_ordini where ordine={$ordine}");
        $cont = $this->db->Row();
        echo $cont->totaleOrdini;
    }

    public function carrelloOrdiniNonEvaso() {
        $this->db->Query("SELECT count(*) as totaleOrdini FROM $this->tabella.carrello_ordini where evaso=0");
        $cont = $this->db->Row();
        echo $cont->totaleOrdini;
    }

    public function selectFornitoreAuto() {

        $this->db->Query("SELECT  *, concat(nome, cognome) as nominativo FROM {$this->tabella}.fornitori");
        $client = '';
        while ($cli = $this->db->Row()) {
            if (empty($cli->nome) && empty($cli->cognome)) {
                $client .= '"' . addslashes($cli->ragioneSociale) . '",';
            } else {
                $client .= '"' . addslashes($cli->nominativo) . '",';
            }
        }
        echo $client;
    }
}
