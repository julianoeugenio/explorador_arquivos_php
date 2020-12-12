<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['cod_usuario']) && isset($_SESSION['nome_usuario'])) {

    if (empty($_SESSION['cod_usuario']) || empty($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
} else {
    session_destroy();
    header("Location: index.php");
    exit();
}