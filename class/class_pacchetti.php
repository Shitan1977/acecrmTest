<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_pacchetti extends MySQL {

    private $tabella;
    public $db;
    public $pacchetto;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function aggPacchetti($pacchetti, $durata, $posizioneSito, $nImmobili, $prezzo, $tipoPacchetti) {
        $pacchetto['pachetto'] = MySQL::SQLValue($pacchetti, MySQL::SQLVALUE_TEXT);
        $pacchetto['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $pacchetto['posizioneSito'] = MySQL::SQLValue($posizioneSito, MySQL::SQLVALUE_TEXT);
        $pacchetto['nImmobili'] = MySQL::SQLValue($nImmobili, MySQL::SQLVALUE_TEXT);
        $pacchetto['tipoPacchetti'] = MySQL::SQLValue($tipoPacchetti, MySQL::SQLVALUE_TEXT);
        $pacchetto['durata'] = MySQL::SQLValue($durata, MySQL::SQLVALUE_TEXT);
        $pacchetto['prezzo'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($this->tabella . '.pacchetti', $pacchetto))
            echo $this->db->Kill();
    }

    public function updPacchetti($pacchetti, $durata, $posizioneSito, $nImmobili,$prezzo,$tipoPacchetti, $idPacchetto) {
        $pacchettoupd['pachetto'] = MySQL::SQLValue($pacchetti, MySQL::SQLVALUE_TEXT);
        $pacchettoupd['durata'] = MySQL::SQLValue($durata, MySQL::SQLVALUE_TEXT);
        $pacchettoupd['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $pacchettoupd['posizioneSito'] = MySQL::SQLValue($posizioneSito, MySQL::SQLVALUE_TEXT);
        $pacchettoupd['nImmobili'] = MySQL::SQLValue($nImmobili, MySQL::SQLVALUE_TEXT);
         $pacchettoupd['tipoPacchetti'] = MySQL::SQLValue($tipoPacchetti, MySQL::SQLVALUE_TEXT);
         $pacchettoupd['prezzo'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);
        $pacchettoF['idPacchetto'] = MySQL::SQLValue($idPacchetto, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.pacchetti', $pacchettoupd, $pacchettoF))
            echo $this->db->Kill();
    }

    public function selzione($idPacchetto) {
        $this->pacchetto = $idPacchetto;
    }

    public function insServizio($servizio, $idPacchetto, $prezzo) {
        $servizioins['servizio'] = MySQL::SQLValue($servizio, MySQL::SQLVALUE_TEXT);
        $servizioins['prezzo'] = MySQL::SQLValue($prezzo, MySQL::SQLVALUE_TEXT);
        $servizioins['idPachetto'] = MySQL::SQLValue($idPacchetto, MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($this->tabella . '.servizi', $servizioins))
            echo $this->db->Kill();
        $this->selzione($idPacchetto);
    }

    public function can($idPacchetto) {
        $pacchettoD['idPacchetto'] = MySQL::SQLValue($idPacchetto, MySQL::SQLVALUE_TEXT);

        if (!$this->db->DeleteRows($this->tabella . '.pacchetti', $pacchettoD)) {
            echo $this->db->Kill();
        }
    }

    public function delSer($idServizi) {
        $pacchettoS['idServizi'] = MySQL::SQLValue($idServizi, MySQL::SQLVALUE_TEXT);

        if (!$this->db->DeleteRows($this->tabella . '.servizi', $pacchettoS)) {
            echo $this->db->Kill();
        }
    }

    public function selectPacchetti($idPacchetto = null) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.pacchetti"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idPacchetto}'";
            if ($idPacchetto == $pat->idPacchetto) {
                echo 'selected';
            }
            echo ">{$pat->idPacchetto}-{$pat->pachetto}</option>";
        }
    }
}
