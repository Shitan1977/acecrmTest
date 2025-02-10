<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_commessa extends MySQL {

    private $tabella;
    public $db;
    public $barcodeGenerato;
    public $idMaster;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function insCommessa($id_composto, $cod_cliente, $id_user, $committente, $att_richiesta, $cliente, $rich_pervenuta, $data_chiusura, $centro_di_costo, $tipologia_attivita, $id = null) {
        #generazione di barcode
        $this->generatoreBarcode();

        $insC['id_composto'] = MySQL::SQLValue($id_composto, MySQL::SQLVALUE_TEXT);
        if (!empty($cod_cliente)) {
            $insC['cod_cliente'] = MySQL::SQLValue($cod_cliente, MySQL::SQLVALUE_TEXT);
        }
        if (!empty($cliente)) {
            $insC['cliente'] = MySQL::SQLValue($cliente, MySQL::SQLVALUE_TEXT);
        }
        $insC['id_user'] = MySQL::SQLValue($id_user, MySQL::SQLVALUE_TEXT);
        $insC['committente'] = MySQL::SQLValue($committente, MySQL::SQLVALUE_TEXT);
        $insC['att_richiesta'] = MySQL::SQLValue($att_richiesta, MySQL::SQLVALUE_TEXT);
        $insC['rich_pervenuta'] = MySQL::SQLValue($rich_pervenuta, MySQL::SQLVALUE_TEXT);
        $insC['data_chiusura'] = MySQL::SQLValue($data_chiusura, MySQL::SQLVALUE_DATE);
        $insC['firma'] = MySQL::SQLValue('demo@gmail.com', MySQL::SQLVALUE_TEXT);
        $insC['stato'] = MySQL::SQLValue('Aperta', MySQL::SQLVALUE_TEXT);
        $insC['centro_di_costo'] = MySQL::SQLValue($centro_di_costo, MySQL::SQLVALUE_TEXT);
        $insC['tipologia_attivita'] = MySQL::SQLValue($tipologia_attivita, MySQL::SQLVALUE_TEXT);
        $insC['data_inserimento'] = MySQL::SQLValue(date("Y-m-d"), MySQL::SQLVALUE_DATE);
        $insC['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $insC['created_at'] = MySQL::SQLValue(date("Y-m-d H:s:i"), MySQL::SQLVALUE_DATETIME);
        $insC['updated_at'] = MySQL::SQLValue(date("Y-m-d H:s:i"), MySQL::SQLVALUE_DATETIME);
        $insC['barcode'] = MySQL::SQLValue($this->barcodeGenerato, MySQL::SQLVALUE_TEXT);

        if (!empty($id)) {
            $insCF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.attivita', $insC, $insCF)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.attivita', $insC)) {
                echo $this->db->Kill();
            }
        }

        if (!empty($id_master)) {
            $this->insOffertaAggiornamentoCommessa($id_master, $id_composto);
        }
    }

    public function insOffertaAggiornamentoCommessa($id_master, $id_composto) {
        $insCO['id_commessa'] = MySQL::SQLValue($id_composto, MySQL::SQLVALUE_TEXT);
        $insCO['colore_commessa'] = MySQL::SQLValue('primary', MySQL::SQLVALUE_TEXT);
        $insCFO['id_master'] = MySQL::SQLValue($id_master, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.offerta', $insCO, $insCFO))
            echo $this->db->Kill();
        $this->idMaster = $id_master;
    }

    public function delCom($id) {
        $insComF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.attivita', $insComF))
            echo $this->db->Kill();
        $this->messaggio();
    }

    public function Cstato($id) {

        $insComF['id'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        $upComF['stato'] = MySQL::SQLValue('Chiusa', MySQL::SQLVALUE_TEXT);
        $upComF['data_chiusura'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $upComF['data_effettiva_chiusura'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        if (!$this->db->UpdateRows($this->tabella . '.attivita', $upComF, $insComF)) {
            echo $this->db->Kill();
        }
    }

    public function generatoreBarcode() {
        $comb = '1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $this->barcodeGenerato = implode($pass);
    }

    public function addCommessa() {

        $this->db->Query("SELECT * FROM {$_SESSION['tabella']}.anagrafica  WHERE ragioneSociale='{$_POST['cliente']}'");
        $cliente = $this->db->Row();

        $this->addInsComm($cliente->cod_cliente, $cliente->idAnagrafica, $cliente->ragioneSociale);
    }

    public function addInsComm($cod_cliente, $idAnagrafica, $ragioneSociale) {
        $annoCorrente = date("Y");
        #count di attività
        $this->db->Query("SELECT count(*) as tot FROM {$_SESSION['tabella']}.attivita WHERE YEAR(data_inserimento) = {$annoCorrente}");
        $conte = $this->db->Row();
        ++$conte->tot;
        #generazione di barcode
        $this->generatoreBarcode();
        $annoCompleto = 2024;
        $anno = substr((string) $annoCompleto, -2);
        #crezione id_composto
        $richiesta = "";
        for ($i = 0; $i <= 4; $i++) {
            if (!empty($_POST["rich_pervenuta_$i"])) {
                $richiesta .= $_POST["rich_pervenuta_$i"] . ';';
            }
        }

        $id_composto = "CODE" . $cod_cliente . '-' . $anno . $conte->tot;

        $add['id_composto'] = MySQL::SQLValue($id_composto, MySQL::SQLVALUE_TEXT);
        $add['cliente'] = MySQL::SQLValue($ragioneSociale, MySQL::SQLVALUE_TEXT);
        $add['id_user'] = MySQL::SQLValue($idAnagrafica, MySQL::SQLVALUE_TEXT);
        $add['cod_cliente'] = MySQL::SQLValue($cod_cliente, MySQL::SQLVALUE_TEXT);
        $add['committente'] = MySQL::SQLValue($_POST['committente'], MySQL::SQLVALUE_TEXT);
        $add['att_richiesta'] = MySQL::SQLValue($_POST['att_richiesta'], MySQL::SQLVALUE_TEXT);
        $add['rich_pervenuta'] = MySQL::SQLValue($richiesta, MySQL::SQLVALUE_TEXT);
        $add['data_chiusura'] = MySQL::SQLValue($_POST['data_chiusura'], MySQL::SQLVALUE_DATE);

        $add['data_inserimento'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $add['tipologia_attivita'] = MySQL::SQLValue($_POST['tipologia_attivita'], MySQL::SQLVALUE_TEXT);
        $add['centro_di_costo'] = MySQL::SQLValue($_POST['centro_costo'], MySQL::SQLVALUE_TEXT);
        $add['firma'] = MySQL::SQLValue($_SESSION['mails'], MySQL::SQLVALUE_TEXT);
        $add['created_at'] = MySQL::SQLValue(date("Y-m-d H:s:i"), MySQL::SQLVALUE_DATETIME);
        $add['updated_at'] = MySQL::SQLValue(date("Y-m-d H:s:i"), MySQL::SQLVALUE_DATETIME);
        $add['barcode'] = MySQL::SQLValue($this->barcodeGenerato, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.attivita', $add)) {
            echo $this->db->Kill();
        }
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
