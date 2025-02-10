<?php

session_start();
ob_start();
include_once 'class_select.php';
$opt = new class_select();


if (isset($_POST['id_reg'])) {
    echo $opt->ShowProvince();
    die;
}

if (isset($_POST['id_pro'])) {
    echo $opt->ShowComuni();
    die;
}
if (isset($_POST['idAnagrafica'])) {
    echo $opt->ShowPreventivo();
    die;
}
if (isset($_POST['idCategoria'])) {
    echo $opt->ShowSubCategoriaAbbigliamento();
    die;
}
if (isset($_POST['idRuolo'])) {
    echo $opt->ShowPermessi($_SESSION['tabella'], $_SESSION['idAzienda']);
    die;
}

if (isset($_POST['cod_cliente'])) {
    $_SESSION['codice'] = $_POST['cod_cliente'];
    echo $opt->ShowAttivitaAnno($_SESSION['tabella']);
    die;
}
if (isset($_POST['anno'])) {
    $_SESSION['annuale'] = $_POST['anno'];
    echo $opt->ShowAttivitaDescrizione($_SESSION['tabella'], $_SESSION['codice'],$_SESSION['annuale']);
    die;
}
if (isset($_POST['descrizione'])) {
    $_SESSION['descrizione'] = $_POST['descrizione'];
    echo $opt->ShowAttivitaCommessa($_SESSION['tabella'], $_SESSION['codice'], $_SESSION['annuale']);
    die;
}
if (isset($_POST['commessa'])) {
    $_SESSION['commessa'] = $_POST['commessa'];
    echo $opt->ShowAttivitaRiferimenti($_SESSION['tabella'], $_SESSION['codice'],$_SESSION['annuale'],$_SESSION['descrizione']);
    die;
}
if (isset($_POST['riferimento'])) {
     $_SESSION['riferimento'] = $_POST['riferimento'];
    echo $opt->ShowAttivitaAnnoOrdine($_SESSION['tabella'], $_SESSION['codice'], $_SESSION['annuale'],$_SESSION['descrizione'], $_SESSION['commessa']);
    die;
}
if (isset($_POST['anno_ordine'])) {
    echo $opt->ShowAttivitaAnnoDescOrdine($_SESSION['tabella'], $_SESSION['codice'], $_SESSION['annuale'],$_SESSION['descrizione'], $_SESSION['commessa'], $_SESSION['riferimento']);
    die;
}
?>