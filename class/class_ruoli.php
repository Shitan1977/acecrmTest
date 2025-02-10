<?php

require_once 'libreria/mysql_class.php';

class class_ruoli extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function GestioneRuoli($idRuolo = null, $ruolo, $cancella = null) {
        $db = new MySQL();
        $gestioneRuoli['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $gestioneRuoli['ruolo'] = MySQL::SQLValue($_POST['ruolo'], MySQL::SQLVALUE_TEXT);

        $nomedb = $this->tabella . '.ruolo';
        if (isset($_POST['idRuolo'])) {
            $ruolofiltro['idRuolo'] = MySQL::SQLValue($idRuolo, MySQL::SQLVALUE_TEXT);
            if (isset($cancella)) {

                if (!$this->db->DeleteRows($nomedb, $ruolofiltro))
                    echo $this->db->Kill();
            } else {
                if (!$this->db->UpdateRows($nomedb, $gestioneRuoli, $ruolofiltro))
                    echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($nomedb, $gestioneRuoli))
                echo $this->db->Kill();
        }

        @header('location:gestione-gestione_ruoli.php');
    }

    public function ruolo($idRuolo = null) {
      
        if (!$this->db->Query("SELECT * FROM $this->tabella.ruolo WHERE idAzienda='{$_SESSION['idAzienda']}' ORDER BY ruolo"))
            ;

        while ($ruolo = $this->db->Row()) {
            echo "<option value='{$ruolo->idRuolo}'";
            echo ($ruolo->idRuolo == $idRuolo) ? "selected" : "";
            echo ">{$ruolo->ruolo}</option>";
        }
    }

}
