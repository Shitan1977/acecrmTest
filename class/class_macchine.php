<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_macchine extends MySQL {

    private $tabella;
    public $db;
    public $idMacchina;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insMacchine($denominazione, $costruttore, $dimensioni, $matricola_interna, $matricola_costruttore, $assi, $messa, $luogo, $amso, $amss, $id) {

        $this->db->Query("SELECT * FROM {$this->tabella}.macchina WHERE nome_azienda_app='MES' ORDER BY id DESC LIMIT 1 ");
        $num = $this->db->Row();
        $this->insMac($denominazione, $costruttore, $dimensioni, $matricola_interna, $matricola_costruttore, $assi, $messa, $luogo, $num->numero, $amso, $amss, $id);
    }

    public function insMac($denominazione, $costruttore, $dimensioni, $matricola_interna, $matricola_costruttore, $assi, $messa, $luogo, $num, $amso, $amss, $id = null) {
        $insM['denominazione'] = MySQL::SQLValue($denominazione, MySQL::SQLVALUE_TEXT);
        $insM['costruttore'] = MySQL::SQLValue($costruttore, MySQL::SQLVALUE_TEXT);
        $insM['dimensioni'] = MySQL::SQLValue($dimensioni, MySQL::SQLVALUE_TEXT);
        $insM['matricola_interna'] = MySQL::SQLValue($matricola_interna, MySQL::SQLVALUE_TEXT);
        $insM['matricola_costruttore'] = MySQL::SQLValue($matricola_costruttore, MySQL::SQLVALUE_TEXT);
        $insM['assi'] = MySQL::SQLValue($assi, MySQL::SQLVALUE_TEXT);
        $insM['messa'] = MySQL::SQLValue($messa, MySQL::SQLVALUE_TEXT);
        $insM['luogo'] = MySQL::SQLValue($luogo, MySQL::SQLVALUE_TEXT);
        $insM['numero'] = MySQL::SQLValue($num + 1, MySQL::SQLVALUE_TEXT);
        $insM['amso'] = MySQL::SQLValue($amso, MySQL::SQLVALUE_TEXT);
        $insM['amss'] = MySQL::SQLValue($amss, MySQL::SQLVALUE_TEXT);
        $insM['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $idF['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        if (!empty($id)) {
            $idF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . ".macchina", $insM, $idF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . ".macchina", $insM))
                echo $this->db->Kill();
        }

        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function parametroFisso($idMacchina) {
        $this->idMacchina = $idMacchina;
    }

    public function delMacc($id) {
        $canc['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".macchina", $canc))
            echo $this->db->Kill();
    }

    public function insertOrdinaria($id_macchina, $aria_programmata, $aria_effettuata, $aria_firma, $cambio_olio_programmato, $cambio_olio_effettuato, $cambio_olio_firma, $cambio_refrig_programmato, $cambio_refrig_effettuato, $cambio_refrig_firma, $contr_strum_elet_programmato, $contr_strum_elet_effettuato, $contr_strum_elet_firma, $contr_geomet_programmato, $contr_geomet_effettuato, $contr_geomet_firma) {
        
        $this->db->Query("SELECT * FROM {$this->tabella}.macchina WHERE id=$id_macchina");
        $nume = $this->db->Row();
    
        $this->insOrdinariaViw($id_macchina, $aria_programmata, $aria_effettuata, $aria_firma, $cambio_olio_programmato, $cambio_olio_effettuato, $cambio_olio_firma, $cambio_refrig_programmato, $cambio_refrig_effettuato, $cambio_refrig_firma, $contr_strum_elet_programmato, $contr_strum_elet_effettuato, $contr_strum_elet_firma, $contr_geomet_programmato, $contr_geomet_effettuato, $contr_geomet_firma, $nume->numero);
    }

    public function insOrdinariaViw($id_macchina, $aria_programmata, $aria_effettuata, $aria_firma, $cambio_olio_programmato, $cambio_olio_effettuato, $cambio_olio_firma, $cambio_refrig_programmato, $cambio_refrig_effettuato, $cambio_refrig_firma, $contr_strum_elet_programmato, $contr_strum_elet_effettuato, $contr_strum_elet_firma, $contr_geomet_programmato, $contr_geomet_effettuato, $contr_geomet_firma, $numero) {
        $insMac['id_macchina'] = MySQL::SQLValue($id_macchina, MySQL::SQLVALUE_TEXT);
        $insMac['numero_macchina'] = MySQL::SQLValue($numero, MySQL::SQLVALUE_TEXT);
        $insMac['anno_corso'] = MySQL::SQLValue(date('Y'), MySQL::SQLVALUE_TEXT);
        $insMac['aria_programmata'] = MySQL::SQLValue($aria_programmata, MySQL::SQLVALUE_TEXT);
        $insMac['aria_effettuata'] = MySQL::SQLValue($aria_effettuata, MySQL::SQLVALUE_TEXT);
        $insMac['aria_firma'] = MySQL::SQLValue($aria_firma, MySQL::SQLVALUE_TEXT);
        $insMac['cambio_olio_programmato'] = MySQL::SQLValue($cambio_olio_programmato, MySQL::SQLVALUE_TEXT);
        $insMac['cambio_olio_effettuato'] = MySQL::SQLValue($cambio_olio_effettuato, MySQL::SQLVALUE_TEXT);
        $insMac['cambio_olio_firma'] = MySQL::SQLValue($cambio_olio_firma, MySQL::SQLVALUE_TEXT);
        $insMac['cambio_refrig_programmato'] = MySQL::SQLValue($cambio_refrig_programmato, MySQL::SQLVALUE_TEXT);
        $insMac['cambio_refrig_effettuato'] = MySQL::SQLValue($cambio_refrig_effettuato, MySQL::SQLVALUE_TEXT);
        $insMac['cambio_refrig_firma'] = MySQL::SQLValue($cambio_refrig_firma, MySQL::SQLVALUE_TEXT);
        $insMac['contr_strum_elet_programmato'] = MySQL::SQLValue($contr_strum_elet_programmato, MySQL::SQLVALUE_TEXT);
        $insMac['contr_strum_elet_effettuato'] = MySQL::SQLValue($contr_strum_elet_effettuato, MySQL::SQLVALUE_TEXT);
        $insMac['contr_strum_elet_firma'] = MySQL::SQLValue($contr_strum_elet_firma, MySQL::SQLVALUE_TEXT);
        $insMac['contr_geomet_programmato'] = MySQL::SQLValue($contr_geomet_programmato, MySQL::SQLVALUE_TEXT);
        $insMac['contr_geomet_effettuato'] = MySQL::SQLValue($contr_geomet_effettuato, MySQL::SQLVALUE_TEXT);
        $insMac['contr_geomet_firma'] = MySQL::SQLValue($contr_geomet_firma, MySQL::SQLVALUE_TEXT);
        $insMac['tipo_manutenzione'] = MySQL::SQLValue('Ordinaria', MySQL::SQLVALUE_TEXT);
        $insMac['created_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
       
        if (!$this->db->InsertRow($this->tabella . ".manutenzionemacchina", $insMac))
            echo $this->db->Kill();
    }

    public function insertAspe($id_macchina, $aspec_descrizione, $aspec_programmata, $aspec_effettuata, $aspec_firma) {
        $this->db->Query("SELECT * FROM {$this->tabella}.macchina WHERE id=$id_macchina");
        $nume = $this->db->Row();

        $this->insAspeViw($id_macchina, $aspec_descrizione, $aspec_programmata, $aspec_effettuata, $aspec_firma, $nume->numero);
    }

    public function insAspeViw($id_macchina, $aspec_descrizione, $aspec_programmata, $aspec_effettuata, $aspec_firma, $numero) {
        $insMacc['id_macchina'] = MySQL::SQLValue($id_macchina, MySQL::SQLVALUE_TEXT);
        $insMacc['numero_macchina'] = MySQL::SQLValue($numero, MySQL::SQLVALUE_TEXT);
        $insMacc['aspec_descrizione'] = MySQL::SQLValue($aspec_descrizione, MySQL::SQLVALUE_TEXT);
        $insMacc['aspec_programmata'] = MySQL::SQLValue($aspec_programmata, MySQL::SQLVALUE_TEXT);
        $insMacc['aspec_effettuata'] = MySQL::SQLValue($aspec_effettuata, MySQL::SQLVALUE_TEXT);
        $insMacc['anno_corso'] = MySQL::SQLValue(date('Y'), MySQL::SQLVALUE_TEXT);
        $insMacc['aspec_firma'] = MySQL::SQLValue($aspec_firma, MySQL::SQLVALUE_TEXT);
        $insMacc['created_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insMacc['tipo_manutenzione'] = MySQL::SQLValue('Speciale', MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . ".manutenzionemacchina", $insMacc))
            echo $this->db->Kill();
    }

    public function insertStra($id_macchina, $straord_descrizione, $straord_data, $straord_tempo_fermo_macchina, $straord_tempo_riparazione, $straord_frequenza_del_guasto, $straord_gravita_guasto, $straord_costo_totale, $straord_firma_ditta) {
        $this->db->Query("SELECT * FROM {$this->tabella}.macchina WHERE id=$id_macchina");
        $nume = $this->db->Row();

        $this->insStraViw($id_macchina, $straord_descrizione, $straord_data, $straord_tempo_fermo_macchina, $straord_tempo_riparazione, $straord_frequenza_del_guasto, $straord_gravita_guasto, $straord_costo_totale, $straord_firma_ditta, $nume->numero);
    }

    public function insStraViw($id_macchina, $straord_descrizione, $straord_data, $straord_tempo_fermo_macchina, $straord_tempo_riparazione, $straord_frequenza_del_guasto, $straord_gravita_guasto, $straord_costo_totale, $straord_firma_ditta, $numero) {
        $insMaccc['id_macchina'] = MySQL::SQLValue($id_macchina, MySQL::SQLVALUE_TEXT);
        $insMaccc['numero_macchina'] = MySQL::SQLValue($numero, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_descrizione'] = MySQL::SQLValue($straord_descrizione, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_data'] = MySQL::SQLValue($straord_data, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_tempo_fermo_macchina'] = MySQL::SQLValue($straord_tempo_fermo_macchina, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_tempo_riparazione'] = MySQL::SQLValue($straord_tempo_riparazione, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_frequenza_del_guasto'] = MySQL::SQLValue($straord_frequenza_del_guasto, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_gravita_guasto'] = MySQL::SQLValue($straord_gravita_guasto, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_costo_totale'] = MySQL::SQLValue($straord_costo_totale, MySQL::SQLVALUE_TEXT);
        $insMaccc['straord_firma_ditta'] = MySQL::SQLValue($straord_firma_ditta, MySQL::SQLVALUE_TEXT);
        $insMaccc['created_at'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insMaccc['anno_corso'] = MySQL::SQLValue(date('Y'), MySQL::SQLVALUE_TEXT);
        $insMaccc['tipo_manutenzione'] = MySQL::SQLValue('Straordinaria', MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . ".manutenzionemacchina", $insMaccc))
            echo $this->db->Kill();
    }
#cancellazione
    public function delManute($delMan) {
         $delMans['id'] = MySQL::SQLValue($delMan, MySQL::SQLVALUE_TEXT);
    
        if (!$this->db->DeleteRows($this->tabella . ".manutenzionemacchina", $delMans))
            echo $this->db->Kill();
        
    }
}
