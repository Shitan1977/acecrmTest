<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_blog {

    private $tabella;
    public $db;
    public $idSottocategoria;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function gest($titolo, $file_name, $file_tmp, $testo, $link_riferimento, $idAzienda, $idBlog = null) {
        $file_dir = "blog_image/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }
        $gestioneBlog['titolo'] = MySQL::SQLValue($titolo, MySQL::SQLVALUE_TEXT);
        $gestioneBlog['image'] = MySQL::SQLValue($file_name, MySQL::SQLVALUE_TEXT);
        $gestioneBlog['testo'] = MySQL::SQLValue($testo, MySQL::SQLVALUE_TEXT);
        $gestioneBlog['link_riferimento'] = MySQL::SQLValue($link_riferimento, MySQL::SQLVALUE_TEXT);
        $gestioneBlog['testo'] = MySQL::SQLValue($testo, MySQL::SQLVALUE_TEXT);
        $gestioneBlog['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
        $gestioneBlog['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_TEXT);
        $gestioneBlogF['idBlog'] = MySQL::SQLValue($idBlog, MySQL::SQLVALUE_TEXT);
        if (!empty($idBlog)) {

            if (!$this->db->UpdateRows($this->tabella . '.blog', $gestioneBlog, $gestioneBlogF))
                echo $this->db->Kill();
        } else {
            if (!$this->db->InsertRow($this->tabella . '.blog', $gestioneBlog))
                echo $this->db->Kill();
        }


        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($file_tmp, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }
    }

    public function canBlog($idBlog) {
        $gestioneBlogF['idBlog'] = MySQL::SQLValue($idBlog, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.blog', $gestioneBlogF))
            echo $this->db->Kill();
    }

    public function anteprima($testo, $lunghezza, $puntini) {
        $ellipses = $puntini;
        // eliminazione tag
        $testo = strip_tags($testo);
        // se il testo è già più corto della lunghezza massima viene restituito pulito dai tag
        if (strlen($testo) <= $lunghezza) {
            return $testo;
        }
        // cerca l'ultimo spazio per non restituire parole tagliate
        $ultimo_spazio = strrpos(substr($testo, 0, $lunghezza), ' ');
        $ant = substr($testo, 0, $ultimo_spazio);
        // aggiunge i ... ad indicare che segue
        if ($ellipses) {
            $ant .= '...';
        }
        // restituisce l'anteprima pulita dai tag e del numero di caratteri massimo
        return $ant;
    }

}
