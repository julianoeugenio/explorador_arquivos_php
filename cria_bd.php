<?php
require('config.php');
require('bd.php');
$bd = new bd();
$con = $bd->open();

//$sql = "CREATE TABLE usuario (
//cod_usuario INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//nome VARCHAR(40) NOT NULL,
//email VARCHAR(50) NOT NULL,
//nome_usuario VARCHAR(20) NOT NULL,
//senha VARCHAR(20) NOT NULL
//)";

//$sql = "INSERT INTO usuario (nome, email, nome_usuario,senha) VALUES('administrador', 'admin@admin', 'admin', 'admin')";



//$sql = "SELECT * FROM usuario";



$sql = "CREATE TABLE mensagem (
cod_mensagem INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
cod_usuario INT(6) NOT NULL,
mensagem VARCHAR(200) NOT NULL
)";

//$sql = "INSERT INTO mensagem (cod_usuario, mensagem) VALUES(2,'Teste mensagem')";
//$sql = "DELETE FROM mensagem where cod_mensagem = 2";

$query = mysqli_query($con, $sql);

if ($query) {
    echo 'ok';
} else {
    echo mysqli_error($con);
}

$bd->close();
?>