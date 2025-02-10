<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_azienda extends MySQL {

    private $tabella;
    public $facebook;
    public $google;
    public $pinterest;
    public $youtube;
    public $linkedin;
    public $testo;
    public $marketplacecol;
    public $tipologia;
    public $iva;
    public $indirizzo;
    public $tel;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function markeplace($idAzienda, $testo = null, $marketplacecol = null, $logo_name = NULL, $logo_tmp = NULL, $indirizzo = null, $tipologia = null, $iva = null, $provincia = null, $comuni = null, $tel = null) {

        $file_dir = "images/loghi/";
        $aziendamarkplace['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $aziendamarkplace['testo'] = MySQL::SQLValue($testo, MySQL::SQLVALUE_TEXT);
        $aziendamarkplace['marketplacecol'] = MySQL::SQLValue($marketplacecol, MySQL::SQLVALUE_TEXT);
        if (!empty($logo_name)) {
            $azienda['logo'] = MySQL::SQLValue($logo_name, MySQL::SQLVALUE_TEXT);
        }
        $azienda['ragioneSociale'] = MySQL::SQLValue($marketplacecol, MySQL::SQLVALUE_TEXT);
        $azienda['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $azienda['tipologia'] = MySQL::SQLValue($tipologia, MySQL::SQLVALUE_TEXT);
        $azienda['iva'] = MySQL::SQLValue($iva, MySQL::SQLVALUE_TEXT);
        $azienda['idProvincia'] = MySQL::SQLValue($provincia, MySQL::SQLVALUE_TEXT);
        $azienda['idComune'] = MySQL::SQLValue($comuni, MySQL::SQLVALUE_TEXT);
        $azienda['tel'] = MySQL::SQLValue($tel, MySQL::SQLVALUE_TEXT);
        $aziendafiltro['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);

        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $logo_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($logo_tmp, $file_target)) {
            echo "{$logo_name} Caricati con successo. <br />";
        } else {
            echo "Mi spiace, non è stato possibile caricare {$logo_name}.";
        }

        $nomedb = 'admin_' . $this->tabella . '.marketplace';
        $nomedb2 = 'admin_acecrm.azienda';
        $this->db->Query("SELECT *  FROM admin_$this->tabella.marketplace WHERE idAzienda={$_SESSION['idAzienda']}");
        if ($this->db->RowCount() > 0) {
            if (!$this->db->UpdateRows($nomedb, $aziendamarkplace, $aziendafiltro))
                echo $this->db->Kill();
            if (!$this->db->UpdateRows($nomedb2, $azienda, $aziendafiltro))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($nomedb, $aziendamarkplace))
                echo $this->db->Kill();
            if (!$this->db->UpdateRows($nomedb2, $azienda, $aziendafiltro))
                echo $this->db->Kill();
        }

        @header('location:gestione-azienda.php');
    }

    public function social($facebook = null, $google = null, $pinterest = null, $youtube = null, $linkedin = null) {

        $aziendasocial['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $aziendasocial['facebook'] = MySQL::SQLValue($_POST['facebook'], MySQL::SQLVALUE_TEXT);
        $aziendasocial['google'] = MySQL::SQLValue($_POST['google'], MySQL::SQLVALUE_TEXT);
        $aziendasocial['pinterest'] = MySQL::SQLValue($_POST['pinterest'], MySQL::SQLVALUE_TEXT);
        $aziendasocial['youtube'] = MySQL::SQLValue($_POST['youtube'], MySQL::SQLVALUE_TEXT);
        $aziendasocial['linkedin'] = MySQL::SQLValue($_POST['linkedin'], MySQL::SQLVALUE_TEXT);
        $aziendafiltro['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $nomedb = 'admin_' . $this->tabella . '.social';
        $this->db->Query("SELECT *  FROM $nomedb WHERE idAzienda={$_SESSION['idAzienda']}");
        if ($this->db->RowCount() > 0) {
            if (!$this->db->UpdateRows($nomedb, $aziendasocial, $aziendafiltro))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($nomedb, $aziendasocial))
                echo $this->db->Kill();
        }

        @header('location:gestione-azienda.php');
    }

    public function VisualizzazioneAzienda() {

        $nomedb = 'admin_' . $this->tabella;

        $this->db->Query("SELECT * FROM admin_acecrm.azienda as a  LEFT JOIN $nomedb.social  as s ON a.idAzienda =s.idAzienda  LEFT JOIN $nomedb.marketplace m ON a.idAzienda=m.idAzienda  WHERE a.idAzienda={$_SESSION['idAzienda']}");
        $aziendavisualizzazione = $this->db->Row();
        $this->testo = $aziendavisualizzazione->testo;
        $this->marketplacecol = $aziendavisualizzazione->marketplacecol;
        $this->facebook = $aziendavisualizzazione->facebook;
        $this->google = $aziendavisualizzazione->google;
        $this->pinterest = $aziendavisualizzazione->pinterest;
        $this->youtube = $aziendavisualizzazione->youtube;
        $this->linkedin = $aziendavisualizzazione->linkedin;
        $this->tipologia = $aziendavisualizzazione->tipologia;
        $this->indirizzo = $aziendavisualizzazione->indirizzo;
        $this->iva = $aziendavisualizzazione->iva;
        $this->tel = $aziendavisualizzazione->tel;
    }

    public function creazioneAzienda($ragioneSociale, $tipologia, $iva, $indirizzo, $idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda = null) {

        $insertAzienda['ragioneSociale'] = MySQL::SQLValue($ragioneSociale, MySQL::SQLVALUE_TEXT);
        $insertAzienda['tipologia'] = MySQL::SQLValue($tipologia, MySQL::SQLVALUE_TEXT);
        $insertAzienda['iva'] = MySQL::SQLValue($iva, MySQL::SQLVALUE_TEXT);
        $insertAzienda['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $insertAzienda['idProvincia'] = MySQL::SQLValue($idProvicia, MySQL::SQLVALUE_TEXT);
        $insertAzienda['idComune'] = MySQL::SQLValue($idComune, MySQL::SQLVALUE_TEXT);

        $insertAzienda['tel'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);

        $insertAzienda['idSede'] = MySQL::SQLValue(0, MySQL::SQLVALUE_TEXT);
        $insertAziendaFil['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        if (!empty($idAzienda)) {
            if (!$this->db->UpdateRows('admin_acecrm.azienda', $insertAzienda, $insertAziendaFil))
                echo $this->db->Kill();
            // inserimento amministratore e creazione
            $this->updateAmm($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
        } else {

            if (!$this->db->InsertRow('admin_acecrm.azienda', $insertAzienda))
                echo $this->db->Kill();

            $this->prelievoAzienda($ragioneSociale, $idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username);
            #aggiornamento amministratore 
        }
    }

    public function prelievoAzienda($ragioneSociale, $idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username) {

        $this->db->Query("SELECT * FROM admin_acecrm.azienda  WHERE ragioneSociale='$ragioneSociale' ORDER BY idAzienda DESC");
        $estraggo = $this->db->Row();

        // creazione tabella amministratore con insert
        $this->insertAmministratore($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $estraggo->idAzienda);
    }

    public function insertAmministratore($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE {$nomedb}.amministratore (
  `idAmministratore` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cognome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `indirizzo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cap` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `idProvincia` int(11) unsigned DEFAULT NULL,
  `idComune` int(11) unsigned DEFAULT NULL,
  `tel` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `mobile` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sesso` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `idRuolo` int(11) unsigned DEFAULT NULL,
  `idAzienda` int(11) unsigned DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `codiceFiscale` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `livello` int(11) DEFAULT NULL,
  `pws` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `username` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`idAmministratore`))";

        $this->db->Query($sql);

        $this->creazioneMarketplace($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function creazioneMarketplace($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.marketplace (
  `idMark` int(11) NOT NULL AUTO_INCREMENT,
  `idAzienda` int(11) DEFAULT NULL,
  `testo` text DEFAULT NULL,
  `marketplacecol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMark`))";
        $this->db->Query($sql);

        $this->creazioneAppuntamenti($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function creazioneAppuntamenti($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.appuntamenti (
  `idAppuntamenti` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) unsigned DEFAULT NULL,
  `idAzienda` int(11) unsigned DEFAULT NULL,
  `testo` text NOT NULL,
  `str_data` int(10) NOT NULL DEFAULT 0,
  `idPostazione` int(10) unsigned DEFAULT NULL,
  `orario` time NOT NULL,
  `idOperatore` int(10) unsigned DEFAULT NULL,
  `idAmministratore` int(10) unsigned DEFAULT NULL,
  `obiettivi` text DEFAULT NULL,
  PRIMARY KEY (`idAppuntamenti`))";
        $this->db->Query($sql);

        $this->creazionePermessi($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function creazionePermessi($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.permessi (
  `idPermesso` int(11) NOT NULL AUTO_INCREMENT,
  `idModuli` int(11) unsigned DEFAULT NULL,
  `idRuolo` int(11) unsigned DEFAULT NULL,
  `idAzienda` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idPermesso`))";
        $this->db->Query($sql);

        $this->creazionePostazione($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function creazionePostazione($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.postazioni (
  `idPostazioni` int(11) NOT NULL AUTO_INCREMENT,
  `postazione` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPostazioni`))";
        $this->db->Query($sql);

        $this->creazioneRuolo($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function creazioneRuolo($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.ruolo (
  `idRuolo` int(11) NOT NULL AUTO_INCREMENT,
  `ruolo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `idAzienda` int(11) DEFAULT NULL,
  `idAmministratore` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idRuolo`))";
        $this->db->Query($sql);

        $this->creazioneSocial($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function creazioneSocial($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.social (
  `idSocial` int(11) NOT NULL AUTO_INCREMENT,
  `facebook` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `idAzienda` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idSocial`))";
        $this->db->Query($sql);

        $this->insertAmm($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda);
    }

    public function insertAmm($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        echo $nomedb = 'admin_' . $username;
        $insAmm['idProvincia'] = MySQL::SQLValue($idProvicia, MySQL::SQLVALUE_TEXT);
        $insAmm['idComune'] = MySQL::SQLValue($idComune, MySQL::SQLVALUE_TEXT);
        $insAmm['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $insAmm['cognome'] = MySQL::SQLValue($cogonome, MySQL::SQLVALUE_TEXT);
        $insAmm['mobile'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);
        $insAmm['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $insAmm['username'] = MySQL::SQLValue($username, MySQL::SQLVALUE_TEXT);
        $insAmm['livello'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $insAmm['idRuolo'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $insAmm['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $insAmm['amministratore'] = MySQL::SQLValue(md5('cambiami'), MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($nomedb . '.amministratore', $insAmm))
            echo $this->db->Kill();

        $this->insertRuolo($idAzienda, $username);
    }

    public function insertRuolo($idAzienda) {
        $nomedb = 'admin_' . $username;
        $insAmm['ruolo'] = MySQL::SQLValue('Amministratore', MySQL::SQLVALUE_TEXT);
        $insAmm['idAmministratore'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $insAmm['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($nomedb . '.ruolo', $insAmm))
            echo $this->db->Kill();
        $this->messaggio();
    }

    #gestione update

    public function updateAmm($idProvicia, $idComune, $nome, $cogonome, $mobile, $email, $username, $idAzienda) {
        $nomedb = 'admin_' . $username;
        $updAmm['idProvincia'] = MySQL::SQLValue($idProvicia, MySQL::SQLVALUE_TEXT);
        $updAmm['idComune'] = MySQL::SQLValue($idComune, MySQL::SQLVALUE_TEXT);
        $updAmm['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $updAmm['cognome'] = MySQL::SQLValue($cogonome, MySQL::SQLVALUE_TEXT);
        $updAmm['mobile'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);
        $updAmm['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        $updAmm['username'] = MySQL::SQLValue($username, MySQL::SQLVALUE_TEXT);
        $updAmm['idRuolo'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $updAmmFil['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRow($nomedb . '.amministratore', $updAmm, $updAmmFil))
            echo $this->db->Kill();

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    #select azienda

    public function selectAzienda($idAzienda = null) {

        $this->db->Query("SELECT * FROM admin_acecrm.azienda");
        $selAzienda = '<option value="">scegli il modulo...</option>';
        while ($selAziendaC = $this->db->Row()) {
            $selAzienda .= '<option value="' . $selAziendaC->idAzienda . '">' . utf8_encode($selAziendaC->ragioneSociale) . '</option>';
        }

        return $selAzienda;
    }

}
