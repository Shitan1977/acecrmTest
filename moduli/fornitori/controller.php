<?php

#collogamento classe select dinamiche
$opt = new class_select();
$objFornitori = new class_fornitori($_SESSION['tabella']);

if (isset($_POST['nominativo']) || isset($_POST['idFornitori'])) {
   
    $objFornitori->GestioneFornitori($_POST['idFornitori'], $_POST['nominativo'], $_POST['cognome'], $_POST['indirizzo'], $_POST['cap'], $_POST['province'], $_POST['comuni'], $_POST['regioni'], $_POST['fisso'], $_POST['mobile'], $_POST['ragioneSociale'], $_POST['email'], $_POST['codiceFiscale'], $_POST['iva'], $_POST['pws'], $_POST['sesso'], $_POST['cancella']);
}

#inserimento cliente
$objclienti = new class_cliente($_SESSION['tabella']);

#inserimento fatture

$objFatture = new class_fatture($_SESSION['tabella']);
#inserisco  le fatture
if (!empty($_POST['fattura'])) {
    $file_name = $_FILES['documento']['name'];
    $file_tmp = $_FILES['documento']['tmp_name'];

    $objFatture->uploadFatture($_POST['progressivo'], $_POST['idAnagrafica'], $_POST['idFornitore'], $_POST['oggetto'], $file_name, $file_tmp, $_POST['tipologia'], $_POST['dataFattura'], $_SESSION['idAzienda']);
}
?>

