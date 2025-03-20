<?php
#colleghiamo l'oggetto la class aziendqaq
$objazienda = new class_azienda($_SESSION['username']);

#inserisco nel metodo
if(!empty($_POST['ragioneSociale'])){
    $objazienda->creazioneAzienda($_POST['ragioneSociale'], $_POST['tipologia'], $_POST['iva'], $_POST['indirizzo'], $_POST['idProvicia'], $_POST['idComune'], $_POST['nome'], $_POST['cogonome'], $_POST['mobile'], $_POST['email'], $_POST['username'],$_POST['idAzienda']);

}
?>