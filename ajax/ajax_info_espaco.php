<?php

if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');

$raiz = pasta_raiz_;

$total = disk_total_space($raiz);
$livre = disk_free_space($raiz);


$ultilizado = retorna_tamanho($total - $livre);

$pct_espaco_usado = (100/$total)*($total - $livre);

$w_total = 200;

$w_ocupado =  $w_total*($pct_espaco_usado/100);

$w_livre = $w_total - $w_ocupado;

$div = '<div class="espaco_total" style="width:'.round($w_total,1).'px"><div class="espaco_usado" style="width:'.round($w_ocupado,1).'px"></div><div class="espaco_livre"  style="width:'.round($w_livre,1).'px"></div></div>';

echo $ultilizado . '|' . retorna_tamanho($livre).'|'.$div;

function retorna_tamanho($tamanho) {
    $unidades = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = 0;

    while ($tamanho > 1024) {
        $tamanho /= 1024;
        $i++;
    }

    return round($tamanho, 1) . ' ' . $unidades[$i];
}
