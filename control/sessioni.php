<?php
#gestione della tabelle per le sessioni
$tabella = 'admin_' . $_SESSION['username'];
define('NOMETABELLA', $tabella);
define('IDAZIENDA', $_SESSION['idAzienda']);

?>