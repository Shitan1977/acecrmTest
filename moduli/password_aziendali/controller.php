<?php

  
   $objPassword=new class_password($_SESSION['username']);
   $tabellaprov='test_'.$_SESSION['username'];
 if (isset($_POST['user']) || isset($_POST['idPersonale'])) {
    // Recupero i valori in modo controllato
    $user          = $_POST['user'] ?? null;
    $password      = $_POST['password'] ?? null;
    $domandaChiave = $_POST['domandaChiave'] ?? null;
    $tipo          = $_POST['tipo'] ?? null;
    $idPersonale   = $_POST['idPersonale'] ?? null;
    $cancella      = isset($_POST['cancella']); // checkbox o input hidden

    // Passo tutto alla classe come parametri
    $objPassword->AggiornaPassword(
        $user,
        $password,
        $domandaChiave,
        $tipo,
        $idPersonale,
        $cancella
    );
}

?>


