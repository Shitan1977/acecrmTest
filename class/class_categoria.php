<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_categoria extends MySQL {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function inserimentoCategorie($categoria, $file_name, $file_tmp, $idAmmi, $idAzienda, $idCategorie = null, $idSottocategoria = NULL) {

        $file_dir = "categorie_image/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }
        $cat['categoria'] = MySQL::SQLValue($categoria, MySQL::SQLVALUE_TEXT);
        $cat['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $cat['idOperatore'] = MySQL::SQLValue($idAmmi, MySQL::SQLVALUE_TEXT);
        if (!empty($file_name)) {
            $cat['image'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        }
        if ($idSottocategoria == null) {
            $cat['idSottocategoria'] = MySQL::SQLValue(null, MySQL::SQLVALUE_TEXT);
        } else {

            $cat['idSottocategoria'] = MySQL::SQLValue($idSottocategoria, MySQL::SQLVALUE_TEXT);
        }

        $cat['dataCreazione'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);

        if ($idCategorie != 1) {

            $catF['idCategorie'] = MySQL::SQLValue($idCategorie, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . ".categorie", $cat, $catF))
                ;
        } else {

            if (!$this->db->InsertRow($this->tabella . ".categorie", $cat))
                ;
        }
        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }
        $this->restVariabile($idSottocategoria);
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function cancellaCat($delcat) {
        $delca['idCategorie'] = MySQL::SQLValue($delcat, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . ".categorie", $delca))
            ;
    }

    public function restVariabile($idSotto) {
        $this->idSottocategoria = $idSotto;
    }

    public function selectCategorie($idCategorie = null) {

        if ($this->db->Query("SELECT * FROM {$this->tabella}.categorie"))
            ;
        while ($cat = $this->db->Row()) {
            echo "<option value='{$cat->idCategorie}'";
            if ($idCategorie == $cat->idCategorie) {
                echo 'selected';
            }

            echo ">{$cat->categoria}</option>";
        }
    }

}
