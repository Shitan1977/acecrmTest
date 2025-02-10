<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_schemaSql extends MySQL {

    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function creaSchema($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.anagrafica (
  `idAnagrafica` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `indirizzo` text DEFAULT NULL,
  `cap` varchar(45) DEFAULT NULL,
  `idProvincia` int(11) unsigned DEFAULT NULL,
  `idComune` int(11) unsigned DEFAULT NULL,
  `idRegione` int(11) unsigned DEFAULT NULL,
  `fisso` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `ragioneSociale` varchar(255) DEFAULT NULL,
  `idAzienda` int(11) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `codiceFiscale` varchar(255) DEFAULT NULL,
  `iva` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `pws` varchar(45) DEFAULT NULL,
  `sesso` varchar(45) DEFAULT NULL,
  `livello` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAnagrafica`)
)";
        $this->db->Query($sql);
        $this->cassaSchema($username);
    }

    public function cassaSchema($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.cassa (
  `idCassa` int(11) NOT NULL AUTO_INCREMENT,
  `idAzienda` varchar(45) DEFAULT NULL,
  `dataIncasso` date DEFAULT NULL,
  `entrate` double DEFAULT NULL,
  `Descrizione` text DEFAULT NULL,
  `uscite` double DEFAULT NULL,
  `idOperatore` int(11) DEFAULT NULL,
  `codiceOperazione` varchar(50) DEFAULT 'Scontrino Fiscale',
  PRIMARY KEY (`idCassa`)
) ";
        $this->db->Query($sql);
        $this->mysqlSchema($username);
    }

    public function mysqlSchema($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.mysql (
   `idMysql` int(11) NOT NULL AUTO_INCREMENT,
  `mysql_username` varchar(255) DEFAULT NULL,
  `mysql_db` varchar(255) DEFAULT NULL,
  `mysql_login` varchar(255) DEFAULT NULL,
  `ip_mysql` varchar(155) DEFAULT NULL,
  `idAzienda` int(10) unsigned DEFAULT NULL,
  `idAnagrafica` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idMysql`)
) ";
        $this->db->Query($sql);
        $this->pws_personaliSchema($username);
    }

    public function pws_personaliSchema($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.pws_personali (
    `idPersonale` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `idAzienda` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `domandaChiave` varchar(255) DEFAULT NULL,
  `idOperatore` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPersonale`)
) ";
        $this->db->Query($sql);
        $this->serverSchema($username);
    }

    public function serverSchema($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.server (
    `idServer` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(255) DEFAULT NULL,
  `idAzienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idServer`)) ";
        $this->db->Query($sql);
        $this->siti_web($username);
    }

    public function siti_web($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.siti_web (
     `idSito` int(11) NOT NULL AUTO_INCREMENT,
  `username_web` varchar(80) DEFAULT NULL,
  `password_web` varchar(80) DEFAULT NULL,
  `hosting` varchar(80) DEFAULT NULL,
  `server` varchar(150) DEFAULT NULL,
  `ip_server` varchar(45) DEFAULT NULL,
  `pannellodicontrollo` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `credenziali_accesso` varchar(255) DEFAULT NULL,
  `idMysql` varchar(45) DEFAULT NULL,
  `idAzienda` int(10) unsigned DEFAULT NULL,
  `idAnagrafica` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idSito`))";
        $this->db->Query($sql);
        $this->marketplace($username);
    }

    public function marketplace($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.marketplace (
   `idMark` int(11) NOT NULL AUTO_INCREMENT,
  `idAzienda` int(11) DEFAULT NULL,
  `testo` text DEFAULT NULL,
  `marketplacecol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMark`))";
        $this->db->Query($sql);
        $this->amministratore($username);
    }

    public function amministratore($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.amministratore (
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
        $this->appuntamenti($username);
    }

    public function appuntamenti($username) {
        #creiamo la tabella anagrafica
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE $nomedb.appuntamenti (
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
        $this->creazionePermessi($username);
    }

    public function creazionePermessi($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.permessi (
  `idPermesso` int(11) NOT NULL AUTO_INCREMENT,
  `idModuli` int(11) unsigned DEFAULT NULL,
  `idRuolo` int(11) unsigned DEFAULT NULL,
  `idAzienda` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idPermesso`))";
        $this->db->Query($sql);

        $this->creazionePostazione($username);
    }

    public function creazionePostazione($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.postazioni (
  `idPostazioni` int(11) NOT NULL AUTO_INCREMENT,
  `postazione` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPostazioni`))";
        $this->db->Query($sql);

        $this->creazioneRuolo($username);
    }

    public function creazioneRuolo($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.ruolo (
  `idRuolo` int(11) NOT NULL AUTO_INCREMENT,
  `ruolo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `idAzienda` int(11) DEFAULT NULL,
  `idAmministratore` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idRuolo`))";
        $this->db->Query($sql);

        $this->creazioneSocial($username);
    }

    public function creazioneSocial($username) {
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

        $this->creazioneFornitori($username);
    }

    public function creazioneFornitori($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.fornitori (
       `idFornitori` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `cap` varchar(45) DEFAULT NULL,
  `idProvincia` int(10) unsigned DEFAULT NULL,
  `idComune` int(10) unsigned DEFAULT NULL,
  `idRegione` int(10) unsigned DEFAULT NULL,
  `fisso` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `ragioneSociale` varchar(255) DEFAULT NULL,
  cod_fornitore varchar(20) NOT NULL DEFAULT '',
  `cont_fornitore` int(11) NOT NULL,
  `interfaccia` varchar(50) DEFAULT NULL,
  `idAzienda` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `codiceFiscale` varchar(45) DEFAULT NULL,
  `iva` varchar(45) DEFAULT NULL,
  `pws` varchar(255) DEFAULT NULL,
  `livello` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `sito_web` varchar(50) DEFAULT NULL,
  `sede_operativa` varchar(50) DEFAULT NULL,
   `tipo` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `prodotto` varchar(50) DEFAULT NULL,
  `certificazione_sgq` varchar(50) DEFAULT NULL,
  `scadenza_cert` varchar(50) DEFAULT NULL,
  `notifica_nc` varchar(50) DEFAULT NULL,
  `stato` varchar(50) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `eliminato` tinyint(1) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`idFornitori`)
)";
        $this->db->Query($sql);

        $this->creazioneFatture($username);
    }

    public function creazioneFatture($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.fatture (
  `idFattura` int(11) NOT NULL AUTO_INCREMENT,
  `progressivo` varchar(40) DEFAULT NULL,
  `idAnagrafica` int(10) unsigned DEFAULT NULL,
  `idFornitore` int(10) unsigned DEFAULT NULL,
  `oggetto` varchar(255) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `tipo` enum('fornitore','cliente') DEFAULT NULL,
  `dataFattura` date DEFAULT NULL,
  `idAzienda` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idFattura`)
)";

        $this->db->Query($sql);

        $this->creazioneListino($username);
    }

    public function creazioneListino($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.listini (
   `idListino` int(11) NOT NULL AUTO_INCREMENT,
  `idLotto` varchar(45) DEFAULT NULL,
  `prezzo` double(10,2) DEFAULT NULL,
  `margine` double(10,2) DEFAULT NULL,
  `idFornitore` varchar(45) DEFAULT NULL,
  `listino` varchar(45) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  `idProdotto` int(10) unsigned DEFAULT NULL,
  `default` int(4) DEFAULT 0,
  PRIMARY KEY (`idListino`)
)";

        $this->db->Query($sql);

        $this->creazionedettList($username);
    }

    public function creazionedettList($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.dettList (
  `idDettList` int(11) NOT NULL AUTO_INCREMENT,
  `idProdotto` int(10) unsigned DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  `prezzoF` double(10,2) DEFAULT NULL,
  `prezzo` double(10,2) DEFAULT NULL,
  `idListino` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idDettList`)
)";

        $this->db->Query($sql);

        $this->creazioneattributi($username);
    }

    public function creazioneattributi($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attributi (
   `idAttributi` int(11) NOT NULL AUTO_INCREMENT,
  `attributo` varchar(45) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idAttributi`))";

        $this->db->Query($sql);

        $this->creazioneattributiProd($username);
    }

    public function creazioneattributiProd($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attributi (
    `idAttributi` int(11) NOT NULL AUTO_INCREMENT,
  `idaccessori` int(10) unsigned DEFAULT NULL,
  `idProdotto` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idAttributi`))";

        $this->db->Query($sql);

        $this->creazioneAccessori($username);
    }

    public function creazioneAccessori($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attributi (
    `idaccessori` int(11) NOT NULL AUTO_INCREMENT,
  `dataCreazione` date DEFAULT NULL,
  `barcode` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `quant` varchar(45) DEFAULT NULL,
  `condizione` varchar(45) DEFAULT NULL,
  `idProdotto` varchar(45) DEFAULT NULL,
  `accessorio` varchar(80) DEFAULT NULL,
  `specie` varchar(45) DEFAULT NULL,
  `web` int(11) DEFAULT 0, PRIMARY KEY (`idaccessori`))";

        $this->db->Query($sql);

        $this->creazioneAttributiValore($username);
    }

    public function creazioneAttributiValore($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attributi (
   `idAttributoVal` int(11) NOT NULL AUTO_INCREMENT,
  `idAttributo` int(10) unsigned DEFAULT NULL,
  `valore` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAttributoVal`))";

        $this->db->Query($sql);

        $this->creazioneProdotto($username);
    }

    public function creazioneProdotto($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.prodotto (
  `idProdotto` int(11) NOT NULL AUTO_INCREMENT,
  `prodotto` varchar(255) DEFAULT NULL,
  `barcode` varchar(45) DEFAULT NULL,
  `idMarca` int(11) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `condizioni` varchar(45) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  `idLotto` int(11) DEFAULT NULL,
  `qyt` varchar(45) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProdotto`))";

        $this->db->Query($sql);

        $this->creazioneCategoria($username);
    }

    public function creazioneCategoria($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.categorie (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  `dataModifica` date DEFAULT NULL,
  `idOperatore` int(10) unsigned DEFAULT NULL,
  `idSottocategoria` varchar(45) DEFAULT '2',
  PRIMARY KEY (`idCategorie`))";

        $this->db->Query($sql);

        $this->creazionePacchetti($username);
    }

    public function creazionePacchetti($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.pacchetti (
   `idPacchetto` int(11) NOT NULL AUTO_INCREMENT,
  `pachetto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idPacchetto`))";

        $this->db->Query($sql);

        $this->creazioneServizi($username);
    }

    public function creazioneServizi($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.servizi (
   `idServizi` int(11) NOT NULL AUTO_INCREMENT,
  `idPachetto` varchar(45) DEFAULT NULL,
  `servizio` varchar(255) DEFAULT NULL,
  `prezzo` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`idServizi`))";

        $this->db->Query($sql);

        $this->creazioneProdotti($username);
    }

    public function creazioneProdotti($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.prodotto (
     `idProdotto` int(11) NOT NULL AUTO_INCREMENT,
  `prodotto` varchar(255) DEFAULT NULL,
  `barcode` varchar(45) DEFAULT NULL,
  `idMarca` int(11) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `condizioni` varchar(45) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  `idLotto` int(11) DEFAULT NULL,
  `qyt` varchar(45) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProdotto`)
))";

        $this->db->Query($sql);

        $this->impostazioniNegozio($username);
    }

    public function impostazioniNegozio($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.impostazioniNegozio (
     `idNegozio` INT NOT NULL AUTO_INCREMENT,
  `sito` VARCHAR(255) NULL,
  `host` VARCHAR(255) NULL,
  `user` VARCHAR(255) NULL,
  `pwsSito` VARCHAR(255) NULL,
  `idAzienda` INT UNSIGNED NULL,
  PRIMARY KEY (`idNegozio`))";

        $this->db->Query($sql);

        $this->carrello_online($username);
    }

    public function carrello_online($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.carrello_online (
   `idCarello` int(11) NOT NULL AUTO_INCREMENT,
  `idProdotto` int(10) unsigned DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idCarello`))";

        $this->db->Query($sql);

        $this->carrello_ordini($username);
    }

    public function carrello_ordini($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.carrello_ordini (
   `idOrdine` int(11) NOT NULL AUTO_INCREMENT,
  `ordine` int(11) unsigned DEFAULT NULL,
  `idProdotto` int(11) unsigned DEFAULT NULL,
  `quantita` int(11) unsigned DEFAULT NULL,
  `idFornitore` int(11) unsigned DEFAULT NULL,
  `evaso` int(11) unsigned DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idOrdine`),
  KEY `idProdotto` (`idProdotto`),
  KEY `idFornitore` (`idFornitore`))";

        $this->db->Query($sql);

        $this->carrelloFornitori($username);
    }

    public function carrelloFornitori($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.carrelloFornitori (
   `idOrdine` int(11) NOT NULL AUTO_INCREMENT,
  `ordine` int(11) unsigned DEFAULT NULL,
  `idProdotto` int(11) unsigned DEFAULT NULL,
  `quantita` int(11) unsigned DEFAULT NULL,
  `idFornitore` int(11) unsigned DEFAULT NULL,
  `evaso` int(11) unsigned DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idOrdine`),
  KEY `idProdotto` (`idProdotto`),
  KEY `idFornitore` (`idFornitore`))";

        $this->db->Query($sql);

        $this->estrattoConto($username);
    }

    public function estrattoConto($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.estrattoConto (
     `idEstratto` INT NOT NULL AUTO_INCREMENT,
  `idAnagrafica` INT UNSIGNED NULL,
  `idFornitori` INT UNSIGNED NULL,
  `idCollaboratori` INT UNSIGNED NULL,
  `idAvvocati` INT UNSIGNED NULL,
  `idCommercialista` INT UNSIGNED NULL,
  `idCassa` INT UNSIGNED NULL,
  PRIMARY KEY (`idEstratto`));)";

        $this->db->Query($sql);

        $this->supporto($username);
    }

    public function supporto($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.supporto (
       `idSupporto` INT NOT NULL AUTO_INCREMENT,
        `idAzienda` INT UNSIGNED NULL,
  `oggetto` VARCHAR(45) NULL,
  `stato` VARCHAR(45) NULL,
    `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idSupporto`));";

        $this->db->Query($sql);

        $this->oda($username);
    }

    public function oda($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.oda (
   `id_master` int(11) NOT NULL,
  `n_ordine` int(11) NOT NULL DEFAULT '0',
  `revisione` int(11) NOT NULL DEFAULT '0',
  `data_emissione` date DEFAULT NULL,
  `cod_fornitore` varchar(20) DEFAULT NULL,
  `pagamento` varchar(100) DEFAULT NULL,
  `spedizione` varchar(100) DEFAULT NULL,
  `consegna` varchar(100) DEFAULT NULL,
  `imballo` varchar(50) DEFAULT NULL,
  `collaudo` varchar(50) DEFAULT NULL,
  `idc_attivita` varchar(50) DEFAULT NULL,
  `riferimento` varchar(100) DEFAULT NULL,
  `tot_imponibile` varchar(20) DEFAULT NULL,
  `iva` varchar(10) DEFAULT NULL,
  `imponibile_iva` varchar(20) DEFAULT NULL,
  `altro` varchar(20) DEFAULT NULL,
  `totale` varchar(20) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

        $this->db->Query($sql);

        $this->attivita($username);
    }

    public function attivita($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attivita (
   `id` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_composto` varchar(20) DEFAULT NULL,
  `cod_cliente` varchar(20) DEFAULT NULL,
  `committente` varchar(50) DEFAULT NULL,
  `att_richiesta` varchar(50) DEFAULT NULL,
  `rich_pervenuta` varchar(50) DEFAULT NULL,
  `data_chiusura` date DEFAULT NULL,
  `data_effettiva_chiusura` date DEFAULT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `att_completate` varchar(20) DEFAULT NULL,
  `att_opz_completate` varchar(20) DEFAULT NULL,
  `stato` varchar(20) DEFAULT NULL,
  `centro_di_costo` varchar(50) DEFAULT NULL,
  `tipologia_attivita` varchar(50) DEFAULT NULL,
  `data_inserimento` date DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `cliente` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dbm` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->db->Query($sql);

        $this->marche($username);
    }

    public function marche($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.marche (
    `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idMarca`)
) ";

        $this->db->Query($sql);

        $this->suppDett($username);
    }

    public function suppDett($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.suppDett (
     `idsuppDett` INT NOT NULL AUTO_INCREMENT,
  `idSupporto` INT UNSIGNED NULL,
  `corpo` TEXT NULL,
  `operatore` VARCHAR(45) NULL,
  PRIMARY KEY (`idsuppDett`)) ";

        $this->db->Query($sql);

        $this->fileManagement($username);
    }

    public function fileManagement($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.fileManagement (
    `idFile` int(11) NOT NULL AUTO_INCREMENT,
  `cartella` varchar(150) DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idFile`))";

        $this->db->Query($sql);

        $this->archivioFile($username);
    }

    public function archivioFile($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.archivioFile (
    `idArchivio` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `idFile` int(10) unsigned DEFAULT NULL,
  `dataCreazione` date DEFAULT NULL,
  PRIMARY KEY (`idArchivio`))";

        $this->db->Query($sql);

        $this->Macchine($username);
    }

    public function Macchine($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.Macchine (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT '0',
  `denominazione` varchar(50) DEFAULT NULL,
  `costruttore` varchar(50) DEFAULT NULL,
  `dimensioni` varchar(50) DEFAULT NULL,
  `matricola_interna` varchar(50) DEFAULT NULL,
  `matricola_costruttore` varchar(50) DEFAULT NULL,
  `assi` varchar(50) DEFAULT NULL,
  `messa` varchar(50) DEFAULT NULL,
  `luogo` varchar(50) DEFAULT NULL,
  `amso` tinyint(1) DEFAULT NULL,
  `amss` tinyint(1) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_At` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->workstation($username);
    }

    public function workstation($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.workstation (
  `id` int(11) NOT NULL,
  `denominazione` varchar(50) DEFAULT NULL,
  `costruttore` varchar(50) DEFAULT NULL,
  `matricola` varchar(50) NOT NULL DEFAULT '',
  `messa_servizio` varchar(50) DEFAULT NULL,
  `ubicazione` varchar(50) DEFAULT NULL,
  `operatore` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '')";

        $this->db->Query($sql);

        $this->strumento($username);
    }

    public function strumento($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.strumento (
   `codice` varchar(50) NOT NULL DEFAULT '',
  `tipo` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `frequenza` varchar(50) DEFAULT NULL,
  `ubicazione` varchar(50) DEFAULT NULL,
  `range_taratura` varchar(50) DEFAULT NULL,
  `risoluzione` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL,
  `entry_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL)";

        $this->db->Query($sql);

        $this->ddt($username);
    }

    public function ddt($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.ddt (
   `id_master` int(11) NOT NULL,
  `n_ddt` int(11) NOT NULL DEFAULT '0',
  `data_emissione` date DEFAULT NULL,
  `destinatario` varchar(20) DEFAULT NULL,
  `cod_destinatario` varchar(20) DEFAULT NULL,
  `ragione_sociale` varchar(100) DEFAULT NULL,
  `flag_dest` tinyint(1) DEFAULT NULL,
  `sede_op_custom` varchar(200) DEFAULT NULL,
  `riferimento` varchar(200) DEFAULT NULL,
  `idc_attivita` varchar(50) DEFAULT NULL,
  `annotazioni` varchar(200) DEFAULT NULL,
  `vettore` varchar(500) DEFAULT NULL,
  `asp_esteriore` varchar(50) DEFAULT NULL,
  `n_colli` int(11) DEFAULT NULL,
  `causale` varchar(50) DEFAULT NULL,
  `firma` varchar(100) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `entry_by` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->time_report($username);
    }

    public function time_report($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.time_report (
   `id` int(11) NOT NULL,
  `id_attivita` int(11) DEFAULT NULL,
  `idc_attivita` varchar(50) DEFAULT NULL,
  `cliente` varchar(20) DEFAULT NULL,
  `giorno` date DEFAULT NULL,
  `orainizio` datetime DEFAULT NULL,
  `orafine` datetime DEFAULT NULL,
  `referente` varchar(100) DEFAULT NULL,
  `desc_attivita` varchar(100) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `tipo_intervento` varchar(50) DEFAULT NULL,
  `email_risorsa` varchar(100) DEFAULT NULL,
  `nome_azienda_app` varchar(20) DEFAULT NULL,
  `entry_by` varchar(20) DEFAULT NULL,
  `anno` int(4) DEFAULT NULL,
  `att_richiesta` varchar(50) DEFAULT NULL,
  `durata` varchar(255) DEFAULT NULL,
  `costo` float(10,2) DEFAULT NULL,
  `orelavorate` float(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->v_consegna($username);
    }

    public function v_consegna($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.v_consegna (
  `id_master` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT '0',
  `rif_commessa` varchar(20) DEFAULT NULL,
  `spettabile` varchar(20) DEFAULT NULL,
  `cod_cliente` text NOT NULL,
  `cod_fornitore` varchar(45) NOT NULL,
  `data1` date DEFAULT NULL,
  `ordine` varchar(50) DEFAULT NULL,
  `data2` date DEFAULT NULL,
  `n_ddt` varchar(20) DEFAULT NULL,
  `ing1` varchar(50) DEFAULT NULL,
  `ing2` varchar(50) DEFAULT NULL,
  `ing3` varchar(50) DEFAULT NULL,
  `oggetto` varchar(50) DEFAULT NULL,
  `descrizione` varchar(500) DEFAULT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `entry_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->v_riunione($username);
    }

    public function v_riunione($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.v_riunione (
   `id_master` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT '0',
  `programma` varchar(100) DEFAULT NULL,
  `oggetto` varchar(100) DEFAULT NULL,
  `luogo` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `allegati` varchar(100) DEFAULT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `entry_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->v_milestone($username);
    }

    public function v_milestone($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.v_milestone (
  `id_master` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT '0',
  `data` date DEFAULT NULL,
  `rif` varchar(20) DEFAULT NULL,
  `del` date DEFAULT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `entry_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->coc($username);
    }

    public function coc($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.coc (
  `id_master` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT '0',
  `acquirente` varchar(50) DEFAULT NULL,
  `rag_soc_cliente` varchar(50) DEFAULT NULL,
  `n_ordine` varchar(50) DEFAULT NULL,
  `cliente` varchar(10) DEFAULT NULL,
  `anno` varchar(10) DEFAULT NULL,
  `att_richiesta` varchar(20) DEFAULT NULL,
  `idc_attivita` varchar(20) DEFAULT NULL,
  `ordine` varchar(20) DEFAULT NULL,
  `del` date DEFAULT NULL,
  `anno_ordine` varchar(50) DEFAULT NULL,
  `order_ref` varchar(50) DEFAULT NULL,
  `variante_ordine` varchar(50) DEFAULT NULL,
  `inviato_a` varchar(50) DEFAULT NULL,
  `data_coc` date DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `entry_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL)";

        $this->db->Query($sql);

        $this->attivita_4($username);
    }

    public function attivita_4($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attivita_4 (
 `id` int(11) NOT NULL,
  `id_attivita` int(11) NOT NULL DEFAULT '0',
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `nome_file` varchar(150) DEFAULT NULL,
  `n_ordine` varchar(50) DEFAULT NULL,
  `data_ordine` date DEFAULT NULL,
  `importo_ordine` decimal(10,2) DEFAULT NULL)";
        $this->db->Query($sql);

        $this->attivita_3($username);
    }

    public function attivita_3($username) {
        $nomedb = 'admin_' . $username;
        $sql = "CREATE TABLE  {$nomedb}.attivita_3 (
 `id_attivita` int(11) NOT NULL DEFAULT '0',
  `nome_azienda_app` varchar(20) NOT NULL DEFAULT '',
  `accettazione` varchar(30) DEFAULT NULL,
  `motivazione` varchar(500) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL)";
        $this->db->Query($sql);

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Schema Creato');</script>";
    }

}
