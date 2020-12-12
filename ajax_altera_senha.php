<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');
require('../bd.php');
require('../funcoes.php');

$cod_usuario = $_SESSION['cod_usuario'];

if (!empty($_POST['senha_atual']) && !empty($_POST['nova_senha'])) {

        $senha_atual = Anti_Injection($_POST['senha_atual']);
        $nova_senha = Anti_Injection($_POST['nova_senha']);

        $bd = new bd();
        $con = $bd->open();

        $sql = "SELECT cod_usuario FROM usuario WHERE cod_usuario = " . $cod_usuario . " AND senha = '" . $senha_atual . "'";

        $query = mysqli_query($con, $sql);

        if ($query) {
            $reg = mysqli_fetch_assoc($query);
            if (!empty($reg['cod_usuario'])) {
                $sql = "UPDATE usuario SET senha = '" . $nova_senha . "' WHERE cod_usuario = " . $reg['cod_usuario'];

                $query = mysqli_query($con, $sql);

                if ($query) {
                    session_destroy();
                    echo'ok';
                } else {
                    echo 'Erro interno';
                }
            } else {
                echo 'Senha incorreta.';
            }
        } else {
            echo 'Erro interno';
        }
} else {
    echo 'Erro preencha todos os campos.';
}
