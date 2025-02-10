<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_lotti extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function inserimentoLotto($lottos, $idLotto = null, $barcode) {

        $lotto['lotto'] = MySQL::SQLValue($lottos, MySQL::SQLVALUE_TEXT);
        $lotto['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $lotto['barcode'] = MySQL::SQLValue($barcode, MySQL::SQLVALUE_TEXT);

        if (!empty($idLotto)) {
            $flotto['idLotti'] = MySQL::SQLValue($idLotto, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows("$this->tabella.lotto", $lotto, $flotto))
                ;
        } else {

            if (!$this->db->InsertRow("$this->tabella.lotto", $lotto))
                ;
        }
    }

    public function cancellaLotto($idLotto) {
        $clotto['idLotti'] = MySQL::SQLValue($idLotto, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows("$this->tabella.lotto", $clotto))
            ;
      
    }

    public function selectlotto($idLotto = null) {
     
        if ($this->db->Query("SELECT * FROM {$this->tabella}.lotto"))
            ;
        while ($pat = $this->db->Row()) {
            echo "<option value='{$pat->idLotti}'";
            if ($idLotto == $pat->idLotto) {
                echo 'selected';
            }

            echo ">{$pat->lotto}</option>";
        }
    }

}
