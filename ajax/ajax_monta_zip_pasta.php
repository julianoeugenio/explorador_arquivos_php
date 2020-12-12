<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');

$raiz = pasta_raiz;
if (!empty($_POST['pasta'])) {
    $pasta = '/' . base64_decode($_POST['pasta']);
} else {
    $pasta = '/';
}

$pasta = $raiz . $pasta;

if (is_dir($pasta)) {

    $nome_arquivo = $_SESSION['nome_usuario'] . '_' . md5(rand(0, 999999999999)) . '.zip';

    $zip_file_name = '../temp/' . $nome_arquivo;

    class FlxZipArchive extends ZipArchive {

        /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  * */
        public function addDir($location, $name) {
            $this->addEmptyDir($name);
            $this->addDirDo($location, $name);
        }

// EO addDir;

        /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann * @access private   * */
        private function addDirDo($location, $name) {
            $name .= '/';
            $location .= '/';
            // Read all Files in Dir
            $dir = opendir($location);
            while ($file = readdir($dir)) {
                if ($file == '.' || $file == '..')
                    continue;
                // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
                if (filetype($location . $file) != 'dir') {
                    $this->addFile($location . $file, $name . $file);
                }
            }
        }

    }

    $za = new FlxZipArchive;
    $res = $za->open($zip_file_name, ZipArchive::CREATE);
    if ($res === TRUE) {
        $za->addDir($pasta, basename($pasta));
        $za->close();
        echo 'ok|' . $nome_arquivo;
    } else {
        echo 'erro|Não foi possivel criar o zip.';
    }
} else {
    echo 'erro|Erro, pasta não encontrada.';
}

