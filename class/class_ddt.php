b
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_ddt extends MySQL {

    private $tabella;
    public $db;
    public $risultato;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function cancDDT($id) {
        $delDDT['id_master'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.ddt', $delDDT)) {
            echo $this->db->Kill();
        }
    }

    public function conteggio() {

        // Ottieni l'anno corrente
        $anno_corrente = date("Y");

// Modifica la query per ottenere anche l'anno dell'ultimo record
        $this->db->Query("SELECT n_ddt, YEAR(created_at) as anno_record FROM {$this->tabella}.ddt ORDER BY id_master DESC LIMIT 1");
        if ($this->db->RowCount() > 0) {
            $conteggio = $this->db->Row();

// Controlla se l'anno dell'ultimo record è diverso dall'anno corrente
            if ($conteggio && $conteggio->anno_record != $anno_corrente) {
                // Se l'anno è diverso, inizia da 1
                $this->risultato = 1;
            } else {
                // Altrimenti, incrementa il n_ddt
                $this->risultato = $conteggio->n_ddt + 1;
            }
        } else {
            $this->risultato = 1;
        }
    }

    public function inseDDT($n_ddt, $data_emissione, $destinatario, $ragione_sociale, $flag_dest, $sede_op_custom, $riferimento, $idc_attivita, $annotazioni, $vettore, $asp_esteriore, $n_colli, $causale, $firma, $cod_cliente, $id_master = null) {
        $insDDTF['id_master'] = MySQL::SQLValue($id_master, MySQL::SQLVALUE_TEXT);
        $insDDT['n_ddt'] = MySQL::SQLValue($n_ddt, MySQL::SQLVALUE_TEXT);
        $insDDT['data_emissione'] = MySQL::SQLValue($data_emissione, MySQL::SQLVALUE_TEXT);
        if (!empty($destinatario)) {
            $insDDT['destinatario'] = MySQL::SQLValue($destinatario, MySQL::SQLVALUE_TEXT);
            $insDDT['cod_destinatario'] = MySQL::SQLValue($cod_cliente, MySQL::SQLVALUE_TEXT);
        }
        $insDDT['ragione_sociale'] = MySQL::SQLValue($ragione_sociale, MySQL::SQLVALUE_TEXT);
        $insDDT['flag_dest'] = MySQL::SQLValue($flag_dest, MySQL::SQLVALUE_TEXT);
        $insDDT['sede_op_custom'] = MySQL::SQLValue($sede_op_custom, MySQL::SQLVALUE_TEXT);
        $insDDT['riferimento'] = MySQL::SQLValue($riferimento, MySQL::SQLVALUE_TEXT);
        if (!empty($idc_attivita)) {
            $insDDT['idc_attivita'] = MySQL::SQLValue($idc_attivita, MySQL::SQLVALUE_TEXT);
        }
        $insDDT['annotazioni'] = MySQL::SQLValue($annotazioni, MySQL::SQLVALUE_TEXT);
        $insDDT['vettore'] = MySQL::SQLValue($vettore, MySQL::SQLVALUE_TEXT);
        $insDDT['asp_esteriore'] = MySQL::SQLValue($asp_esteriore, MySQL::SQLVALUE_TEXT);
        $insDDT['n_colli'] = MySQL::SQLValue($n_colli, MySQL::SQLVALUE_TEXT);
        $insDDT['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $insDDT['causale'] = MySQL::SQLValue($causale, MySQL::SQLVALUE_TEXT);
        $insDDT['firma'] = MySQL::SQLValue($firma, MySQL::SQLVALUE_TEXT);
        $insDDT['created_at'] = MySQL::SQLValue(date('Y-m-d H:i:s'), MySQL::SQLVALUE_DATETIME);
        $insDDT['updated_at'] = MySQL::SQLValue(date('Y-m-d H:i:s'), MySQL::SQLVALUE_DATETIME);
        if (!empty($id_master)) {
            if (!$this->db->UpdateRows($this->tabella . '.ddt', $insDDT, $insDDTF)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.ddt', $insDDT)) {
                echo $this->db->Kill();
            }
        }
        $this->aggArticoli($n_ddt);
    }

    public function insAggF($n_ddt, $data_emissione, $destinatario, $ragione_sociale, $flag_dest, $sede_op_custom, $riferimento, $idc_attivita, $annotazioni, $vettore, $asp_esteriore, $n_colli, $causale, $firma, $id_master = null) {
        if ($destinatario == 'fornitore') {

            $this->db->Query("select * from {$this->tabella}.fornitori where ragioneSociale='$ragione_sociale'");
            $prova = $this->db->Row();
            $forn = $prova->cod_fornitore;
        } else {
            $this->db->Query("select * from {$this->tabella}.anagrafica where ragioneSociale='$ragione_sociale'");
            $prova = $this->db->Row();
            $forn = $prova->cod_cliente;
        }

        $this->inseDDT($n_ddt, $data_emissione, $destinatario, $ragione_sociale, $flag_dest, $sede_op_custom, $riferimento, $idc_attivita, $annotazioni, $vettore, $asp_esteriore, $n_colli, $causale, $firma, $forn, $id_master = null);
    }

    public function aggArticoli($n_ddt) {
        // Assicurati che posizione, descrizione e quantita siano array e abbiano la stessa lunghezza
        if (is_array($_POST['posizione']) && is_array($_POST['descrizione']) && is_array($_POST['quantita']) &&
                count($_POST['posizione']) == count($_POST['descrizione']) && count($_POST['posizione']) == count($_POST['quantita'])) {

            for ($i = 0; $i < count($_POST['posizione']); $i++) {
                // Salta l'inserimento se uno dei campi è vuoto
                if (empty($_POST['posizione'][$i]) || empty($_POST['descrizione'][$i]) || empty($_POST['quantita'][$i])) {
                    continue;
                }

                $insDDTA = array();
                $insDDTA['n_ddt'] = MySQL::SQLValue($n_ddt, MySQL::SQLVALUE_TEXT);
                $insDDTA['posizione'] = MySQL::SQLValue($_POST['posizione'][$i], MySQL::SQLVALUE_TEXT);
                $insDDTA['descrizione'] = MySQL::SQLValue($_POST['descrizione'][$i], MySQL::SQLVALUE_TEXT);
                $insDDTA['qnt'] = MySQL::SQLValue($_POST['quantita'][$i], MySQL::SQLVALUE_TEXT);
                $insDDTA['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

                if (!$this->db->InsertRow($this->tabella . '.ddt_articoli', $insDDTA)) {
                    echo $this->db->Kill();
                    return; // Interrompi l'esecuzione in caso di errore
                }
            }
        } else {
            echo "Errore: I parametri forniti non sono array validi o non corrispondono.";
        }
        header('location:gestione-ddt.php');
    }

    public function cancDDTAR($id) {
        $delDDTA['idDA'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.ddt_articoli', $delDDTA)) {
            echo $this->db->Kill();
        }
    }
}
