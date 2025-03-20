

<?php

#collogamento classe select dinamiche
$select_dinamiche = new class_select();

$gestoperatore = new class_operatori($_SESSION['tabella']);

#colleghiamo i ruoli
$gestruolo=new class_ruoli($_SESSION['tabella']);

#gestione permessi
$gestPermessi=new class_permessi($_SESSION['tabella']);


#gestione moduli
$mod=new class_moduli($_SESSION['tabella']);

#gestione ruolo
if (isset($_POST['ruolo']) || isset($_POST['idRuolo'])) {
    $gestruolo->GestioneRuoli($_POST['idRuolo'], $_POST['ruolo'], $_POST['cancella']);
}


if (isset($_POST['nome']) || isset($_POST['idAmministratore'])) {


    $gestoperatore->GestioneOperatore($_POST['idAmministratore'], $_POST['nome'], $_POST['cognome'], $_POST['indirizzo'], $_POST['cap'], $_POST['idProvincia'], $_POST['idComune'], $_POST['tel'], $_POST['mobile'], $_POST['idRuolo2'], $_POST['email'], $_POST['codiceFiscale'], $_POST['pws'], $_POST['matricola'],$_POST['mansione'], $_POST['nascita'],$_POST['luogoNascita'],$_POST['cancella']);
    
}


if (isset($_POST['modulo']) || $_POST['cancella_permessi']) {
    $gestPermessi->GestionePermessi($_POST['idRuolo'], $_POST['modulo'], $_POST['idPermesso']);
}


#per la variabile fissa
if (isset($_POST['certificazioni'])) {
$gestoperatore->certificazioneFissa($_POST['certificazioni']);
}


#inserimento certificazione
if(isset($_POST['certificazione'])){
    $gestoperatore->insCertificazioni($_POST['certificazioni'], $_POST['qualifica'], $_POST['titolo_studio'], $_POST['titoli_spec'], $_POST['esperienze'], $_POST['formazione']);
}

#cancellazione certificazione
if(isset($_POST['idCertificazioni'])){
    $gestoperatore->delCertificazione($_POST['idCertificazioni']);
}

#inserimento dettaglo di lavoro
if(isset($_POST['sede_lavoro'])){
    
  $gestoperatore->insDettLavoro($_POST['certificazioni'], $_POST['sede_lavoro'], $_POST['resp_reparto'], $_POST['mansione'], $_POST['spp'], $_POST['cv'], $_POST['cva'], $_POST['costo_orario']); 
}

#del lavoro
if(isset($_POST['idLavoro'])){
    $gestoperatore->delDettLavoro($_POST['idLavoro']);
}

#inserimento dattaglio lavoro
if(isset($_POST['ass_inizio'])){
  $gestoperatore->insMansione($_POST['certificazioni'], $_POST['ass_inizio'], $_POST['ass_fine'], $_POST['ass_tempo'], $_POST['ass_contratto'], $_POST['ass_avvisi'], $_POST['ass_durata']);  
}

#del mansione
if(isset($_POST['idAssunzione'])){
    $gestoperatore->delMans($_POST['idAssunzione']);
}

#inserimento analisi documentaria
if(!empty($_POST['disponibile'])){
    $gestoperatore->analisiDocumentale();
}
?>