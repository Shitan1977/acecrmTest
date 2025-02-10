<?php

session_start();
ob_start();
require_once 'libreria/mysql_class.php';

class class_anagrafica extends MySQL {

    private $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function anagraficaCliente($idAnagrafica = null) {


        $this->db->Query("SELECT concat(nome,' ', cognome) as nominativo, ragioneSociale, idAnagrafica FROM {$this->tabella}.anagrafica ORDER BY nome desc");
        $anagrafica = '<option value="">scegli...</option>';
        while ($anagrafica1 = $this->db->Row()) {
            $anagrafica .= '<option value="' . $anagrafica1->idAnagrafica . '"';
            if ($idAnagrafica == $anagrafica1->idAnagrafica) {
                $anagrafica .= 'selected';
            }
            $anagrafica .= '>' . utf8_encode($anagrafica1->nominativo) . ' ' . utf8_encode($anagrafica1->ragioneSociale) . '</option>';
        }

        echo $anagrafica;
    }

    public function modificaProfilo($nome, $cognome, $email, $pass, $idAnagrafica) {

        $modProfilo['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $modProfilo['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $modProfilo['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);

        $modProfilo['pws'] = MySQL::SQLValue(md5($pass), MySQL::SQLVALUE_TEXT);
        $modProfiloF['idAmministratore'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.amministratore', $modProfilo, $modProfiloF))
            echo $this->db->Kill();
    }
}
