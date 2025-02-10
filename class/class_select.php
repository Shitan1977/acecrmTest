<?php

session_start();
ob_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_select extends MySQL {

    public $db;
    public $codice_cliente;
    public $anno;
    public $commessa;
    public $riferimento;
    public $anno_ordine;
    public $descrizione_ordine;

    public function __construct() {

        $this->db = new MySQL();
    }

    public function ShowRegioni() {

        if (!$this->db->Query("SELECT * FROM admin_acecrm.regioni"))
            echo $this->db->Kill();

        $regioni = '<option value="">scegli...</option>';
        while ($regioni1 = $this->db->Row()) {

            $regioni .= '<option value="' . $regioni1->id_reg . '">' . utf8_encode($regioni1->nome_regione) . '</option>';
        }

        return $regioni;
    }

    public function ShowProvince() {

        if (!$this->db->Query("SELECT * FROM admin_acecrm.province WHERE id_reg={$_POST['id_reg']}"))
            echo $this->db->Kill();

        $province = '<option value="">scegli...</option>';

        while ($province1 = $this->db->Row()) {
            $province .= '<option value="' . $province1->id_pro . '">' . utf8_encode($province1->nome_provincia) . '</option>';
        }

        return $province;
    }

    public function ShowComuni() {

        if (!$this->db->Query("SELECT * FROM admin_acecrm.comuni WHERE id_pro={$_POST['id_pro']}"))
            echo $this->db->Kill();

        $comuni = '<option value="">scegli...</option>';

        while ($comuni1 = $this->db->Row()) {
            $comuni .= '<option value="' . $comuni1->id_com . '">' . utf8_encode($comuni1->comune) . '</option>';
        }

        return $comuni;
    }

    public function ShowAnagrafica() {

        if (!$this->db->Query("SELECT * FROM anagrafica WHERE idAzienda='{$_SESSION['company']}' ORDER BY anagrafica.nome"))
            echo $this->db->Kill();

        $anagrafica = '<option value="">scegli...</option>';

        while ($anagrafica1 = $this->db->Row()) {
            $anagrafica .= '<option value="' . $anagrafica1->idAnagrafica . '">' . utf8_encode($anagrafica1->ragioneSociale) . '(' . utf8_encode($anagrafica1->cognome) . ' ' . utf8_encode($anagrafica1->nome) . ')</option>';
        }

        return $anagrafica;
    }

    public function ShowPreventivo() {

        if (!$this->db->Query("SELECT * FROM prev_marmi, anagrafica WHERE prev_marmi.idAnagrafica='{$_POST['idAnagrafica']}' AND prev_marmi.idAnagrafica=anagrafica.idAnagrafica  AND prev_marmi.attivo='1'"))
            ;

        $preventivo = '<option value="">scegli...</option>';

        while ($preventivo1 = $this->db->Row()) {
            $preventivo .= '<option value="' . $preventivo1->idPrevMarmi . '">' . utf8_encode($preventivo1->numero) . '-' . utf8_encode($preventivo1->ragioneSociale) . ' ' . utf8_encode($preventivo1->oggetto) . '</option>';
        }

        return $preventivo;
    }

    public function ShowCategoriaAbbigliamento() {

        if (!$this->db->Query("SELECT * FROM categoria_abbigliamento WHERE idAzienda='{$_SESSION['company']}' AND attivo='0'"))
            echo $this->db->Kill();

        $categoria = '<option value="">scegli...</option>';

        while ($categoria1 = $this->db->Row()) {
            $categoria .= '<option value="' . $categoria1->idCategoria . '">' . utf8_encode($categoria1->nome) . '</option>';
        }

        return $categoria;
    }

    public function ShowSubCategoriaAbbigliamento() {

        if (!$this->db->Query("SELECT * FROM sottocategorie_abbigliamento WHERE idCategoria='{$_POST['idCategoria']}'"))
            ;

        $subcategoria = '<option value="">scegli...</option>';

        while ($subcategoria1 = $this->db->Row()) {
            $subcategoria .= '<option value="' . $subcategoria1->idSottoCategorie . '">' . utf8_encode($subcategoria1->nome) . '</option>';
        }

        return $subcategoria;
    }

    /*
     * 
     * CREO LA PARTE INERENTE AI MODULI E PERMESSI
     * 
     * 
     */

    public function ShowRuoli($tabella) {

        if (!$this->db->Query("SELECT * FROM {$tabella}.ruolo"))
            echo $this->db->Kill();

        $ruolo = '<option value="">scegli...</option>';
        while ($ruolo1 = $this->db->Row()) {

            $ruolo .= '<option value="' . $ruolo1->idRuolo . '">' . utf8_encode($ruolo1->ruolo) . '</option>';
        }

        return $ruolo;
    }

    public function ShowPermessi($tabella, $azienda) {

        if (!$this->db->Query("SELECT idModulo, mo.modulo FROM admin_acecrm.moduli_attivi  as m INNER JOIN admin_acecrm.moduli as mo on mo.idModuli=m.modulo WHERE NOT EXISTS ( SELECT *FROM {$tabella}.permessi  as p WHERE m.idModulo = p.idModuli and idRuolo={$_POST['idRuolo']}) and idAzienda={$azienda}"))
            echo $this->db->Kill();

        $permessi = '<option value="">scegli...</option>';

        while ($permessi1 = $this->db->Row()) {
            $permessi .= '<option value="' . $permessi1->idModulo . '">' . utf8_encode($permessi1->modulo) . '</option>';
        }

        return $permessi;
    }

    /*
     * 
     * CREO LA PARTE dinamica di coc
     * 
     * 
     */

    public function ShowAttivita($tabella) {

        if (!$this->db->Query("SELECT distinct(ana.cod_cliente), ragioneSociale FROM {$tabella}.anagrafica as ana ORDER BY ragioneSociale ASC")) {
            echo $this->db->Kill();
        }

        $commessa = '<option value="">scegli...</option>';
        while ($commessa1 = $this->db->Row()) {

            $commessa .= '<option value="' . $commessa1->cod_cliente . '">' . utf8_encode($commessa1->ragioneSociale) . '</option>';
        }

        return $commessa;
    }

    public function ShowAttivitaAnno($tabella) {

        if (!$this->db->Query("SELECT distinct(year(data_inserimento)) as anno,a.cod_cliente  FROM {$tabella}.attivita as a  inner join {$tabella}.anagrafica as ana on ana.cod_cliente=a.cod_cliente where  a.cod_cliente ={$_POST['cod_cliente']} ORDER BY year(data_inserimento) ASC")) {
            echo $this->db->Kill();
        }
        $this->codice_cliente = $codice;
        $annocommessa = '<option value="">scegli...</option>';
        while ($annocommessa1 = $this->db->Row()) {

            $annocommessa .= '<option value="' . $annocommessa1->anno . '">' . utf8_encode($annocommessa1->anno) . '</option>';
        }

        return $annocommessa;
    }

    public function ShowAttivitaDescrizione($tabella, $codice) {

        if (!$this->db->Query("SELECT distinct(att_richiesta) FROM {$tabella}.attivita as a  inner join {$tabella}.anagrafica as ana on ana.cod_cliente=a.cod_cliente where  a.cod_cliente ='{$codice}' and year(data_inserimento)='{$_POST['anno']}'")) {
            echo $this->db->Kill();
        }

        $descrizionecommessa = '<option value="">scegli...</option>';
        while ($descrizionecommessa1 = $this->db->Row()) {

            $descrizionecommessa .= '<option value="' . $descrizionecommessa1->att_richiesta . '">' . utf8_encode($descrizionecommessa1->att_richiesta) . '</option>';
        }

        return $descrizionecommessa;
    }

    public function ShowAttivitaCommessa($tabella, $codice, $anno) {

        if (!$this->db->Query("SELECT distinct(id_composto) FROM {$tabella}.attivita as a  inner join {$tabella}.anagrafica as ana on ana.cod_cliente=a.cod_cliente where  a.cod_cliente ='{$codice}'  and a.att_richiesta ='{$_POST['descrizione']}' and year(data_inserimento)='{$anno}'")) {
            echo $this->db->Kill();
        }

        $comcommessa = '<option value="">scegli...</option>';
        while ($comcommessa1 = $this->db->Row()) {

            $comcommessa .= '<option value="' . $comcommessa1->id_composto . '">' . utf8_encode($comcommessa1->id_composto) . '</option>';
        }

        return $comcommessa;
    }

    public function ShowAttivitaRiferimenti($tabella, $codice, $anno, $descrizione) {

        if (!$this->db->Query("SELECT distinct(att.n_ordine) FROM {$tabella}.attivita as a  inner join {$tabella}.anagrafica as ana on ana.cod_cliente=a.cod_cliente inner join {$tabella}.attivita_4 as  att ON att.id_attivita=a.id where  a.cod_cliente ='{$codice}'  and a.id_composto ='{$_POST['commessa']}' and a.att_richiesta ='{$descrizione}' and year(data_inserimento)='{$anno}'")) {
            echo $this->db->Kill();
        }

        $rifcommessa = '<option value="">scegli...</option>';
        while ($rifcommessa1 = $this->db->Row()) {

            $rifcommessa .= '<option value="' . $rifcommessa1->n_ordine . '">' . utf8_encode($rifcommessa1->n_ordine) . '</option>';
        }

        return $rifcommessa;
    }

    public function ShowAttivitaAnnoOrdine($tabella, $codice, $anno, $descrizione, $commessa) {
        if (!$this->db->Query("SELECT distinct(att.data_ordine) FROM {$tabella}.attivita as a  inner join {$tabella}.anagrafica as ana on ana.cod_cliente=a.cod_cliente inner join {$tabella}.attivita_4 as  att ON att.id_attivita=a.id where  a.cod_cliente ='{$codice}'  and a.id_composto ='{$commessa}' and a.att_richiesta ='{$descrizione}' and year(data_inserimento)='{$anno}' and att.n_ordine='{$_POST['riferimento']}'")) {
            echo $this->db->Kill();
        }

        $annocommessa = '<option value="">scegli...</option>';
        while ($annocommessa1 = $this->db->Row()) {

            $annocommessa .= '<option value="' . $annocommessa1->data_ordine . '">' . utf8_encode($annocommessa1->data_ordine) . '</option>';
        }

        return $annocommessa;
    }

    public function ShowAttivitaAnnoDescOrdine($tabella, $codice, $anno, $descrizione, $commessa, $riferimento) {
   
        if (!$this->db->Query("SELECT distinct(att.data_ordine), att.n_ordine FROM {$tabella}.attivita as a  inner join {$tabella}.anagrafica as ana on ana.cod_cliente=a.cod_cliente inner join {$tabella}.attivita_4 as  att ON att.id_attivita=a.id where a.nome_azienda_app='MES' and a.cod_cliente ='{$codice}'  and a.id_composto ='{$commessa}' and a.att_richiesta ='{$descrizione}' and year(data_inserimento)='{$anno}' and att.n_ordine='{$riferimento}'")) {
            echo $this->db->Kill();
        }

        $annocommessaD = '<option value="">scegli...</option>';
        while ($annocommessaD1 = $this->db->Row()) {

            $annocommessaD .= '<option value="' . $annocommessaD1->n_ordine.' del '.$annocommessaD1->data_ordine . '">' . utf8_encode($annocommessaD1->n_ordine) .' del '. $annocommessaD1->data_ordine.'</option>';
        }

        return $annocommessaD;
    }

}

?>