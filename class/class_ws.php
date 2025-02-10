<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_ws extends MySQL {

    private $tabella;
    public $db;
    public $matricola;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function InsW($denominazione, $costruttore, $matricola, $messa, $ubicazione, $operatore, $id = null) {
        $work['denominazione'] = MySQL::SQLValue($denominazione, MySQL::SQLVALUE_TEXT);
        $work['costruttore'] = MySQL::SQLValue($costruttore, MySQL::SQLVALUE_TEXT);
        $work['matricola'] = MySQL::SQLValue($matricola, MySQL::SQLVALUE_TEXT);
        $work['messa_servizio'] = MySQL::SQLValue($messa, MySQL::SQLVALUE_TEXT);
        $work['ubicazione'] = MySQL::SQLValue($ubicazione, MySQL::SQLVALUE_TEXT);
        $work['operatore'] = MySQL::SQLValue($operatore, MySQL::SQLVALUE_TEXT);
        $work['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        if (isset($id)) {
            $workF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);

            if (!$this->db->UpdateRows($this->tabella . '.workstation', $work, $workF)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.workstation', $work)) {
                echo $this->db->Kill();
            }
        }
    }

    public function delWork($delWs) {
        $workF['id'] = MySQL::SQLValue($delWs, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.workstation', $workF)) {
            echo $this->db->Kill();
        }
    }

    public function visualizzaW($idWork) {
        $this->matricola = $idWork;
    }

    public function insWD($matricola_ws, $anno, $operazione, $frequenza, $operatore, $gen, $feb, $mar, $apr, $mag, $giu, $lug, $ago, $sett, $ott, $nov, $dic, $id_new = null) {
        $work['matricola_ws'] = MySQL::SQLValue($matricola_ws, MySQL::SQLVALUE_TEXT);
        $work['anno'] = MySQL::SQLValue(date("Y"), MySQL::SQLVALUE_TEXT);
        $work['operazione'] = MySQL::SQLValue($operazione, MySQL::SQLVALUE_TEXT);
        $work['frequenza'] = MySQL::SQLValue($frequenza, MySQL::SQLVALUE_TEXT);
        $work['operatore'] = MySQL::SQLValue($operatore, MySQL::SQLVALUE_TEXT);
        $work['gen'] = MySQL::SQLValue($gen, MySQL::SQLVALUE_TEXT);
        $work['feb'] = MySQL::SQLValue($feb, MySQL::SQLVALUE_TEXT);
        $work['mar'] = MySQL::SQLValue($mar, MySQL::SQLVALUE_TEXT);
        $work['apr'] = MySQL::SQLValue($apr, MySQL::SQLVALUE_TEXT);
        $work['mag'] = MySQL::SQLValue($mag, MySQL::SQLVALUE_TEXT);
        $work['giu'] = MySQL::SQLValue($giu, MySQL::SQLVALUE_TEXT);
        $work['lug'] = MySQL::SQLValue($lug, MySQL::SQLVALUE_TEXT);
        $work['ago'] = MySQL::SQLValue($ago, MySQL::SQLVALUE_TEXT);
        $work['sett'] = MySQL::SQLValue($sett, MySQL::SQLVALUE_TEXT);
        $work['ott'] = MySQL::SQLValue($ott, MySQL::SQLVALUE_TEXT);
        $work['nov'] = MySQL::SQLValue($nov, MySQL::SQLVALUE_TEXT);
        $work['dic'] = MySQL::SQLValue($dic, MySQL::SQLVALUE_TEXT);
        $work['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);

        echo "<pre>";
        print_r($work);
        echo "</pre>";
        if (isset($id_new)) {
            $workF['id_new'] = MySQL::SQLValue($id_new, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.validazione_ws', $work, $workF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.validazione_ws', $work))
                echo $this->db->Kill();
        }
    }

}
