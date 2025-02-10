<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_agenzie extends MySQL {

    public $tabella;
    public $db;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function gestioneAgenzie() {


        $agenzieadd['nome'] = MySQL::SQLValue($_POST['nome'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['cognome'] = MySQL::SQLValue($_POST['cognome'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['indirizzo'] = MySQL::SQLValue($_POST['indirizzo'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['cap'] = MySQL::SQLValue($_POST['cap'], MySQL::SQLVALUE_TEXT);

        $agenzieadd['idComune'] = MySQL::SQLValue($_POST['idComune'], MySQL::SQLVALUE_TEXT);

        $agenzieadd['fisso'] = MySQL::SQLValue($_POST['fisso'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['mobile'] = MySQL::SQLValue($_POST['mobile'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['ragione_sociale'] = MySQL::SQLValue($_POST['ragioneSociale'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['email'] = MySQL::SQLValue($_POST['email'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['codice_fiscale'] = MySQL::SQLValue($_POST['codiceFiscale'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['partita_iva'] = MySQL::SQLValue($_POST['iva'], MySQL::SQLVALUE_TEXT);
        $agenzieadd['email'] = MySQL::SQLValue($_POST['email'], MySQL::SQLVALUE_TEXT);

        if (!empty($_POST['pws'])) {
            $passcriptata = md5($_POST['pws']);

            $agenzieadd['pws'] = MySQL::SQLValue($passcriptata, MySQL::SQLVALUE_TEXT);
        }

        $agenzieadd['livello'] = MySQL::SQLValue(7, MySQL::SQLVALUE_TEXT);
        $agenzieadd['username'] = MySQL::SQLValue($_SESSION['username'], MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.agenzie';

        if (isset($_POST['idAgenzie'])) {
            $agenzieaddfiltro['idAgenzie'] = MySQL::SQLValue($_POST['idAgenzie'], MySQL::SQLVALUE_TEXT);
            if (isset($_POST['cancella'])) {

                if (!$this->db->DeleteRows($nomedb, $agenzieaddfiltro))
                    echo $this->db->Kill();
            } else {
                if (!$this->db->UpdateRows($nomedb, $agenzieadd, $agenzieaddfiltro))
                    echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($nomedb, $agenzieadd))
                echo $this->db->Kill();
        }
        $this->messaggio();
    }

    public function messaggio() {
        echo "<script>
    Swal.fire({
        title: 'Successo!',
        text: 'Aggiornamento riuscito con successo.',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
    </script>";
    }
}
