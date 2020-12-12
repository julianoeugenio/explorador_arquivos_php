<?php

if (!isset($_SESSION)) {
    session_start();
}

//--------------------MYSQL--------------------------
define('host', '127.0.0.1');
define('user', 'root');
define('password', '36374484');
define('db', 'db002');

//--------------------PASTA--------------------------
define('pasta_raiz_', 'G:\xampp\htdocs');

if (isset($_SESSION['nome_usuario'])) {
    if (!empty($_SESSION['nome_usuario'])) {
        define('pasta_raiz', pasta_raiz_ . '\\' . $_SESSION['nome_usuario']);
    }
}

//--------------------EMAIL--------------------------

define('host_email', 'smtp.site.com.br');
define('porta_email', '587');
define('email', 'juliano@site.com.br');
define('senha_email', '123456');

?>