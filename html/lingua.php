<?php
// Verifica se il form è stato inviato e imposta la lingua sulla base della selezione dell'utente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idLingue'])) {
    $_SESSION['selectedLanguage'] = $_POST['idLingue'];
}
// Altrimenti, se non esiste già una selezione della lingua nella sessione, imposta il default a italiano
elseif (!isset($_SESSION['selectedLanguage'])) {
    $_SESSION['selectedLanguage'] = 'it';
}
// Costruisce il percorso completo al file di traduzione
$translationsPath = $_SERVER["DOCUMENT_ROOT"] . '/languages/' . $_SESSION['selectedLanguage'] . '.php';

// Verifica se il file di traduzione esiste
if (file_exists($translationsPath)) {
    // Carica il file di traduzione
    $translations = require $translationsPath;
} else {
    die("Il file di traduzione non esiste: $translationsPath");
}
?>