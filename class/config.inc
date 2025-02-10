<?php

spl_autoload_register(function ($nomeClass) {
    require_once $nomeClass . '.php';
});

?>
