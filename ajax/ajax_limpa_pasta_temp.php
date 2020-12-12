<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');

$pasta = "../temp/";

if (is_dir($pasta)) {
    $diretorio = dir($pasta);
    $erro = false;
    while ($arquivo = $diretorio->read()) {
        if (($arquivo != '.') && ($arquivo != '..')) {
            if (!unlink($pasta . $arquivo)) {
                $erro = true;
                break;
            }
        }
    }
    $diretorio->close();

    if ($erro) {
        echo'Erro ao apagar arquivos.';
    } else {
        echo'Pasta limpa.';
    }
} else {
    echo 'A pasta não existe.';
}