<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_lingua extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }


    public function selectLingue($idLingue=null) {
        if ($this->db->Query("SELECT * FROM admin_acecrm.lingue"))
            ;
        while ($lingua = $this->db->Row()) {
            echo "<option value='{$lingua->sigla}'";
            if ($idLingue == $lingua->sigla) {
                echo 'selected';
            }
            echo ">{$lingua->sigla}</option>";
        }
    }

}

?>