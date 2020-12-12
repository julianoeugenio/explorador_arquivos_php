<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');
require('../bd.php');
require('../funcoes.php');

if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['senha'])) {

    $nome = Anti_Injection($_POST['nome']);
    $email = Anti_Injection($_POST['email']);
    $login = Anti_Injection($_POST['login']);
    $senha = Anti_Injection($_POST['senha']);

    $bd = new bd();
    $con = $bd->open();

    $sql = "SELECT cod_usuario FROM usuario WHERE nome_usuario = '" . $login . "'";

    $query = mysqli_query($con, $sql);

    if ($query) {
        $reg = mysqli_fetch_assoc($query);
        if (!empty($reg['cod_usuario'])) {
            echo'erro|Usuário já existe';
        } else {

            $sql_insert = "INSERT INTO usuario (nome, email, nome_usuario,senha) VALUES('" . $nome . "', '" . $email . "', '" . $login . "', '" . $senha . "')";
            $query_insert = mysqli_query($con, $sql_insert);
            if ($query) {
                echo 'ok';
            } else {
                echo 'erro|Erro interno.';
            }
        }
    } else {
        echo 'erro|Erro interno.';
    }

    $bd->close();
} else {
    echo 'erro|preencha todos os campos.';
}

