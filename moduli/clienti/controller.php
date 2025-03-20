<?php

$objlienti = new class_cliente($_SESSION['tabella']);
#collogamento classe select dinamiche
$select_dinamiche = new class_select();

#geestione anagrafica
$cliente = new class_anagrafica(NOMETABELLA);

#gestione calendario
$calendario = new class_calendario($_SESSION['tabella']);

#gestione operatore
$operatore = new class_operatori($_SESSION['tabella']);


#inserisco nel metodo
if (isset($_POST['nome']) || isset($_POST['idAnagrafica'])) {
    $objlienti->GestioneClienti($_POST['idAnagrafica'], $_POST['nome'], $_POST['cognome'], $_POST['indirizzo'], $_POST['cap'],$_POST['PosizioneRicoperta'],  $_POST['province'], $_POST['comuni'], $_POST['regioni'], $_POST['fisso'], $_POST['mobile'], $_POST['ragioneSociale'], $_POST['email'], $_POST['codiceFiscale'], $_POST['iva'], $_POST['pws'], $_POST['sesso'], $_POST['cancella']);
}


#gestione del calendario inserimento
if (!empty($_POST['str_data'])) {

    $calendario->gestioneCalendario($_POST['idAna'], $_POST['testo'], $_POST['str_data'], $_POST['idPostazione'], $_POST['orario'], $_POST['idAppuntamenti'], $_POST['cancella'], $_SESSION['idAmministratore'], $_POST['obiettivi']);
}

#gestioni referenti clienti
if (!empty($_POST['nomeReferente'])) {

    $objlienti->GestioneReferenti( $_POST['nomeReferente'], $_POST['cognome'],$_POST['idAna'], $_POST['telefono'], $_POST['email'], $_POST['tipo'], $_POST['idAmministratore'], $_POST['cancellaCl'], $_POST['idRef']);
}
    #invio email ai referenti
    
 if(!empty($_POST['nomeInvio'])){
     
   $objlienti->invioReferente($_POST['nomeInvio'], $_POST['cognome'], $_POST['email'], $_POST['messaggio'], $_POST['oggetto'], $_SESSION['mails']);
 }
     
    #AGG INTERAZIONE
    
 if(!empty($_POST['idClienteRefere'])){
     $objlienti->aggInterazione($_POST['idClienteRefere'], $_POST['dataInterazione'], $_POST['OraInterazione'], $_POST['contatto'], $_POST['idAmministratore'], $_POST['testo'], $_POST['note'], $_POST['cancellaInt'],$_POST['idInt']);
 }
?>


