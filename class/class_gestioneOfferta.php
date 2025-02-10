<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/libreria/mysql_class.php';

class class_gestioneOfferta extends MySQL {

    private $tabella;
    public $db;
    private $anno;
    public $prezzoivato;
    public $prezzoscontato;
    public $sconto;
    public $prezzoTotale;
    public $idMaster;
    public $Ordine;
    public $n_offerta;
    public $risultato;

    public function __construct($tabella) {
        $this->tabella = $tabella;
        $this->db = new MySQL();
        $this->anno = date('Y');
    }

    //variabile fissa
    public function setFissi($idMaster) {
        $this->idMaster = $idMaster;
    }

    // ordine
    public function setOrdine($nordine) {
        $this->Ordine = $nordine;
    }

    public function insOfferta($oggetto, $cliente, $data, $metodo_pagamento, $annotazioni, $email, $divisione) {
        // calcolo il numero di offerta
        $anno = date('Y');
        if ($this->db->Query("SELECT * FROM {$this->tabella}.offerta where year(data)='$anno' order by n_offerta desc limit 1"))
            ;
        $n_offerte = $this->db->Row();
        $n = $n_offerte->n_offerta + 1;
        $this->insOfferCliente($oggetto, $cliente, $data, $metodo_pagamento, $annotazioni, $n, $email, $divisione);
    }

