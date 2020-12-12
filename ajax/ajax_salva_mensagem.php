<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');
require('../bd.php');
require('../funcoes.php');

if (!empty($_POST['cod_usuario']) && !empty($_POST['mensagem'])) {

    $cod_usuario = Anti_Injection($_POST['cod_usuario']);
    $mensagem = Anti_Injection($_POST['mensagem']);


    $bd = new bd();
    $con = $bd->open();

    $sql = "SELECT cod_mensagem FROM mensagem WHERE cod_usuario = " . $cod_usuario;

    $query = mysqli_query($con, $sql);

    if ($query) {

        $reg = mysqli_fetch_assoc($query);

        if (!empty($reg['cod_mensagem'])) {
            $sql_update = "UPDATE mensagem SET mensagem = '" . $mensagem . "' WHERE cod_mensagem = " . $reg['cod_mensagem'];
            $query_update = mysqli_query($con, $sql_update);
            if ($query_update) {
                echo 'ok';
            } else {
                echo 'erro|Erro interno.';
            }
        } else {

            $sql_insert = "INSERT INTO mensagem (cod_usuario, mensagem) VALUES('" . $cod_usuario . "', '" . $mensagem . "')";
            $query_insert = mysqli_query($con, $sql_insert);
            if ($query_insert) {
                echo 'ok';
            } else {
                echo 'erro|Erro interno.';
            }
        }
    } else {
        echo 'erro|Erro interno.';
    }

    $bd->close();
}