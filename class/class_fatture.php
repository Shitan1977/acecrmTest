<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_fatture extends MySQL {

    public $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function uploadFatture($progressivo, $idAnagrafica = null, $idFornitore = null, $oggetto, $file_name, $file_tmp, $tipo, $dataFattura, $idAzienda) {
        $file_dir = "fatture/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }
        $gestioneFat['progressivo'] = MySQL::SQLValue($progressivo, MySQL::SQLVALUE_TEXT);
        $gestioneFat['idAnagrafica'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        $gestioneFat['idFornitore'] = MySQL::SQLValue($idFornitore, MySQL::SQLVALUE_TEXT);
        $gestioneFat['oggetto'] = MySQL::SQLValue($oggetto, MySQL::SQLVALUE_TEXT);
        $gestioneFat['documento'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        $gestioneFat['tipo'] = MySQL::SQLValue($tipo, MySQL::SQLVALUE_TEXT);
        $gestioneFat['dataFattura'] = MySQL::SQLValue($dataFattura, MySQL::SQLVALUE_DATE);
        $gestioneFat['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.fatture';
       
        if (!$this->db->InsertRow($nomedb, $gestioneFat))
            echo $this->db->Kill();

        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }
    }

}
