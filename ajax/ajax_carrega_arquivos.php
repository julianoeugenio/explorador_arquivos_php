<?php

require('../config.php');

$raiz = pasta_raiz;

if (is_dir($raiz)) {

    if (!empty($_POST['pasta'])) {
        $raiz .= '/' . base64_decode($_POST['pasta']);
        $add = explode(pasta_raiz, $raiz);
        $add = $add[1] . '/';
    } else {
        $raiz .= '/';
        $add = '';
    }


    $dir = opendir($raiz);

    $pastas = array();
    $arquivos = array();

    while (false !== ($nome_arquivo = readdir($dir))) {
        if ($nome_arquivo != '' && $nome_arquivo != '.' && $nome_arquivo != '..') {
            if (is_dir($raiz . "/" . $nome_arquivo)) {
                $pastas[] = $nome_arquivo;
            } else {
                $arquivos[] = $nome_arquivo;
            }
        }
    }

    $html = '';

    for ($i = 0; $i < count($pastas); $i++) {
        $html .= '<tr class="grid_tb_arquivos cursor_pointer abre_pasta"  id="' . base64_encode($add . $pastas[$i]) . '">';
        $html .= '<td class="tb_style_arquivos" style="padding: 5px 1px 7px 1px;"></td>';
        $html .= '<td class="tb_style_arquivos"><img src="img/folder-11.svg" style="height:20px; width:20px;margin-right: 10px;"/>' . $pastas[$i] . '</td>';
        $html .= '<td class="tb_style_arquivos">' . gmdate("d/m/Y H:i:s", strtotime(get_hora_fuso_horario()." hour", filectime($raiz . '/' . $pastas[$i]))) . '</td>';
        $html .= '<td class="tb_style_arquivos"></td>';
        $html .= '</tr>';
    }

    for ($i = 0; $i < count($arquivos); $i++) {
        $html .= '<tr class="grid_tb_arquivos cursor_pointer">';
        $html .= '<td class="tb_style_arquivos" style="padding: 5px 1px 7px 1px;"><input type="checkbox" class="sel_arquivos" id="sel_' . base64_encode($add . $arquivos[$i]) . '"/></td>';
        $html .= '<td class="tb_style_arquivos baixa_arquivo" file="' . base64_encode($add . $arquivos[$i]) . '"><img src="img/file_2.svg" style="height:20px; width:20px;margin-right: 10px;"/>' . $arquivos[$i] . '</td>';
        $html .= '<td class="tb_style_arquivos">' . gmdate("d/m/Y H:i:s", strtotime(get_hora_fuso_horario()." hour", filectime($raiz . '/' . $arquivos[$i]))) . '</td>';
        $html .= '<td class="tb_style_arquivos baixa_arquivo" file="' . base64_encode($add . $arquivos[$i]) . '">' . getTamanho($raiz . '/' . $arquivos[$i]) . '</td>';
        $html .= '</tr>';
    }

    echo $html;
} else {
    echo 'Não foi possivel acessar a pasta raiz';
}

function getTamanho($arquivo) {
    $tamanho = filesize($arquivo);
    $unidades = array('B', 'KB', 'MB', 'GB');
    $i = 0;

    while ($tamanho > 1024) {
        $tamanho /= 1024;
        $i++;
    }

    return round($tamanho, 1) . ' ' . $unidades[$i];
}

function get_hora_fuso_horario() {
    if (date('I') == 1) {
        return  '- 2';
    } else {
        return '- 3';
    }
}
?>


