<?php


#gestione delle pagine, menu
$varie = new class_pagine($tabella);

#gestiine dell'assistenza ai clienti
$assistenza=new class_assistenza($tabella);


#gestiine avvisi ai clienti
$avvisi=new class_avvisi($tabella);

#gestione le guide
$guide=new class_guida($tabella);

#gestione clienti
$cliente = new class_cliente($_SESSION['tabella']);

#gestione fornitore
$fornitore = new class_fornitori($_SESSION['tabella']);


#gestione prodotto
$prodotto = new class_prodotti($_SESSION['tabella']);

#gestione lingua
$lingua = new class_lingua($_SESSION['tabella']);


?>
