<?php

class bd {

    protected $conexao = null;

    function _construct() {
        
    }

    function open() {
        $this->conexao = mysqli_connect(host, user, password, db) or die(mysqli_error());
        return $this->conexao;
    }

    function close() {
        mysqli_close($this->conexao) or die(mysql_error());
    }

}
