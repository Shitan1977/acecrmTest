<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_coc extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insCoc($acquirente, $data_coc, $variante_ordine, $inviato_a, $cliente, $anno, $descrizione, $commessa, $riferimento, $anno_ordine, $n_ordine, $firma, $id_master) {

        $this->db->Query("select * from {$_SESSION['tabella']}.anagrafica WHERE ragioneSociale='{$acquirente}'");
        $ana = $this->db->Row();

        $this->dettCoc($ana->idAnagrafica, $acquirente, $data_coc, $variante_ordine, $inviato_a, $cliente, $anno, $descrizione, $commessa, $riferimento, $anno_ordine, $n_ordine, $firma, $id_master);
    }

    public function dettCoc($idAnagrafica, $acquirente, $data_coc, $variante_ordine, $inviato_a, $cliente, $anno, $descrizione, $commessa, $riferimento, $anno_ordine, $n_ordine, $firma, $id_master) {

        $insCoc['acquirente'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        $insCoc['rag_soc_cliente'] = MySQL::SQLValue($acquirente, MySQL::SQLVALUE_TEXT);
        $insCoc['variante_ordine'] = MySQL::SQLValue($variante_ordine, MySQL::SQLVALUE_TEXT);
        $insCoc['inviato_a'] = MySQL::SQLValue($inviato_a, MySQL::SQLVALUE_TEXT);
        $insCoc['cliente'] = MySQL::SQLValue($cliente, MySQL::SQLVALUE_TEXT);
        $insCoc['anno'] = MySQL::SQLValue($anno, MySQL::SQLVALUE_TEXT);
        $insCoc['n_ordine'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insCoc['idc_attivita'] = MySQL::SQLValue($commessa, MySQL::SQLVALUE_TEXT);
        $insCoc['att_richiesta'] = MySQL::SQLValue($riferimento, MySQL::SQLVALUE_TEXT);
        $insCoc['firma'] = MySQL::SQLValue($firma, MySQL::SQLVALUE_TEXT);
        $insCoc['anno_ordine'] = MySQL::SQLValue($anno_ordine, MySQL::SQLVALUE_TEXT);
        $insCoc['data_coc'] = MySQL::SQLValue($data_coc, MySQL::SQLVALUE_DATE);

        if (!empty($id_master)) {
            $insCocF['id_master'] = MySQL::SQLValue($id_master, MySQL::SQLVALUE_TEXT);

            if (!$this->db->UpdateRows($this->tabella . ".coc", $insCoc, $insCocF)) {
                echo $this->db->Kill();
            }
            $this->messaggio();
        } else {
            if (!$this->db->InsertRow($this->tabella . ".coc", $insCoc))
                echo $this->db->Kill();
            $this->messaggio();
        }
    }

    public function delCoc($idMaster) {
        $insCocF['id_master'] = MySQL::SQLValue($idMaster, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".coc", $insCocF)) {
            echo $this->db->Kill();
        }
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function insDettCoc($id_master, $id_ordine, $item, $descrizione, $codice, $s_n, $rev, $qta, $id = null) {
        $insCocd['id_master'] = MySQL::SQLValue($id_master, MySQL::SQLVALUE_TEXT);
        $insCocd['id_ordine'] = MySQL::SQLValue($id_ordine, MySQL::SQLVALUE_TEXT);
        $insCocd['item'] = MySQL::SQLValue($item, MySQL::SQLVALUE_TEXT);
        $insCocd['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insCocd['codice'] = MySQL::SQLValue($codice, MySQL::SQLVALUE_TEXT);
        $insCocd['s_n'] = MySQL::SQLValue($s_n, MySQL::SQLVALUE_TEXT);
        $insCocd['rev'] = MySQL::SQLValue($rev, MySQL::SQLVALUE_TEXT);
        $insCocd['qta'] = MySQL::SQLValue($qta, MySQL::SQLVALUE_TEXT);
        $insCocd['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);

        if (!empty($id)) {

            $insCocF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);

            if (!$this->db->UpdateRows($this->tabella . ".oggetti_coc", $insCocd, $insCocF)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . ".oggetti_coc", $insCocd)) {
                echo $this->db->Kill();
            }
        }
        $this->messaggio();
    }

    public function delDettCoc($id) {
        $delCocF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        
        if (!$this->db->DeleteRows($this->tabella . ".oggetti_coc", $delCocF)) {
            echo $this->db->Kill();
        }
    }

}
