<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!empty($_POST['cod_usuario'])) {
    $cod_usuario = $_POST['cod_usuario'];
} else if (!empty($_SESSION['cod_usuario'])) {
    $cod_usuario = $_SESSION['cod_usuario'];
}
if (!empty($cod_usuario)) {
    require('../config.php');
    require('../bd.php');



    $bd = new bd();
    $con = $bd->open();

    $sql = "SELECT mensagem FROM mensagem WHERE cod_usuario = " . $cod_usuario;

    $query = mysqli_query($con, $sql);

    if ($query) {
        $mensagens = '';
        if ($reg = mysqli_fetch_assoc($query)) {
                $mensagens = $reg['mensagem'];            
        }
        echo $mensagens;
    } else {
        echo'Erro interno';
    }
    $bd->close();
}