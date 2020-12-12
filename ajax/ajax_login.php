<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');
require('../bd.php');
require('../funcoes.php');

if (!empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['captcha'])) {

    $captcha = $_POST['captcha'];
    $captcha_session = $_SESSION['captcha'];

    if (strcmp($captcha, $captcha_session) == 0) {

        $login = Anti_Injection($_POST['login']);
        $senha = Anti_Injection($_POST['senha']);

        $bd = new bd();
        $con = $bd->open();

        $sql = "SELECT cod_usuario, nome_usuario FROM usuario WHERE nome_usuario = '" . $login . "' AND senha = '" . $senha . "'";

        $query = mysqli_query($con, $sql);

        if ($query) {
            $reg = mysqli_fetch_assoc($query);
            if (!empty($reg['cod_usuario'])) {
                $_SESSION['cod_usuario'] = $reg['cod_usuario'];
                $_SESSION['nome_usuario'] = $reg['nome_usuario'];
                echo'ok';
            } else {
                echo'erro|Dados incorretos.';
            }
        } else {
            echo 'erro|Erro interno.';
        }

        $bd->close();
    } else {
        echo 'erro|captcha incorreto.';
    }
} else {
    echo 'erro|preencha todos os campos.';
}

