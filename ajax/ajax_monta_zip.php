<?php

if (!empty($_POST['arquivos'])) {
    if (!isset($_SESSION)) {
        session_start();
    }

    require('../config.php');

    $arquivos = $_POST['arquivos'];

    $raiz = pasta_raiz;

    $nome_arquivo = $_SESSION['nome_usuario'] . '_' . md5(rand(0, 999999999999)) . '.zip';

    $zip_file_name = '../temp/' . $nome_arquivo;

//$diretorio = getcwd() . '/pasta_teste/';
//Instancia a Classe Zip
    $zip = new ZipArchive();
// Cria o Arquivo Zip, caso não consiga exibe mensagem de erro e finaliza script
    if ($zip->open($zip_file_name, ZIPARCHIVE::CREATE) == TRUE) {
// Insere os arquivos que devem conter no arquivo zip

        for ($i = 0; $i < count($arquivos); $i++) {
            $arquivo = $raiz . '/' . base64_decode($arquivos[$i]);
            if (file_exists($arquivo)) {
                $nome = pathinfo($arquivo, PATHINFO_FILENAME);
                $ext = pathinfo($arquivo, PATHINFO_EXTENSION);
                $zip->addFile($arquivo, $nome . '.' . $ext);
            }
        }

        echo 'ok|' . $nome_arquivo;
    } else {
        exit('erro|O Arquivo não pode ser criado.');
    }
// Fecha arquivo Zip aberto
    $zip->close();
} else {
    echo 'erro|Erro POST';
}
?>