<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_moduli extends MySQL {

    private $tabella;
    public $db;
    public $nomedb;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
        $this->nomedb = "admin_" . $tabella;
    }

    public function inserimentoModuli($categoria, $note, $icona_interna, $idCategoria = null) {
        $cat['categoria'] = MySQL::SQLValue($categoria, MySQL::SQLVALUE_TEXT);
        $cat['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $cat['icone_interne'] = MySQL::SQLValue($icona_interna, MySQL::SQLVALUE_TEXT);
        $catF['idCatMod'] = MySQL::SQLValue($idCategoria, MySQL::SQLVALUE_TEXT);

        if (!empty($idCategoria)) {
            if (!$this->db->UpdateRows('admin_acecrm.categoria_moduli', $cat, $catF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow('admin_acecrm.categoria_moduli', $cat))
                echo $this->db->Kill();
        }

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    # sselezione delle categorie moduli

    public function selectCatMod($idCatMod = null) {


        $this->db->Query("SELECT * FROM admin_acecrm.categoria_moduli order by categoria");
        $selMod = '<option value="">scegli il modulo...</option>';
        while ($selModCat = $this->db->Row()) {
            $selMod .= '<option value="' . $selModCat->idCatMod . '">' . utf8_encode($selModCat->categoria) . '</option>';
        }

        return $selMod;
    }

    #select moduli

    public function selectMod($idModuli = null) {

        $this->db->Query("SELECT * FROM admin_acecrm.moduli order by modulo");
        $selModi = '<option value="">scegli il modulo...</option>';
        while ($selModCat = $this->db->Row()) {
            $selModi .= '<option value="' . $selModCat->idModuli . '">' . utf8_encode($selModCat->modulo) .' Pagina: '.utf8_encode($selModCat->reurl). '</option>';
        }

        return $selModi;
    }

    #asdsociazione categorie

    public function assCatMod($idCatMod, $idAzienda) {

        #controllo  se esiste
        $this->db->Query("SELECT * FROM admin_acecrm.categorie_attive WHERE idCatMod=$idCatMod and idAzienda=$idAzienda");
        if ($this->db->RowCount() > 0) {
            #update
            $catAtt = $this->db->Row();
            $this->assCatModUpd($idCatMod, $idAzienda, $catAtt->idCategoria);
        } ELSE {
            #insert
            $this->assCatModIns($idCatMod, $idAzienda);
        }
    }

    public function assCatModIns($idCatMod, $idAzienda) {
        $catAss['idCatMod'] = MySQL::SQLValue($idCatMod, MySQL::SQLVALUE_TEXT);
        $catAss['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow('admin_acecrm.categorie_attive', $catAss))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function assCatModUpd($idCatMod, $idAzienda, $idCategoria) {
        $catAssU['idCatMod'] = MySQL::SQLValue($idCatMod, MySQL::SQLVALUE_TEXT);
        $catAssU['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $catAssFil['idCategoria'] = MySQL::SQLValue($idCategoria, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows('admin_acecrm.categorie_attive', $catAssU, $catAssFil))
            echo $this->db->Kill();
        $this->messaggio();
    }

    #cancella associazione

    public function cancAss($idCategoria) {
        $catAssFill['idCategoria'] = MySQL::SQLValue($idCategoria, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows('admin_acecrm.categorie_attive', $catAssFill))
            echo $this->db->Kill();
        $this->messaggio();
    }

#inserimento moduli e aggiornamento

    public function controlloCatEsiste($idCatMod, $modulo, $note, $attivo, $reurl) {

        $this->db->Query("SELECT * FROM admin_acecrm.categoria_moduli WHERE idCatMod=$idCatMod");
        $catMod = $this->db->Row();
        $this->insModulo($idCatMod, $modulo, $note, $attivo, $reurl, $catMod->categoria);
    }

    public function insModulo($idCatMod, $modulo, $note, $attivo, $reurl, $categoria) {
        #creo la cartella
        $path = $_SERVER["DOCUMENT_ROOT"] . "/moduli/$categoria/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $this->creazionePagina($idCatMod, $modulo, $note, $attivo, $reurl, $categoria);
    }

    public function creazionePagina($idCatMod, $modulo, $note, $attivo, $reurl, $categoria) {
        $filename = $_SERVER["DOCUMENT_ROOT"] . "/moduli/$categoria/$reurl.php";
        $handler = fopen($filename, 'w+');
        $this->insModuloAt($idCatMod, $modulo, $note, $attivo, $reurl, $categoria);
    }

    public function insModuloAt($idCatMod, $modulo, $note, $attivo, $reurl, $categoria) {

        $modIns['idCatMod'] = MySQL::SQLValue($idCatMod, MySQL::SQLVALUE_TEXT);
        $modIns['modulo'] = MySQL::SQLValue($modulo, MySQL::SQLVALUE_TEXT);
        $modIns['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $modIns['attivo'] = MySQL::SQLValue($attivo, MySQL::SQLVALUE_TEXT);
        $modIns['reurl'] = MySQL::SQLValue($reurl, MySQL::SQLVALUE_TEXT);
        $modIns['livello'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $modIns['data_rilascio'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        if (!$this->db->InsertRow('admin_acecrm.moduli', $modIns))
            echo $this->db->Kill();
        $this->messaggio();
    }

    #aggiornamento categoria 

    public function updModuloAt($idModuli, $idCatMod, $modulo, $note, $attivo, $reurl) {

        $modIns['idCatMod'] = MySQL::SQLValue($idCatMod, MySQL::SQLVALUE_TEXT);
        $modIns['modulo'] = MySQL::SQLValue($modulo, MySQL::SQLVALUE_TEXT);
        $modIns['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $modIns['attivo'] = MySQL::SQLValue($attivo, MySQL::SQLVALUE_TEXT);
        $modIns['reurl'] = MySQL::SQLValue($reurl, MySQL::SQLVALUE_TEXT);
        $modIns['livello'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $modIns['data_rilascio'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        $modInsF['idModuli'] = MySQL::SQLValue($idModuli, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows('admin_acecrm.moduli', $modIns, $modInsF))
            echo $this->db->Kill();
        $this->messaggio();
    }

    #associazione moduli

    public function assocMod($idModuli, $idAzienda, $username) {
        $modAss['modulo'] = MySQL::SQLValue($idModuli, MySQL::SQLVALUE_TEXT);
        $modAss['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow('admin_acecrm.moduli_attivi', $modAss))
            echo $this->db->Kill();
        $this->estrazioneModulo($idModuli, $idAzienda, $username);
    }

    public function estrazioneModulo($idModuli, $idAzienda, $username) {
        $this->db->Query("SELECT * FROM admin_acecrm.moduli_attivi WHERE modulo=$idModuli and idAzienda=$idAzienda");
        $estrMod = $this->db->Row();
        $this->assPermessi($idAzienda, $idModuli, $username, $estrMod->idModulo);
    }

    public function assPermessi($idAzienda, $idModuli, $username, $modulo) {
        $modAssPer['idModuli'] = MySQL::SQLValue($modulo, MySQL::SQLVALUE_TEXT);
        $modAssPer['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $modAssPer['idRuolo'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow("admin_$username.permessi", $modAssPer))
            echo $this->db->Kill();
        $this->messaggio();
    }

    #creazione di titoli

    public function titoliCreazione($titolo, $collegamento, $pagina) {
        $insTitolo['titolo'] = MySQL::SQLValue($titolo, MySQL::SQLVALUE_TEXT);
        $insTitolo['collegamento'] = MySQL::SQLValue($collegamento, MySQL::SQLVALUE_TEXT);
        $insTitolo['page'] = MySQL::SQLValue($pagina, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow('admin_acecrm.titoli', $insTitolo))
            echo $this->db->Kill();
        $this->messaggio();
    }

#select nella pagina degli operatori

    public function modulivis() {
       

        $this->db->Query("SELECT moduli.*, moduli_attivi.*, moduli.modulo AS nome FROM admin_acecrm.moduli INNER JOIN admin_acecrm.moduli_attivi ON idModuli=moduli_attivi.modulo WHERE idAzienda={$_SESSION['idAzienda']}");
        $modulo = '<option value="">scegli...</option>';
        while ($modulo1 = $this->db->Row()) {
            $modulo .= '<option value="' . $modulo1->idModulo . '">' . utf8_encode($modulo1->nome) . '</option>';
        }

        return $modulo;
    }

}
