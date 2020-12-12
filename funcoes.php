<?php

function Anti_Injection($campo, $adicionaBarras = false) {
    // remove palavras que contenham sintaxe sql
    $campo = preg_replace("/(from|alter table|select|insert|delete|update|
								where|drop table|show tables|\|--|\\\\)/i", "", $campo);
    $campo = trim($campo); //limpa espaços vazio
    $campo = strip_tags($campo); //tira tags html e php
    if ($adicionaBarras || !get_magic_quotes_gpc())
        $campo = addslashes($campo); //Adiciona barras invertidas a uma string
    return $campo;
}

?>
