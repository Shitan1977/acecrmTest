<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_strumentiMisurazione extends MySQL {

    private $tabella;
    public $db;
    public $idMisurazione;
    public $codice;
    public $barcodeGenerato;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function generatoreBarcode() {
        $comb = '1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $this->barcodeGenerato = implode($pass);
    }

    public function insStrumento($codice, $tipo, $ubicazione, $data, $frequenza, $range_taratura, $barcode, $idStrumento) {
        $this->generatoreBarcode();
        $insS['codice'] = MySQL::SQLValue($codice, MySQL::SQLVALUE_TEXT);
        $insS['tipo'] = MySQL::SQLValue($tipo, MySQL::SQLVALUE_TEXT);
        $insS['ubicazione'] = MySQL::SQLValue($ubicazione, MySQL::SQLVALUE_TEXT);
        $insS['data'] = MySQL::SQLValue($data, MySQL::SQLVALUE_DATE);
        $insS['frequenza'] = MySQL::SQLValue($frequenza, MySQL::SQLVALUE_TEXT);
        $insS['range_taratura'] = MySQL::SQLValue($range_taratura, MySQL::SQLVALUE_TEXT);
        //$insS['risoluzione'] = MySQL::SQLValue($risoluzione, MySQL::SQLVALUE_DATE);
        $insS['created_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insS['updated_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insS['barcode'] = MySQL::SQLValue($this->barcodeGenerato, MySQL::SQLVALUE_TEXT);
       
        $insS['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        if (!empty($idStrumento)) {
            $insSF['id'] = MySQL::SQLValue($idStrumento, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.strumento', $insS, $insSF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.strumento', $insS))
                echo $this->db->Kill();
        }
    }

    public function delStrumento($id) {
        $delIns['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.strumento', $delIns))
            echo $this->db->Kill();
    }

    public function variabileFissa($idMisurazione) {
        $this->idMisurazione = $idMisurazione;
    }

    public function variabileFissaCodice($codice) {
        $this->codice = $codice;
    }

    public function insDettStrumento($matricola, $grandezza, $procedura, $campione, $classe, $unita, $intervallo, $range_t, $scostamento, $risoluzione, $varie, $note, $data_controllo, $data_prox, $timbro, $esito, $firma, $id = null) {


        $insSD['codice_strum'] = MySQL::SQLValue($matricola, MySQL::SQLVALUE_TEXT);
        $insSD['matricola'] = MySQL::SQLValue($matricola, MySQL::SQLVALUE_TEXT);
        $insSD['grandezza'] = MySQL::SQLValue($grandezza, MySQL::SQLVALUE_TEXT);
        $insSD['procedura'] = MySQL::SQLValue($procedura, MySQL::SQLVALUE_TEXT);
        $insSD['campione'] = MySQL::SQLValue($campione, MySQL::SQLVALUE_TEXT);
        $insSD['classe'] = MySQL::SQLValue($classe, MySQL::SQLVALUE_TEXT);
        $insSD['unita'] = MySQL::SQLValue($unita, MySQL::SQLVALUE_TEXT);
        $insSD['intervallo'] = MySQL::SQLValue($intervallo, MySQL::SQLVALUE_TEXT);
        $insSD['range_t'] = MySQL::SQLValue($range_t, MySQL::SQLVALUE_TEXT);
        $insSD['scostamento'] = MySQL::SQLValue($scostamento, MySQL::SQLVALUE_TEXT);
        $insSD['risoluzione'] = MySQL::SQLValue($risoluzione, MySQL::SQLVALUE_TEXT);
        $insSD['varie'] = MySQL::SQLValue($varie, MySQL::SQLVALUE_TEXT);
        $insSD['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $insSD['data_controllo'] = MySQL::SQLValue($data_controllo, MySQL::SQLVALUE_DATE);
        $insSD['data_prox'] = MySQL::SQLValue($data_prox, MySQL::SQLVALUE_DATE);
        $insSD['timbro'] = MySQL::SQLValue($timbro, MySQL::SQLVALUE_TEXT);
        $insSD['esito'] = MySQL::SQLValue($esito, MySQL::SQLVALUE_TEXT);
        $insSD['firma'] = MySQL::SQLValue($firma, MySQL::SQLVALUE_TEXT);
        $insSD['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);

        if (!empty($id)) {
            $insSDF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);

            if (!$this->db->UpdateRows($this->tabella . '.taratura_strum', $insSD, $insSDF)) {
                echo $this->db->Kill();
            }
        } else {

            if (!$this->db->InsertRow($this->tabella . '.taratura_strum', $insSD)) {
                echo $this->db->Kill();
            }
        }
    }

    #cancellazione dle dettaglio

    public function delStrumentoDettaglio($id) {
        $delInsD['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.taratura_strum', $delInsD))
            echo $this->db->Kill();
    }

    public function controlloNumero($idTaratura, $mis, $mis_eff, $mis_temp, $idVar) {
  
        $this->db->Query("SELECT *  from $this->tabella.taratura_strum_var where idTaratura={$idTaratura} order by numero Desc");
        if ($this->db->RowCount() > 0) {
            $tar = $this->db->Row();
            $numero = ++$tar->numero;
        } else {
            $numero = 1;
        }

        $this->insVar($idTaratura, $mis, $mis_eff, $mis_temp, $numero, $idVar);
    }

    public function insVar($idTaratura, $mis, $mis_eff, $mis_temp, $numero, $idVar) {

        $insVA['idTaratura'] = MySQL::SQLValue($idTaratura, MySQL::SQLVALUE_TEXT);
        $insVA['mis'] = MySQL::SQLValue($mis, MySQL::SQLVALUE_TEXT);
        $insVA['mis_eff'] = MySQL::SQLValue($mis_eff, MySQL::SQLVALUE_TEXT);
        $insVA['mis_temp'] = MySQL::SQLValue($mis_temp, MySQL::SQLVALUE_TEXT);
        $insVA['numero'] = MySQL::SQLValue($numero, MySQL::SQLVALUE_TEXT);
        if (!empty($idVar)) {
            $insVF['idVar'] = MySQL::SQLValue($idVar, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.taratura_strum_var', $insVA, $insVF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.taratura_strum_var', $insVA))
                echo $this->db->Kill();
        }
    }

    public function selectVar($id = null) {
        if (!$this->db->Query("SELECT * FROM $this->tabella.taratura_strum WHERE matricola='{$id}' group By data_controllo ORDER BY data_controllo DESC "))
            ;

        while ($tara = $this->db->Row()) {
            echo "<option value='{$tara->id}'";
            echo ">{$tara->data_controllo}</option>";
        }
    }
    
        public function delStrumentoVar($idVar) {
        $delInsD['idVar'] = MySQL::SQLValue($idVar, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.taratura_strum_var', $delInsD))
            echo $this->db->Kill();
    }
}
