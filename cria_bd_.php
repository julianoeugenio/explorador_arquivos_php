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
//$sql = "INSERT INTO usuario (nome, email, nome_usuario,senha) VALUES('Mateus', 'teste@teste', 'mateus', '123')";

$sql = "SELECT * FROM usuario";

$query = mysqli_query($con, $sql);

if ($query) {
    //echo 'ok';

while($reg = mysqli_fetch_assoc($query)){
print_r($reg);
echo '<br>';
}
} else {
    echo mysqli_error($con);
}

$bd->close();
?>
