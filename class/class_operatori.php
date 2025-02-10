<?php

require_once 'libreria/mysql_class.php';

class class_operatori extends MySQL {

    public $tabella;
    public $db;
    public $idCertificazioni;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
    }

    public function operatoriSelect($idOperatore = null) {

        $this->db->Query("SELECT * FROM {$this->tabella}.amministratore");
        $oper = '<option value="">Assegna Operatore</option>';
        while ($oper1 = $this->db->Row()) {
            $oper .= "<option value='{$oper1->idAmministratore}'";
            $oper .= ($oper1->idAmministratore == $idOperatore) ? "selected" : "";
            $oper .= ">" . utf8_encode($oper1->cognome . ' ' . $oper1->nome) . "</option>";
        }

        echo $oper;
    }

    public function GestioneOperatore($idAmministratore = null, $nome, $cognome, $indirizzo = null, $cap = null, $idprovincia = null, $idComune = null, $tel = null, $mobile = null, $idRuolo, $email, $codiceFiscale = null, $pws = null, $matricola, $mansione, $nascita, $luogoNascita, $cancella = null) {

        $db = new MySQL();
        $operatore['nome'] = MySQL::SQLValue($nome, MySQL::SQLVALUE_TEXT);
        $operatore['cognome'] = MySQL::SQLValue($cognome, MySQL::SQLVALUE_TEXT);
        $operatore['indirizzo'] = MySQL::SQLValue($indirizzo, MySQL::SQLVALUE_TEXT);
        $operatore['cap'] = MySQL::SQLValue($cap, MySQL::SQLVALUE_TEXT);
        $operatore['idProvincia'] = MySQL::SQLValue($provincia, MySQL::SQLVALUE_TEXT);
        $operatore['idComune'] = MySQL::SQLValue($comuni, MySQL::SQLVALUE_TEXT);
        $operatore['idRuolo'] = MySQL::SQLValue($idRuolo, MySQL::SQLVALUE_TEXT);
        $operatore['tel'] = MySQL::SQLValue($telefono, MySQL::SQLVALUE_TEXT);
        $operatore['mobile'] = MySQL::SQLValue($mobile, MySQL::SQLVALUE_TEXT);
        $operatore['matricola'] = MySQL::SQLValue($matricola, MySQL::SQLVALUE_TEXT);
        $operatore['mansione'] = MySQL::SQLValue($mansione, MySQL::SQLVALUE_TEXT);
        $operatore['nascita'] = MySQL::SQLValue($nascita, MySQL::SQLVALUE_TEXT);
        $operatore['luogoNascita'] = MySQL::SQLValue($luogoNascita, MySQL::SQLVALUE_TEXT);
        $operatore['codiceFiscale'] = MySQL::SQLValue($codiceFiscale, MySQL::SQLVALUE_TEXT);
        if (!empty( $_FILES['firma']['name'])) {
            $operatore['firma'] = MySQL::SQLValue($_FILES['firma']['name'], MySQL::SQLVALUE_TEXT);
            // carico il file
            $this->caricaFile();
        }
        $operatore['email'] = MySQL::SQLValue($email, MySQL::SQLVALUE_TEXT);
        if (isset($_POST['pws'])) {
            $operatore['pws'] = MySQL::SQLValue(md5($pws), MySQL::SQLVALUE_TEXT);
        }
        $operatore['livello'] = MySQL::SQLValue(1, MySQL::SQLVALUE_TEXT);
        $operatore['username'] = MySQL::SQLValue($_SESSION['username'], MySQL::SQLVALUE_TEXT);
        $operatore['idAzienda'] = MySQL::SQLValue($_SESSION['idAzienda'], MySQL::SQLVALUE_TEXT);
        
        $nomedb = $this->tabella . '.amministratore';

        if (isset($_POST['idAmministratore'])) {

            $operatorefiltro['idAmministratore'] = MySQL::SQLValue($idAmministratore, MySQL::SQLVALUE_TEXT);
            if (isset($cancella)) {
                $nomedb = $this->tabella . '.amministratore';

                if (!$db->DeleteRows($nomedb, $operatorefiltro))
                    echo $db->Kill();
            } else {
                if (!$db->UpdateRows($nomedb, $operatore, $operatorefiltro))
                    echo $db->Kill();
            }
        } else {
            if (!$db->InsertRow($nomedb, $operatore))
                echo $db->Kill();
        }

        @header('location:gestione-operatori.php');
    }

    public function certificazioneFissa($idCertificazione) {
        $this->idCertificazioni = $idCertificazione;
    }

    /*
     * 
     * 
     * parte delle specifiche degli operatori
     * 
     * 
     * 
     * 
     */

    public function insCertificazioni($idOperatore, $qualifica, $titolo_studio, $titoli_spec, $esperienze, $formazione) {

        $insCen['idOperatore'] = MySQL::SQLValue($idOperatore, MySQL::SQLVALUE_TEXT);
        $insCen['qualifica'] = MySQL::SQLValue($qualifica, MySQL::SQLVALUE_TEXT);
        $insCen['titolo_studio'] = MySQL::SQLValue($titolo_studio, MySQL::SQLVALUE_TEXT);
        $insCen['titoli_spec'] = MySQL::SQLValue($titoli_spec, MySQL::SQLVALUE_TEXT);
        $insCen['esperienze'] = MySQL::SQLValue($esperienze, MySQL::SQLVALUE_TEXT);
        $insCen['formazione'] = MySQL::SQLValue($formazione, MySQL::SQLVALUE_TEXT);

        $nomedb = $this->tabella . '.certificazioni';
        if (!$this->db->InsertRow($nomedb, $insCen))
            echo $this->db->Kill();
    }

    public function delCertificazione($idCertificazioni) {
        $delCen['idCertificazioni'] = MySQL::SQLValue($idCertificazioni, MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.certificazioni';
        if (!$this->db->DeleteRows($nomedb, $delCen))
            echo $thisdb->Kill();
    }

    # dettagli lavoro

    public function insDettLavoro($idOperatore, $sede_lavoro, $resp_reparto, $mansione, $spp, $cv, $cva, $costo_orario) {

        $insLav['idOperatore'] = MySQL::SQLValue($idOperatore, MySQL::SQLVALUE_TEXT);
        $insLav['sede_lavoro'] = MySQL::SQLValue($sede_lavoro, MySQL::SQLVALUE_TEXT);
        $insLav['resp_reparto'] = MySQL::SQLValue($resp_reparto, MySQL::SQLVALUE_TEXT);
        $insLav['mansione'] = MySQL::SQLValue($mansione, MySQL::SQLVALUE_TEXT);
        $insLav['spp'] = MySQL::SQLValue($spp, MySQL::SQLVALUE_TEXT);
        $insLav['cv'] = MySQL::SQLValue($cv, MySQL::SQLVALUE_TEXT);
        $insLav['cva'] = MySQL::SQLValue($cva, MySQL::SQLVALUE_TEXT);
        $insLav['costo_orario'] = MySQL::SQLValue($costo_orario, MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.dettagli_lavoro';
        if (!$this->db->InsertRow($nomedb, $insLav))
            echo $db->Kill();
    }

    public function delDettLavoro($idLavoro) {
        $delLav['idLavoro'] = MySQL::SQLValue($idLavoro, MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.dettagli_lavoro';
        if (!$this->db->DeleteRows($nomedb, $delLav))
            echo $this->db->Kill();
    }

    public function insMansione($idOperatore, $ass_inizio, $ass_fine, $ass_tempo, $ass_contratto, $ass_avvisi, $ass_durata) {
        $insMan['idOperatore'] = MySQL::SQLValue($idOperatore, MySQL::SQLVALUE_TEXT);
        $insMan['ass_inizio'] = MySQL::SQLValue($ass_inizio, MySQL::SQLVALUE_DATE);
        $insMan['ass_fine'] = MySQL::SQLValue($ass_fine, MySQL::SQLVALUE_DATE);
        $insMan['ass_tempo'] = MySQL::SQLValue($ass_tempo, MySQL::SQLVALUE_TEXT);
        $insMan['ass_contratto'] = MySQL::SQLValue($ass_contratto, MySQL::SQLVALUE_TEXT);
        $insMan['ass_avvisi'] = MySQL::SQLValue($ass_avvisi, MySQL::SQLVALUE_TEXT);
        $insMan['ass_durata'] = MySQL::SQLValue($ass_durata, MySQL::SQLVALUE_TEXT);

        $nomedb = $this->tabella . '.modalita_assunzione';
        if (!$this->db->InsertRow($nomedb, $insMan))
            echo $this->db->Kill();
    }

    public function delMans($idAssunzione) {
        $delMan['idAssunzione'] = MySQL::SQLValue($idAssunzione, MySQL::SQLVALUE_TEXT);
        $nomedb = $this->tabella . '.modalita_assunzione';
        if (!$this->db->DeleteRows($nomedb, $delMan))
            echo $this->db->Kill();
    }

    public function selectMansione($mansione) {

        $this->db->Query("SELECT * FROM {$this->tabella}.amministratore where mansione='{$mansione}'");
        $oper = '<option value="">Scegli</option>';
        while ($oper1 = $this->db->Row()) {
            $oper .= "<option value='{$oper1->idAmministratore}'";
            $oper .= ($oper1->idAmministratore == $idOperatore) ? "selected" : "";
            $oper .= ">" . utf8_encode($oper1->email) . "</option>";
        }

        echo $oper;
    }

    public function modProfilo($nome, $cognome, $email, $pass, $idAmministratore) {
        $mod['idOperatore'] = MySQL::SQLValue($idOperatore, MySQL::SQLVALUE_TEXT);
    }

    public function caricaFile() {

        $uploadedFile = $_FILES['firma'];
        if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
            $tempName = $uploadedFile['tmp_name'];
            $originalName = $uploadedFile['name'];
            $uploadDir = "firma_image/{$_SESSION['idAzienda']}/";
// Verifica se la cartella esiste
            if (!is_dir($uploadDir)) {
                // Se non esiste, prova a crearla
                if (mkdir($uploadDir, 0777, true)) {
                    //echo "La cartella è stata creata con successo.";
                } else {
                    echo "Si è verificato un errore durante la creazione della cartella.";
                }
            }
               
                $destination = $uploadDir . $originalName;

                if (move_uploaded_file($tempName, $destination)) {
                    echo 'Immagine caricata con successo!';
                } else {
                    echo 'Si è verificato un errore durante il caricamento dell\'immagine.';
                }
            } else {
                echo 'Si è verificato un errore durante il caricamento dell\'immagine.';
            }
        }

      

    }
    