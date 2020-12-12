<?php

if (!empty($_POST['arquivos'])) {
    if (!isset($_SESSION)) {
        session_start();
    }

    require('../config.php');

    $arquivos = $_POST['arquivos'];

    $raiz = pasta_raiz;

    for ($i = 0; $i < count($arquivos); $i++) {
        $arquivo = $raiz . '/' . base64_decode($arquivos[$i]);
        if (file_exists($arquivo)) {
            //unlink($arquivo);
            echo $arquivo."<br>";
        }
    }
}