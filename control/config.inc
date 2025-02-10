<?php

spl_autoload_register(function ($class_name) {
    require $_SERVER["DOCUMENT_ROOT"] . '/class/' . $class_name . '.php';
});

?>
