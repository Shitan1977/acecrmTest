<?php

$objGuide = new class_guida($_SESSION['tabella']);

#colleghiamo l'oggetto la class moduli
$moduli = new class_moduli($_SESSION['username']);

if (!empty($_POST['tipo'])) {
    $objGuide->inseGuida();
}
$page = $_GET['pag'];
$data = $objGuide->getGuideData($page);
?>