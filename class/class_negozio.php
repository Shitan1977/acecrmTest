<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_negozio extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function negozioONline($host, $user, $pwsSito, $idAzienda) {
        $this->db->Query("SELECT *  FROM $this->tabella.impostazioniNegozio");
        if ($this->db->RowCount() > 0) {
            $this->messaggioError();
        } else {
            $this->insNegozio($host, $user, $pwsSito, $idAzienda);
        }
    }

    public function messaggio() {
        echo "<script>alert('Aggiornamento riuscito con successo');</script>";
    }

    public function messaggioError() {
        echo "<script>alert('Hai già inserito un negozio');</script>";
    }

    public function insNegozio($host, $user, $pwsSito, $idAzienda) {
        $insNeg['host'] = MySQL::SQLValue($host, MySQL::SQLVALUE_TEXT);
        $insNeg['user'] = MySQL::SQLValue($user, MySQL::SQLVALUE_TEXT);
        $insNeg['pwsSito'] = MySQL::SQLValue($pwsSito, MySQL::SQLVALUE_TEXT);
        $insNeg['idAzienda'] = MySQL::SQLValue($idAzienda, MySQL::SQLVALUE_TEXT);
          if (!$this->db->InsertRow($this->tabella. '.impostazioniNegozio', $insNeg))
            echo $this->db->Kill();
          $this->messaggio();
    }

}