    public function insOfferCliente($oggetto, $cliente, $data, $metodo_pagamento, $annotazioni, $n, $email, $divisione) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.anagrafica where ragioneSociale='$cliente'"))
            ;
        $cod_cliente = $this->db->Row();
        $this->inserEle($oggetto, $cliente, $data, $metodo_pagamento, $annotazioni, $n, $cod_cliente->cod_cliente, $email, $divisione);
    }

    public function inserEle($oggetto, $cliente, $data, $metodo_pagamento, $annotazioni, $n, $cod_cliente, $email, $divisione) {
        $insOff['oggetto'] = MySQL::SQLValue($oggetto, MySQL::SQLVALUE_TEXT);
        $insOff['rag_soc_cliente'] = MySQL::SQLValue($cliente, MySQL::SQLVALUE_TEXT);
        $insOff['data'] = MySQL::SQLValue($data, MySQL::SQLVALUE_DATE);
        $insOff['data_ins'] = MySQL::SQLValue(date('Y-m-d h:i'), MySQL::SQLVALUE_DATETIME);
        $insOff['pagamenti'] = MySQL::SQLValue($metodo_pagamento, MySQL::SQLVALUE_TEXT);
        $insOff['annotazioni'] = MySQL::SQLValue($annotazioni, MySQL::SQLVALUE_TEXT);
        $insOff['n_offerta'] = MySQL::SQLValue($n, MySQL::SQLVALUE_TEXT);
        $insOff['cod_cliente'] = MySQL::SQLValue($cod_cliente, MySQL::SQLVALUE_TEXT);
        $insOff['colore_riesame_offerta'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_esito'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_ordine'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_riesame_ordine'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_ddt'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['idDivisione'] = MySQL::SQLValue($_POST['divisione'], MySQL::SQLVALUE_TEXT);
        $insOff['colore_commessa'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['stato'] = MySQL::SQLValue('attesa', MySQL::SQLVALUE_TEXT);
        $insOff['firma'] = MySQL::SQLValue('direction@mesgroup.it', MySQL::SQLVALUE_TEXT);
        $insOff['created_at'] = MySQL::SQLValue(date('Y-m-d h:i'), MySQL::SQLVALUE_DATETIME);
        $insOff['pdf'] = MySQL::SQLValue($_FILES["pdf"]["name"], MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.offerta', $insOff))
            echo $this->db->Kill();
        $this->caricamento();
    }

    public function caricamento() {
        $uploadedFile = $_FILES['pdf'];
        if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
            $tempName = $uploadedFile['tmp_name'];
            $originalName = $uploadedFile['name'];
            $uploadDir = "offerte_pdf/{$_SESSION['idAzienda']}/";
            if (!file_exists($uploadDir)) {
                // Crea la cartella
                if (mkdir($uploadDir)) {
                    //  echo "La cartella '$uploadDir' è stata creata con successo.\n";
                } else {
                    echo "Si è verificato un errore durante la creazione della cartella.\n";
                }
            }

            $destination = $uploadDir . $originalName;
            if (move_uploaded_file($tempName, $destination)) {
                // echo 'Immagine caricata con successo!';
            } else {
                echo 'Si è verificato un errore durante il caricamento dell\'immagine.';
            }
        } else {
            echo 'Si è verificato un errore durante il caricamento dell\'immagine.';
        }
    }

    #revisione offerta

    public function revisione($n_offerta) {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.offerta where year(data)='$this->anno' and n_offerta='$n_offerta'  order by n_offerta desc limit 1"))
            ;
        $revisione = $this->db->Row();
        $insOff['oggetto'] = MySQL::SQLValue($revisione->oggetto, MySQL::SQLVALUE_TEXT);
        $insOff['rag_soc_cliente'] = MySQL::SQLValue($revisione->rag_soc_cliente, MySQL::SQLVALUE_TEXT);
        $insOff['data'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $insOff['data_ins'] = MySQL::SQLValue(date('Y-m-d h:i'), MySQL::SQLVALUE_DATETIME);
        $insOff['pagamenti'] = MySQL::SQLValue($revisione->pagamenti, MySQL::SQLVALUE_TEXT);
        $insOff['annotazioni'] = MySQL::SQLValue($revisione->annotazioni, MySQL::SQLVALUE_TEXT);
        $insOff['n_offerta'] = MySQL::SQLValue($revisione->n_offerta, MySQL::SQLVALUE_TEXT);
        $insOff['cod_cliente'] = MySQL::SQLValue($revisione->cod_cliente, MySQL::SQLVALUE_TEXT);
        $insOff['colore_riesame_offerta'] = MySQL::SQLValue('danger', MySQL::SQLVALUE_TEXT);
        $insOff['colore_esito'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_ordine'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_riesame_ordine'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['colore_commessa'] = MySQL::SQLValue('default', MySQL::SQLVALUE_TEXT);
        $insOff['stato'] = MySQL::SQLValue('attesa', MySQL::SQLVALUE_TEXT);
        $insOff['firma'] = MySQL::SQLValue('direction@mesgroup.it', MySQL::SQLVALUE_TEXT);
        $insOff['created_at'] = MySQL::SQLValue(date('Y-m-d h:i'), MySQL::SQLVALUE_DATETIME);
        $insOff['revisione'] = MySQL::SQLValue($revisione->revisione + 1, MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.offerta', $insOff))
            echo $this->db->Kill();
        $this->gestioneduplicata();
    }

    public function gestioneduplicata() {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.articoli_offerta where year(data)='$this->anno' order by id_master desc limit 1"))
            ;
        while ($revisioneDup = $this->db->Row()) {
            $this->atttDuplicata($revisioneDup->id_master, $revisioneDup->codice_articolo, $revisioneDup->quantita, $revisioneDup->iva, $revisioneDup->prezzo_unitario, $revisioneDup->importo_ivato_totale, $revisioneDup->importo_ivato_scontato, $revisioneDup->descrizione, $revisioneDup->note, $revisioneDup->unitamisura, $revisioneDup->sconto);
        }
    }

    public function atttDuplicata($id_master, $codice_articolo, $quantita, $iva, $prezzo_unitario, $importo_ivato_totale, $importo_ivato_scontato, $descrizione, $note, $unitamisura, $sconto) {
        $insAttD['id_master'] = MySQL::SQLValue($id_master, MySQL::SQLVALUE_TEXT);
        $insAttD['codice_articolo'] = MySQL::SQLValue($codice_articolo, MySQL::SQLVALUE_TEXT);
        $insAttD['quantita'] = MySQL::SQLValue($quantita, MySQL::SQLVALUE_TEXT);
        $insAttD['iva'] = MySQL::SQLValue($iva, MySQL::SQLVALUE_TEXT);
        $insAttD['prezzo_unitario'] = MySQL::SQLValue($prezzo_unitario, MySQL::SQLVALUE_TEXT);
        $insAttD['importo'] = MySQL::SQLValue($importo_ivato_totale, MySQL::SQLVALUE_TEXT);
        $insAttD['importo_ivato_scontato'] = MySQL::SQLValue($importo_ivato_scontato, MySQL::SQLVALUE_TEXT);
        $insAttD['importo_ivato_totale'] = MySQL::SQLValue($importo_ivato_totale, MySQL::SQLVALUE_TEXT);
        $insAttD['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insAttD['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $insAttD['unitamisura'] = MySQL::SQLValue($unitamisura, MySQL::SQLVALUE_TEXT);
        $insAttD['sconto'] = MySQL::SQLValue($sconto, MySQL::SQLVALUE_TEXT);
        $insAttD['updated_at'] = MySQL::SQLValue(date('Y-m-d h:i:s'), MySQL::SQLVALUE_DATETIME);
        $insAttD['created_at'] = MySQL::SQLValue(date('Y-m-d h:i:s'), MySQL::SQLVALUE_DATETIME);
        $insAttD['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.articoli_offerta', $insAttD))
            echo $this->db->Kill();
    }

    # ATTIVITA' 3 

    public function attivita($codice_articolo, $id_master, $quantita, $iva, $prezzo_unitario, $descrizione, $note, $unitamisura, $sconto, $idAtt = null) {
 
        if (empty($iva)) {
            $this->calcoloIva($prezzo_unitario, $iva);
            
            $importo_ivato_totale = $this->prezzoivato;
          
        } else {
            $importo_ivato_totale = $prezzo_unitario;
        }

        if (empty($sconto)) {
            $this->sconto($importo_ivato_totale, $sconto);
            $importo_ivato_scontato = $this->prezzoscontato;
        } else {
            $importo_ivato_scontato = $prezzo_unitario;
        }

        $insAtt['id_master'] = MySQL::SQLValue($id_master, MySQL::SQLVALUE_TEXT);
        $insAtt['codice_articolo'] = MySQL::SQLValue($codice_articolo, MySQL::SQLVALUE_TEXT);
        $insAtt['quantita'] = MySQL::SQLValue($quantita, MySQL::SQLVALUE_TEXT);
        $insAtt['iva'] = MySQL::SQLValue($iva, MySQL::SQLVALUE_TEXT);
        $insAtt['prezzo_unitario'] = MySQL::SQLValue($prezzo_unitario, MySQL::SQLVALUE_TEXT);
        $insAtt['importo'] = MySQL::SQLValue($importo_ivato_totale, MySQL::SQLVALUE_TEXT);
        $insAtt['importo_ivato_scontato'] = MySQL::SQLValue($importo_ivato_scontato, MySQL::SQLVALUE_TEXT);
        $insAtt['importo_ivato_totale'] = MySQL::SQLValue($importo_ivato_totale, MySQL::SQLVALUE_TEXT);
        $insAtt['descrizione'] = MySQL::SQLValue($descrizione, MySQL::SQLVALUE_TEXT);
        $insAtt['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);
        $insAtt['unitamisura'] = MySQL::SQLValue($unitamisura, MySQL::SQLVALUE_TEXT);
        $insAtt['sconto'] = MySQL::SQLValue($sconto, MySQL::SQLVALUE_TEXT);
        $insAtt['updated_at'] = MySQL::SQLValue(date('Y-m-d h:i:s'), MySQL::SQLVALUE_DATETIME);
        $insAtt['created_at'] = MySQL::SQLValue(date('Y-m-d h:i:s'), MySQL::SQLVALUE_DATETIME);
        $insAtt['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        if (empty($idAtt)) {
            if (!$this->db->InsertRow($this->tabella . '.articoli_offerta', $insAtt))
                echo $this->db->Kill();
        } else {
            $insAttF['id'] = MySQL::SQLValue($idAtt, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.articoli_offerta', $insAtt, $insAttF))
                echo $this->db->Kill();
        }
        $this->aggPrezzoOfferta($id_master);
    }

    public function aggPrezzoOfferta($idMaster) {

        if ($this->db->Query("SELECT SUM(importo * quantita) AS TotaleImporto, SUM(CASE WHEN sconto IS NOT NULL THEN (importo * quantita) - ((importo * quantita) * sconto / 100) ELSE importo * quantita END) AS TotaleConSconto, SUM(CASE WHEN sconto IS NOT NULL THEN ((importo * quantita) - ((importo * quantita) * sconto / 100)) * (1 + (iva / 100)) ELSE (importo * quantita) * (1 + (iva / 100)) END) AS TotaleConIVA FROM {$this->tabella}.articoli_offerta WHERE id_master = '$idMaster'"))
            ;
        $importoagg = $this->db->Row();
        $aggPrezzo['importo_netto'] = MySQL::SQLValue($importoagg->TotaleConIVA, MySQL::SQLVALUE_TEXT);
        // aggiornamento
        $aggPezzoF['id_master'] = MySQL::SQLValue($idMaster, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $aggPrezzo, $aggPezzoF))
            echo $this->db->Kill();
    }

    public function calcoloIva($prezzoUnitario, $iva) {
        if (empty($iva)) {
            $iva = 0;
        } else {
            $iva = $iva;
        }
        $this->prezzoivato = $prezzoUnitario + ($prezzoUnitario * $iva) / 100;
    }

    public function sconto($prezzoUnitario, $sconto) {
        if (empty($sconto)) {
            $sconto = 0;
        } else {
            $sconto = $sconto;
        }
        $sconto1 = ($prezzoUnitario / 100) * $sconto;
        $this->sconto = $sconto1;
        $this->prezzoscontato = number_format(($prezzoUnitario - $sconto1), 2);
    }

    public function importoTotale($id_master) {

        if ($this->db->Query("SELECT SUM(importo * quantita) AS importo_totale, SUM(CASE WHEN sconto IS NOT NULL THEN (importo * quantita) - ((importo * quantita) * sconto / 100) ELSE importo * quantita END) AS importo_scontato, SUM(CASE WHEN sconto IS NOT NULL THEN ((importo * quantita) - ((importo * quantita) * sconto / 100)) * (1 + (iva / 100)) ELSE (importo * quantita) * (1 + (iva / 100)) END) AS importo_ivato FROM  {$this->tabella}.articoli_offerta WHERE id_master = $id_master"))
            ;
        $totale = $this->db->Row();
        echo $totale->importo;
        $this->prezzoTotale = $totale->importo_totale;
        $this->prezzoscontato = $totale->importo_scontato;
        $this->prezzoivato = $totale->importo_ivato;
    }

    public function cancellazioneAttivita($idAtt) {
        $canc['id'] = MySQL::SQLValue($idAtt, MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.articoli_offerta', $canc))
            echo $this->db->Kill();
        $this->aggPrezzoOfferta($_POST['id_master']);
    }

    public function modificaIntestazioneOfferta($n_offerta, $oggetto, $cliente, $data, $metodo_pagamento, $annotazioni, $pagamentoLibero, $notelibere, $idMaster) {
        $pag_combinato = $metodo_pagamento . ";" . $pagamentoLibero;

        $insOff['oggetto'] = MySQL::SQLValue($oggetto, MySQL::SQLVALUE_TEXT);
        $insOff['rag_soc_cliente'] = MySQL::SQLValue($cliente, MySQL::SQLVALUE_TEXT);
        $insOff['data'] = MySQL::SQLValue($data, MySQL::SQLVALUE_TEXT);
        $insOff['pagamenti'] = MySQL::SQLValue($pag_combinato, MySQL::SQLVALUE_TEXT);
        // $insOff['annotazioni'] = MySQL::SQLValue($_POST['annotazioni'], MySQL::SQLVALUE_TEXT);
        $insOff['noteLibere'] = MySQL::SQLValue($notelibere, MySQL::SQLVALUE_TEXT);
        $insOfff['id_master'] = MySQL::SQLValue($idMaster, MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.offerta', $insOff, $insOfff))
            echo $this->db->Kill();

        $this->idMaster = $idMaster;
          $this->messaggioBello($prova = true, $pagina = 'gestione-dettOfferte.php', $n_offerta, $idMaster, "formMOfiicaOfferta");
    }

    #attivita 4

    public function aggOrdine($id_attivita, $nome_file, $tmp_file, $n_ordine, $importo_ordine, $data_ordine, $idAzienda) {
        $insOrd['id_attivita'] = MySQL::SQLValue($id_attivita, MySQL::SQLVALUE_TEXT);
        $insOrd['nome_file'] = MySQL::SQLValue($nome_file, MySQL::SQLVALUE_TEXT);
        $insOrd['n_ordine'] = MySQL::SQLValue($n_ordine, MySQL::SQLVALUE_TEXT);
        $insOrd['importo_ordine'] = MySQL::SQLValue($importo_ordine, MySQL::SQLVALUE_TEXT);
        $insOrd['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $insOrd['data_ordine'] = MySQL::SQLValue($data_ordine, MySQL::SQLVALUE_DATE);

        if (!$this->db->InsertRow($this->tabella . '.attivita_4', $insOrd))
            echo $this->db->Kill();
        $this->Ordine = $n_ordine;
        $this->caricamentoFile($nome_file, $tmp_file, $idAzienda);
    }

    public function caricamentoFile($nome_file, $tmp_file, $idAzienda) {
        $file_dir = "FileOfferte/$idAzienda";
        if (!is_dir($file_dir)) {
            mkdir($file_dir);
        }
        /* location file save */
        $file_target = $file_dir . DIRECTORY_SEPARATOR . $nome_file; /* DIRECTORY_SEPARATOR = / or \ */

        if (move_uploaded_file($tmp_file, $file_target)) {
            //  echo "{$file_name} has been uploaded. <br />";
        }
        $this->insUpdateOrdine();
    }

    public function insUpdateOrdine() {
        $addOrdineFiltro['id_master'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);

        $addOrdinestato['colore_ordine'] = MySQL::SQLValue('primary', MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $addOrdinestato, $addOrdineFiltro)) {
            echo $this->db->Kill();
        }

        $this->messaggio();
    }

    // cancellazione dell'ordine caricato
    public function cancellazioneOrdine() {
        $delOrdineFiltro['id'] = MySQL::SQLValue($_POST['cancellaOrdine'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.attivita_4', $delOrdineFiltro)) {
            echo $this->db->Kill();
        }
        $this->messaggio();
    }

    #aggiornamento attività, accettaziome dell'offerta

    public function insAttivita($id_attivita, $accettazione, $motivazione, $note, $n_offertas) {
        $insAtts['idMaster'] = MySQL::SQLValue($id_attivita, MySQL::SQLVALUE_TEXT);
        $insAtts['accettazione'] = MySQL::SQLValue($accettazione, MySQL::SQLVALUE_TEXT);
        $insAtts['motivazione'] = MySQL::SQLValue($motivazione, MySQL::SQLVALUE_TEXT);

        $insAtts['note'] = MySQL::SQLValue($note, MySQL::SQLVALUE_TEXT);

        if ($this->db->Query("SELECT * FROM {$this->tabella}.attivita_3  WHERE id_attivita=$id_attivita"))
            ;

        if ($this->db->RowCount() > 0) {

            $insAttsF['id_attivita'] = MySQL::SQLValue($id_attivita, MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.attivita_3', $insAtts, $insAttsF))
                echo $this->db->Kill();
        } else {

            if (!$this->db->InsertRow($this->tabella . '.attivita_3', $insAtts))
                echo $this->db->Kill();
        }
        $this->aggttiv($id_attivita, $accettazione);
        $this->idMaster = $id_attivita;
        $this->n_offerta = $n_offertas;
    }

    public function aggttiv($id_attivita, $accettazione) {

        switch ($accettazione) {
            case "Si":
                $ac = 'primary';
                $acs = 'Accettata';
                break;
            case 'No':
                $ac = 'danger';
                $acs = 'Rifiutata';
                break;
            default :
                $ac = 'warning';
                $acs = 'Accettata Con Riserva';
        }
        $insCol['colore_esito'] = MySQL::SQLValue($ac, MySQL::SQLVALUE_TEXT);
        $insCol['stato'] = MySQL::SQLValue($acs, MySQL::SQLVALUE_TEXT);
        $insColF['id_master'] = MySQL::SQLValue($id_attivita, MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $insCol, $insColF))
            echo $this->db->Kill();
        $this->idMaster = $id_attivita;
        $this->n_offerta = $n_offertas;
    }

    public function addNotifiche() {
        $addNot['idOfferte'] = MySQL::SQLValue($_POST['statoSt'], MySQL::SQLVALUE_TEXT);
        $addNot['idFornitore'] = MySQL::SQLValue($_POST['aggiungi'], MySQL::SQLVALUE_TEXT);
        $addNot['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        if (!$this->db->InsertRow($this->tabella . '.notifiche_personale', $addNot))
            echo $this->db->Kill();
    }

    public function delNotifiche() {
        $delNot['idAzIn'] = MySQL::SQLValue($_POST['cancellaAzi'], MySQL::SQLVALUE_TEXT);

        if (!$this->db->DeleteRows($this->tabella . '.notifiche_personale', $delNot))
            echo $this->db->Kill();
    }

    public function analisiDocumentale() {
        $analisi['disponibile'] = MySQL::SQLValue($_POST['disponibile'], MySQL::SQLVALUE_TEXT);
        $analisi['completa'] = MySQL::SQLValue($_POST['completa'], MySQL::SQLVALUE_TEXT);
        $analisi['chiara'] = MySQL::SQLValue($_POST['chiara'], MySQL::SQLVALUE_TEXT);
        $analisi['note'] = MySQL::SQLValue($_POST['note'], MySQL::SQLVALUE_TEXT);
        $analisi['azioni'] = MySQL::SQLValue($_POST['azioni'], MySQL::SQLVALUE_TEXT);
        $analisi['firma'] = MySQL::SQLValue($_SESSION['cognome'], MySQL::SQLVALUE_TEXT);
        $analisi['n_offerta'] = MySQL::SQLValue($_POST['ordine'], MySQL::SQLVALUE_TEXT);
        $analisi['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);

        if (empty($_POST['idAnalisi'])) {
            if (!$this->db->InsertRow($this->tabella . '.analisi_documentaria', $analisi)) {
                echo $this->db->Kill();
            }
        } else {
            $analisiF['idAnalisi'] = MySQL::SQLValue($_POST['idAnalisi'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.analisi_documentaria', $analisi, $analisiF)) {
                echo $this->db->Kill();
            }
        }
        $this->messaggioBello($prova = true, $pagina = 'gestione-primoRiesame.php', $_POST['ordine'], $_POST['id_masterDocumentale'], "form1");
    }

    public function messaggioBello($prova, $pagina, $ordine, $idMasterDocumentale, $formId, $currentTabId = null) {
        // ... il tuo codice PHP ...
        $updateSuccess = $prova; // o false a seconda del risultato
        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include la libreria
        if ($updateSuccess) {
            echo "<script>
Swal.fire({
    title: 'Successo!',
    text: 'Dati aggiornati con successo.',
    icon: 'success',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.value) {
        // Crea un form temporaneo per inviare i dati via POST
        var form = $('<form id=\"" . $formId . "\" action=\"" . $pagina . "\" method=\"post\">' +
            '<input type=\"hidden\" name=\"ordine\" value=\"" . $ordine . "\">' +
            '<input type=\"hidden\" name=\"id_masterDocumentale\" value=\"" . $idMasterDocumentale . "\">' +
                '<input type=\"hidden\" name=\"current_tab_id\" value=\"" . $currentTabId . "\">' +
            '</form>');
        
        // Aggiungi il form al body e invialo
        $('body').append(form);
        form.submit();
    }
});
</script>";
        }
    }

# gestione risorse 

    public function aggRisorse() {
        $assRisorse['idAmministratore'] = MySQL::SQLValue($_POST['idAmministratore'], MySQL::SQLVALUE_TEXT);
        $assRisorse['visionato'] = MySQL::SQLValue('No', MySQL::SQLVALUE_TEXT);
        $assRisorse['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $assRisorse['idMaster'] = MySQL::SQLValue($_POST['id_master'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.assegnazioneRisorse', $assRisorse)) {
            echo $this->db->Kill();
        }
    }

    public function delAssRisor() {
        $delRisorse['idAss'] = MySQL::SQLValue($_POST['deleteRisorse'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.assegnazioneRisorse', $delRisorse)) {
            echo $this->db->Kill();
        }
    }

    public function assVissRisorsePdf() {

        if ($this->db->Query("SELECT * FROM {$this->tabella}.assegnazioneRisorse  WHERE idMaster='{$_POST['id_master']}' and idAmministratore={$_SESSION['idAmministratore']} "))
            ;
        $vis = $this->db->Row();

        $this->assVissRisor($vis->idAss);
    }

    public function assVissRisor($idAss = null) {
        if (!empty($idAss)) {
            $updRisorse['idAss'] = MySQL::SQLValue($idAss, MySQL::SQLVALUE_TEXT);
        } else {
            $updRisorse['idAss'] = MySQL::SQLValue($_POST['visualizzato'], MySQL::SQLVALUE_TEXT);
        }

        $FupdRisorse['visionato'] = MySQL::SQLValue("Si", MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.assegnazioneRisorse', $FupdRisorse, $updRisorse)) {
            echo $this->db->Kill();
        }
    }

    #gestione template

    public function crea() {

        $creaTemplate['tipologia'] = MySQL::SQLValue('Offerta', MySQL::SQLVALUE_TEXT);
        $creaTemplate['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $creaTemplate['titolo'] = MySQL::SQLValue($_POST['titolo'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->InsertRow($this->tabella . '.template', $creaTemplate)) {
            echo $this->db->Kill();
        }
        $this->selezioneTeml();
    }

    public function selezioneTeml() {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.template  WHERE titolo='{$_POST['titolo']}'"))
            ;
        $template = $this->db->Row();
        $this->insertTemple($template->idTemplate);
    }

    public function insertTemple($idTemplate) {
        if (!empty($_POST['campo']) && !empty($_POST['valore'])) {
            // Assumendo che 'campo' e 'valore' abbiano lo stesso numero di elementi
            foreach ($_POST['campo'] as $index => $campo) {
                $valore = $_POST['valore'][$index]; // Ottieni il 'valore' corrispondente

                $insTemplate['idTemplate'] = MySQL::SQLValue($idTemplate, MySQL::SQLVALUE_TEXT);
                $insTemplate['campo'] = MySQL::SQLValue($campo, MySQL::SQLVALUE_TEXT);
                $insTemplate['valore'] = MySQL::SQLValue($valore, MySQL::SQLVALUE_TEXT); // Usa il 'valore' corrispondente

                if (!$this->db->InsertRow($this->tabella . '.templateDettaglio', $insTemplate)) {
                    echo $this->db->Kill();
                }
            }
        }
        $this->messaggio();
    }

    public function delTemplate() {
        $delTemplate['idTemplate'] = MySQL::SQLValue($_POST['idTemplate'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.template', $delTemplate)) {
            echo $this->db->Kill();
        }
        if (!$this->db->DeleteRows($this->tabella . '.templateDettaglio', $delTemplate)) {
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

    # risorse per il rieame

    public function assegnRisorseOfferta() {

        $creaTemplate['idAmministratore'] = MySQL::SQLValue($_POST['aggiungiRisorseOfferte'], MySQL::SQLVALUE_TEXT);
        $creaTemplate['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);
        $creaTemplate['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);

        if (!$this->db->InsertRow($this->tabella . '.RiesameRisorseOfferta', $creaTemplate)) {
            echo $this->db->Kill();
        }
    }

    public function eliminaRisorsa() {
        $elinameRisorse['idRiRi'] = MySQL::SQLValue($_POST['eliminaRisorse'], MySQL::SQLVALUE_TEXT);
        if (!$this->db->DeleteRows($this->tabella . '.RiesameRisorseOfferta', $elinameRisorse)) {
            echo $this->db->Kill();
        }
        $this->messaggio();
    }

// aggiorno risorsa  per calcolare il costo orario

    public function updatecostoOrario() {
        $ore = $_POST['ore'];

        foreach ($ore as $index => $ora) {
            $aggRie = ['ore' => MySQL::SQLValue($_POST['ore'][$index], MySQL::SQLVALUE_TEXT)
            ];
            $aggRieF = [
                'idAmministratore' => MySQL::SQLValue($_POST['idAmministratore'][$index], MySQL::SQLVALUE_TEXT),
                'idMaster' => MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT)
            ];
            if (!$this->db->UpdateRows($this->tabella . '.RiesameRisorseOfferta', $aggRie, $aggRieF)) {
                echo $this->db->Kill();
            }
        }
        echo "<pre>";
        print_r($aggRieF);
        echo "</pre>";
    }

    public function addAnalisiFattibilita() {
        $addFatt['id_Master'] = MySQL::SQLValue($_POST['id_masterFatt'], MySQL::SQLVALUE_TEXT);
        $addFatt['processi'] = MySQL::SQLValue($_POST['processi'], MySQL::SQLVALUE_TEXT);
        $addFatt['processi'] = MySQL::SQLValue($_POST['processi'], MySQL::SQLVALUE_TEXT);
        $addFatt['requisiti'] = MySQL::SQLValue($_POST['requisiti'], MySQL::SQLVALUE_TEXT);
        $addFatt['infastrutture'] = MySQL::SQLValue($_POST['infastrutture'], MySQL::SQLVALUE_TEXT);
        $addFatt['requisitiCongenti'] = MySQL::SQLValue($_POST['requisitiCongenti'], MySQL::SQLVALUE_TEXT);
        $addFatt['note'] = MySQL::SQLValue($_POST['note'], MySQL::SQLVALUE_TEXT);
        $addFatt['aliquotaGestione'] = MySQL::SQLValue($_POST['aliquotaGestione'], MySQL::SQLVALUE_TEXT);
        $addFatt['aliquotaMacchina'] = MySQL::SQLValue($_POST['aliquotaMacchina'], MySQL::SQLVALUE_TEXT);
        $addFatt['costoMateriale'] = MySQL::SQLValue($_POST['costoMateriale'], MySQL::SQLVALUE_TEXT);
        $addFatt['altro'] = MySQL::SQLValue($_POST['altro'], MySQL::SQLVALUE_TEXT);
        $addFatt['consegna'] = MySQL::SQLValue($_POST['giorni'], MySQL::SQLVALUE_TEXT);
        $addFatt['costoParziale'] = MySQL::SQLValue($_POST['costoParziale'], MySQL::SQLVALUE_TEXT);
        $addFatt['costoRisorse'] = MySQL::SQLValue($_POST['costoRisorsa'], MySQL::SQLVALUE_TEXT);
        $addFatt['costoTotale'] = MySQL::SQLValue($_POST['costoTotale'], MySQL::SQLVALUE_TEXT);
        $addFatt['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

        if (!empty($_POST['idFatt'])) {
            $addFattFi['idFatt'] = MySQL::SQLValue($_POST['idFatt'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.analisi_fattibilita', $addFatt, $addFattFi)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.analisi_fattibilita', $addFatt)) {
                echo $this->db->Kill();
            }
        }
        $this->messaggioBello($prova = true, $pagina = 'gestione-analisiFattibilita.php', $_POST['ordine'], $_POST['id_masterDocumentale'], "form2");
    }

    public function addRischio() {
        $numRischi = isset($_POST['numRischi']) ? intval($_POST['numRischi']) : 0;

        for ($i = 1; $i <= $numRischi; $i++) {
            $addRischio['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
            $addRischio['livelloRischio'] = MySQL::SQLValue($_POST["rischio$i"], MySQL::SQLVALUE_TEXT);
            $addRischio['Peso'] = MySQL::SQLValue($_POST["livello$i"], MySQL::SQLVALUE_TEXT);
            $addRischio['risultato'] = MySQL::SQLValue($_POST["risultato$i"], MySQL::SQLVALUE_TEXT);
            $addRischio['idRischio'] = MySQL::SQLValue($_POST["idRischio$i"], MySQL::SQLVALUE_TEXT);
            if (!empty($_POST["idOffRischi$i"])) {
                $addFattFi['idOffRischi'] = MySQL::SQLValue($_POST["idOffRischi$i"], MySQL::SQLVALUE_TEXT);
                if (!$this->db->UpdateRows($this->tabella . '.OffertaRischio', $addRischio, $addFattFi)) {
                    echo $this->db->Kill();
                }
            } else {
                if (!$this->db->InsertRow($this->tabella . '.OffertaRischio', $addRischio)) {
                    echo $this->db->Kill();
                }
            }
        }
        $this->RisuRischio();
    }

    public function RisuRischio() {
        $addRischioEsito['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['sommaTotale'] = MySQL::SQLValue($_POST['sommaTotale'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['grado'] = MySQL::SQLValue($_POST['calcoloMatematico'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['rischio'] = MySQL::SQLValue($_POST['valutazioneRischio'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['correzione'] = MySQL::SQLValue($_POST['correzione'], MySQL::SQLVALUE_TEXT);

        if (!empty($_POST['idER'])) {
            $addRiscFi['idER'] = MySQL::SQLValue($_POST['idER'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.esitoRiscio', $addRischioEsito, $addRiscFi)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.esitoRiscio', $addRischioEsito)) {
                echo $this->db->Kill();
            }
        }
        //
        $this->messaggioBello($prova = true, $pagina = 'gestione-analisiRischi.php', $_POST['ordine'], $_POST['id_masterDocumentale'], "form3", "profile-1");
    }

    
    // rischio del resame, seconda parte addRischioResame
    
        public function addRischioResame() {
        $numRischi = isset($_POST['numRischi']) ? intval($_POST['numRischi']) : 0;

        for ($i = 1; $i <= $numRischi; $i++) {
            $addRischio['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
            $addRischio['livelloRischio'] = MySQL::SQLValue($_POST["rischio$i"], MySQL::SQLVALUE_TEXT);
            $addRischio['Peso'] = MySQL::SQLValue($_POST["livello$i"], MySQL::SQLVALUE_TEXT);
            $addRischio['risultato'] = MySQL::SQLValue($_POST["risultato$i"], MySQL::SQLVALUE_TEXT);
            $addRischio['idRischio'] = MySQL::SQLValue($_POST["idRischio$i"], MySQL::SQLVALUE_TEXT);
            
            
            if (!empty($_POST["idOffRischi$i"])) {
                $addFattFi['idOffRischi'] = MySQL::SQLValue($_POST["idOffRischi$i"], MySQL::SQLVALUE_TEXT);
                if (!$this->db->UpdateRows($this->tabella . '.OffertaRischioResame', $addRischio, $addFattFi)) {
                    echo $this->db->Kill();
                }
            } else {
                if (!$this->db->InsertRow($this->tabella . '.OffertaRischioResame', $addRischio)) {
                    echo $this->db->Kill();
                }
            }
        }
        $this->RisuRischioResame();
    }
    
     public function RisuRischioResame() {
        $addRischioEsito['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['sommaTotale'] = MySQL::SQLValue($_POST['sommaTotale2'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['grado'] = MySQL::SQLValue($_POST['calcoloMatematico'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['rischio'] = MySQL::SQLValue($_POST['valutazioneRischio'], MySQL::SQLVALUE_TEXT);
        $addRischioEsito['correzione'] = MySQL::SQLValue($_POST['correzione'], MySQL::SQLVALUE_TEXT);
     
        if (!empty($_POST['idER'])) {
            $addRiscFi['idER'] = MySQL::SQLValue($_POST['idER'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.esitoRiscioResame', $addRischioEsito, $addRiscFi)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.esitoRiscioResame', $addRischioEsito)) {
                echo $this->db->Kill();
            }
        }
        //
       // $this->messaggioBello($prova = true, $pagina = 'gestione-analisiRiesameRischio.php', $_POST['ordine'], $_POST['id_masterDocumentale'], "form3", "profile-1");
    }
    
    
    # prescrizione dell'offerta

    public function addPrescrizione() {
        $numPrescrizione = isset($_POST['numPrescrizione']) ? intval($_POST['numPrescrizione']) : 0;

        for ($i = 1; $i <= $numPrescrizione; $i++) {
            $addPrescrizione = [
                'idMaster' => MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT),
                'idPrescrizione' => MySQL::SQLValue($_POST["idPrescrizione$i"], MySQL::SQLVALUE_TEXT),
                'valore' => MySQL::SQLValue($_POST["presc1$i"], MySQL::SQLVALUE_TEXT)
            ];

            // Qui controlliamo specificamente per ogni iterazione se idOffPre è impostato
            if (!empty($_POST["idOffPre$i"])) {
                $addPrescFi = ['idOffPre' => MySQL::SQLValue($_POST["idOffPre$i"], MySQL::SQLVALUE_TEXT)];
                if (!$this->db->UpdateRows($this->tabella . '.offertaPrescrizione', $addPrescrizione, $addPrescFi)) {
                    echo $this->db->Kill();
                }
            } else {
                if (!$this->db->InsertRow($this->tabella . '.offertaPrescrizione', $addPrescrizione)) {
                    echo $this->db->Kill();
                }
            }
        }

        $this->insUpdateColoreRiesame();
    }

    public function insUpdateColoreRiesame() {
        $addDDTFiltro['id_master'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);

        $addDDTstato['colore_riesame_offerta'] = MySQL::SQLValue('primary', MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $addDDTstato, $addDDTFiltro)) {
            echo $this->db->Kill();
        }

        $this->messaggioBello($prova = true, $pagina = 'gestione-analisiPrescrizione.php', $_POST['ordine'], $_POST['id_masterDocumentale'], "form4");
    }

    
    
    // inserimento prescrizione resame
       public function addPrescrizioneResame() {
        $numPrescrizione = isset($_POST['numPrescrizione']) ? intval($_POST['numPrescrizione']) : 0;

        for ($i = 1; $i <= $numPrescrizione; $i++) {
            $addPrescrizione = [
                'idMaster' => MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT),
                'idPrescrizione' => MySQL::SQLValue($_POST["idPrescrizione$i"], MySQL::SQLVALUE_TEXT),
                'valore' => MySQL::SQLValue($_POST["presc1$i"], MySQL::SQLVALUE_TEXT)
            ];

            // Qui controlliamo specificamente per ogni iterazione se idOffPre è impostato
            if (!empty($_POST["idOffPre$i"])) {
                $addPrescFi = ['idOffPre' => MySQL::SQLValue($_POST["idOffPre$i"], MySQL::SQLVALUE_TEXT)];
                if (!$this->db->UpdateRows($this->tabella . '.offertaPrescrizioneResame', $addPrescrizione, $addPrescFi)) {
                    echo $this->db->Kill();
                }
            } else {
                if (!$this->db->InsertRow($this->tabella . '.offertaPrescrizioneResame', $addPrescrizione)) {
                    echo $this->db->Kill();
                }
            }
        }

        $this->insUpdateColoreRiesameDue();
    }
    
     public function insUpdateColoreRiesameDue() {
        $addDDTFiltro['id_master'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);

        $addDDTstato['colore_riesame_ordine'] = MySQL::SQLValue('primary', MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $addDDTstato, $addDDTFiltro)) {
            echo $this->db->Kill();
        }

        $this->messaggioBello($prova = true, $pagina = 'gestione-prescrizioneRiesame.php', $_POST['ordine'], $_POST['id_masterDocumentale'], "form4");
    }
    
    #inserimeto della comessa

    public function aggCommssaOfferta() {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.attivita where year(data_inserimento)=year(now()) order by id desc limit 1"))
            ;
        $commessa = $this->db->Row();

        $this->insCommessaOfferta($commessa->id_composto);
    }

    public function insCommessaOfferta($id_composto) {
        $addCommessaFiltro['id_master'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
        $addCommessa['id_commessa'] = MySQL::SQLValue($id_composto, MySQL::SQLVALUE_TEXT);
        $addCommessa['colore_commessa'] = MySQL::SQLValue('primary', MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $addCommessa, $addCommessaFiltro)) {
            echo $this->db->Kill();
        }

        $this->messaggio();
    }

    public function modBottoneImporto() {
        $addBottoneFiltro['id_master'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
        $addBottone['importo_ordini'] = MySQL::SQLValue($_POST['importoNetto'], MySQL::SQLVALUE_TEXT);

        if (!$this->db->UpdateRows($this->tabella . '.offerta', $addBottone, $addBottoneFiltro)) {
            echo $this->db->Kill();
        }


        $this->messaggio();
    }

    public function dettaglioCommessa() {
        if ($this->db->Query("SELECT * FROM {$this->tabella}.attivita where year(data_inserimento)=year(now()) order by id desc limit 1"))
            ;
        $idcommessa = $this->db->Row();
        $this->creaCommessaDettaglio($idcommessa->id);
    }

    public function creaCommessaDettaglio($id) {

        foreach ($_POST['articolo'] as $articoloId) {
            $addCommessaArticoli['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
            $addCommessaArticoli['idArticoli'] = MySQL::SQLValue($articoloId, MySQL::SQLVALUE_TEXT);
            $addCommessaArticoli['idCommessa'] = MySQL::SQLValue($id, MySQL::SQLVALUE_TEXT);
            if (!$this->db->InsertRow($this->tabella . '.commessa_articoli', $addCommessaArticoli)) {
                echo $this->db->Kill();
            }
        }
        header('location:gestione-elencoOfferte.php');
    }

    // CREAZIONE DDT  IN OFFERTA


    public function conteggio($destinatario, $ragioneSociale) {


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
        $this->nCommessa($destinatario, $ragioneSociale);
    }

    // prendo il  ciente  
    public function nCommessa($destinatario, $ragioneSociale) {

        if ($destinatario == 'fornitore') {

            $this->db->Query("select * from {$this->tabella}.fornitori where ragioneSociale='$ragioneSociale'");
            $prova = $this->db->Row();
            $forn = $prova->cod_fornitore;
        } else {
            $this->db->Query("select * from {$this->tabella}.anagrafica where ragioneSociale='$ragioneSociale'");
            $prova = $this->db->Row();
            $forn = $prova->cod_cliente;
        }

        $this->creaDDT($destinatario, $_POST['id_commessa'], $ragioneSociale, $prova->cod_cliente);
    }

    // inserimento cddt

    public function creaDDT($destinatario, $idc_attivita, $ragioneSociale, $cod_cliente) {


        $insDDT['n_ddt'] = MySQL::SQLValue($this->risultato, MySQL::SQLVALUE_TEXT);
        $insDDT['data_emissione'] = MySQL::SQLValue($_POST['data_emissione'], MySQL::SQLVALUE_TEXT);
        if (!empty($destinatario)) {
            $insDDT['destinatario'] = MySQL::SQLValue($destinatario, MySQL::SQLVALUE_TEXT);
            $insDDT['cod_destinatario'] = MySQL::SQLValue($cod_cliente, MySQL::SQLVALUE_TEXT);
        }
        $insDDT['ragione_sociale'] = MySQL::SQLValue($ragioneSociale, MySQL::SQLVALUE_TEXT);
        $insDDT['flag_dest'] = MySQL::SQLValue($_POST['flag_dest'], MySQL::SQLVALUE_TEXT);
        $insDDT['sede_op_custom'] = MySQL::SQLValue($_POST['sede_op_custom'], MySQL::SQLVALUE_TEXT);
        $insDDT['riferimento'] = MySQL::SQLValue($_POST['riferimento'], MySQL::SQLVALUE_TEXT);
        if (!empty($idc_attivita)) {
            $insDDT['idc_attivita'] = MySQL::SQLValue($idc_attivita, MySQL::SQLVALUE_TEXT);
        }
        $insDDT['annotazioni'] = MySQL::SQLValue($_POST['annotazioni'], MySQL::SQLVALUE_TEXT);
        $insDDT['vettore'] = MySQL::SQLValue($_POST['vettore'], MySQL::SQLVALUE_TEXT);
        $insDDT['asp_esteriore'] = MySQL::SQLValue($_POST['asp_esteriore'], MySQL::SQLVALUE_TEXT);
        $insDDT['n_colli'] = MySQL::SQLValue($_POST['n_colli'], MySQL::SQLVALUE_TEXT);
        $insDDT['nome_azienda_app'] = MySQL::SQLValue('MES', MySQL::SQLVALUE_TEXT);
        $insDDT['causale'] = MySQL::SQLValue($_POST['causale'], MySQL::SQLVALUE_TEXT);
        $insDDT['firma'] = MySQL::SQLValue($_SESSION['mails'], MySQL::SQLVALUE_TEXT);
        $insDDT['created_at'] = MySQL::SQLValue(date('Y-m-d H:i:s'), MySQL::SQLVALUE_DATETIME);
        $insDDT['updated_at'] = MySQL::SQLValue(date('Y-m-d H:i:s'), MySQL::SQLVALUE_DATETIME);

        if (!$this->db->InsertRow($this->tabella . '.ddt', $insDDT)) {
            echo $this->db->Kill();
        }

        $this->aggArticoli($this->risultato);
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
        $this->aggArticoliOfferta($n_ddt);
        //  header('location:gestione-ddt.php');
    }

    public function aggArticoliOfferta($n_ddt) {
        // Assicurati che posizione, descrizione e quantita siano array e abbiano la stessa lunghezza
        if (is_array($_POST['codice_articolo']) && is_array($_POST['oggetto']) && is_array($_POST['qnt']) &&
                count($_POST['codice_articolo']) == count($_POST['oggetto']) && count($_POST['codice_articolo']) == count($_POST['qnt'])) {

            for ($i = 0; $i < count($_POST['codice_articolo']); $i++) {
                // Salta l'inserimento se uno dei campi è vuoto
                if (empty($_POST['codice_articolo'][$i]) || empty($_POST['oggetto'][$i]) || empty($_POST['qnt'][$i])) {
                    continue;
                }

                $insDDTA = array();
                $insDDTA['n_ddt'] = MySQL::SQLValue($n_ddt, MySQL::SQLVALUE_TEXT);
                $insDDTA['posizione'] = MySQL::SQLValue($_POST['codice_articolo'][$i], MySQL::SQLVALUE_TEXT);
                $insDDTA['descrizione'] = MySQL::SQLValue($_POST['oggetto'][$i], MySQL::SQLVALUE_TEXT);
                $insDDTA['qnt'] = MySQL::SQLValue($_POST['qnt'][$i], MySQL::SQLVALUE_TEXT);
                $insDDTA['dataCreazione'] = MySQL::SQLValue(date('Y-m-d'), MySQL::SQLVALUE_DATE);

                if (!$this->db->InsertRow($this->tabella . '.ddt_articoli', $insDDTA)) {
                    echo $this->db->Kill();
                    return; // Interrompi l'esecuzione in caso di errore
                }
            }
        } else {
            echo "Errore: I parametri forniti non sono array validi o non corrispondono.";
        }
        //  header('location:gestione-ddt.php');
        $this->insUpdateOffertaDDT();
    }

    // aggiornamneto  offerta

    public function insUpdateOffertaDDT() {
        $addDDTFiltro['id_master'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);

        $addDDTstato['colore_ddt'] = MySQL::SQLValue('primary', MySQL::SQLVALUE_TEXT);
        if (!$this->db->UpdateRows($this->tabella . '.offerta', $addDDTstato, $addDDTFiltro)) {
            echo $this->db->Kill();
        }

        $this->messaggio();
        header('location:gestione-ddt.php');
    }

    // riesame inserime attivita 6

    public function addAttivitaSei() {
       
        $addAttivitaSei['OrdineLavoroInterno'] = MySQL::SQLValue($_POST['OrdineLavoroInterno'], MySQL::SQLVALUE_TEXT);
        $addAttivitaSei['significativi'] = MySQL::SQLValue($_POST['significativi'], MySQL::SQLVALUE_TEXT);
        $addAttivitaSei['risolti'] = MySQL::SQLValue($_POST['risolti'], MySQL::SQLVALUE_TEXT);
        $addAttivitaSei['statoOrdine'] = MySQL::SQLValue($_POST['statoOrdine'], MySQL::SQLVALUE_TEXT);
        $addAttivitaSei['note'] = MySQL::SQLValue($_POST['note'], MySQL::SQLVALUE_TEXT);
        $addAttivitaSei['idMaster'] = MySQL::SQLValue($_POST['id_masterDocumentale'], MySQL::SQLVALUE_TEXT);
      
        if (!empty($_POST['idAttivita_5'])) {
            $addAttivitaSeiFiltro['idAttivita'] = MySQL::SQLValue($_POST['idAttivita_5'], MySQL::SQLVALUE_TEXT);
            if (!$this->db->UpdateRows($this->tabella . '.attivita_5', $addAttivitaSei, $addAttivitaSeiFiltro)) {
                echo $this->db->Kill();
            }
        } else {
            if (!$this->db->InsertRow($this->tabella . '.attivita_5', $addAttivitaSei)) {
                echo $this->db->Kill();
            }
            
        }
         // $this->messaggioBello($prova = true, $pagina = 'gestione-riesameOrdine.php', $_POST['ordine'], $_POST['id_masterDocumentale'],'ciap');
        $this->messaggio();
    }
}

?>