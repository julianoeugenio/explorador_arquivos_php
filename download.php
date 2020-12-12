<?php

ini_set('memory_limit', '2048M');
if (!isset($_SESSION)) {
    session_start();
}


require('config.php');

$raiz = pasta_raiz;

if (!empty($_GET['file'])) {
    $file = base64_decode($_GET['file']);
    $arquivo = $raiz . '/' . $file;

    if (file_exists($arquivo)) {

        $nome = pathinfo($file, PATHINFO_FILENAME);
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        /* header("Cache-Control: public");
          header("Content-Description: File Transfer");
          header("Content-Disposition: attachment; filename= " . $nome . '.' . $ext);
          header("Content-Transfer-Encoding: binary");
          readfile($arquivo); */

        header('Content-Disposition: attachment; filename=' . urlencode($nome . '.' . $ext));
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');
        header('Content-Description: File Transfer');
        header('Content-Length: ' . filesize($arquivo));
        echo file_get_contents($arquivo);
        die();
    } else {
        echo 'Erro Arquivo não encontrado.';
    }
    /* } else if (!empty($_GET['pasta'])) {
      $pasta = base64_decode($_GET['pasta']);
      $arquivo = __DIR__ . '\temp\\' . $_SESSION['nome_usuario'] . '.zip';

      if (file_exists($arquivo)) {

      $nome = pathinfo($arquivo, PATHINFO_FILENAME);
      $ext = pathinfo($arquivo, PATHINFO_EXTENSION);

      header("Cache-Control: public");
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename= " . $pasta . '.' . $ext);
      header("Content-Transfer-Encoding: binary");
      readfile($arquivo);
      unlink($arquivo);
      } else {
      echo 'Erro Arquivo não encontrado.';
      } */
} else {
    echo 'Erro Arquivo não encontrado (GET).';
}

