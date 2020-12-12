<?php
require('verifica_sessao.php');

$cod_usuario = $_SESSION['cod_usuario'];

if ($cod_usuario == 1) {
    header('Location: cadastro.php');
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>AW2Store Cloud Backup</title>
            <style>
                body {
                    font-family: "Open Sans Condensed", sans-serif;
                }

                #bg {
                    -webkit-filter: blur(5px);    
                }


                .label{
                    height: 17px;
                    margin: 0 10px 0 0;
                    padding: 7px 5px 5px 0;
                    font-size: 12px;
                    font-weight: bold;
                    text-align: right;
                    display: inline-block;
                    width: 45px;
                }
                .grid_tb_caixa{
                    background-color: #fff;
                    text-align: left;
                    padding: 5px 5px 5px 5px;
                    margin: 5px 5px 5px 5px;
                    border: 1px solid #fff;
                    background-color:#D7D7D2;
                }          


                .grid_tb_caixa:hover{
                    color:#000;
                    border:1px solid #598c52;
                    background-color:#98ce89
                }

                .grid_tb_arquivos{
                    background-color: #fff;
                    text-align: left;
                    padding: 5px 5px 5px 5px;
                    margin: 5px 5px 5px 5px;
                    //border: 1px solid #fff;
                    //background-color:#D7D7D2;

                    // border: 1px solid #999;
                    box-shadow: 0 1px 8px #999;
                    border-radius: 4px;
                }          


                .grid_tb_arquivos:hover{
                    color:#000;
                    // border:1px solid #598c52;
                    background-color:#b2b2b2
                }


                .tb_style_arquivos{
                    padding: 5px 7px 7px 7px;
                    border-top: 1px solid #8e8e8e;
                    border-bottom: 1px solid #8e8e8e;
                    border-right: 1px dotted #8e8e8e;
                    font-size: 12px;
                    max-height: 27px;
                    max-width: 470px;
                    overflow: no-display;
                }
                .cursor_pointer {
                    cursor: pointer;
                }
                .tb_arquivos {
                    width: 200px;
                    min-height: 900px;
                    position: absolute;
                    margin: 10px;
                    padding: 10px;
                    border: 1px solid #999;
                    box-shadow: 0 1px 8px #999;
                    border-radius: 4px;
                    background-color: #fff;
                    font-size: 14px;
                    /*margin-top:62px;*/
                }

                .tb_arquivos a{
                    color: #000;
                }
                .tb_arquivos a:visited{
                    color: #000;
                }

                .cabecalho_tb {
                    padding: 7px 7px;
                    color: #798a9e;
                    text-decoration: none;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
                #info_espaco{
                    float: right;
                    margin: 41px 100px 38px 0;
                    font-size: 14px;
                    display: none;
                }
                .linha_separador{
                    border:1px solid #000;
                    margin:5px 0 5px 0;
                    clear:both;
                }
                .espaco_total{
                    max-width:202px;
                    width:202px;
                    border:1px solid  #ccc;
                    height:20px;
                }
                .espaco_usado{
                    background-color:red;
                    height: 20px;
                    float:left;
                }
                .espaco_livre{
                    background-color:#00bd00;
                    height: 20px;
                    float:left;
                }
                #mensagens{
                    float: left;margin: 38px;
                    color:red;
                }
            </style>
        </head>
        <body>
            <div id="div_fundo_geral" style="display: block; position: fixed; left: 0; width: 100%; height: 100%; min-height: 100%; min-width: 100%; margin-bottom: 100px; overflow-x: hidden; overflow-y: auto; background-color: #efefef;top: 0px;">
                <img src="img/logo.jpg" style="float:left;width: 215px;"/>
                <div style="clear:both;"></div>
                <div class="linha_separador"></div>
                <div id="menu_superior" style="display: block;width: 1248px;height: 100px;min-height: 100px;min-width: 1248px;margin-bottom: 5px;overflow-x: hidden;overflow-y: hidden;background-color: #fff;margin-left: 22px;border: 1px solid #999;box-shadow: 0 1px 8px #999;border-radius: 4px;">
                    <div style="float: left;margin: 38px;cursor: pointer;">
                        <img src="img/undo-1.svg"id="voltar" alt="Voltar" title="Voltar"/>
                    </div>

                    <div style="float: left;margin: 38px;cursor: pointer;">
                        <img src="img/refresh-7.svg" id="atualizar" alt="Atualizar" title="Atualizar"/>
                    </div>

                    <div style="float: left;margin: 38px;" id="download_desat">
                        <img src="img/download-2_desat.svg"  alt="Baixar arquivos selecionados" title="Baixar arquivos selecionados"/>
                    </div>

                    <div style="float: left;margin: 38px;cursor: pointer;display: none;" id="download">
                        <img src="img/download-2.svg"  alt="Baixar arquivos selecionados" title="Baixar arquivos selecionados"/>
                    </div>

                    <div style="float: left;margin: 38px;" id="delete_desat">
                        <img src="img/trash_desat.svg"  alt="Apagar arquivos selecionados" title="Apagar arquivos selecionados"/>
                    </div>

                    <div style="float: left;margin: 38px;cursor: pointer;display: none;" id="delete">
                        <img src="img/trash.svg"  alt="Apagar arquivos selecionados" title="Apagar arquivos selecionados"/>
                    </div>

                    <div style="float: left;margin: 38px;">
                        <a href="alterar_senha.php"><img src="img/key-2.svg" alt="Alterar Senha" title="Alterar Senha"/></a>
                    </div>


                    <div style="float: left;margin: 38px;">
                        <a href="ajuda.html" target="_blank"><img src="img/icons_book.png" id="ajuda" alt="Ajuda" title="Ajuda" style="width: 32px;"/></a>
                    </div>


                    <div style="float: left;margin: 38px;">
                        <a href="task.php" target="_blank"><img src="img/task.svg" id="task" alt="CronTab" title="CronTab" style="width: 32px;"/></a>
                    </div>


                    <div style="float: left;margin: 38px;">
                        <img src="img/log-out-7.svg" id="sair" alt="Sair" title="Sair"/>
                    </div>



                    <div id="mensagens"></div>



                    <div id="info_espaco"></div>

                </div>

                <div style="float:left; display: block; overflow-x: hidden; overflow-y: auto; margin-bottom: 100px;">
                    <div id="div_caixas" style="float: left; margin-left: 10px; background-color: #fff;" class="">
                        <div class="tb_arquivos">

                        </div>                        
                    </div>


                    <div id="div_arquivos" style="float:left; display: block; margin-left:250px; margin-right: 50px; overflow: hidden; position: absolute; margin-bottom: 100px;">

                        <div class="" style=" margin-bottom:10px; /*max-height:450px;*/ overflow:auto; margin-top: 10px;"><!--<a href="#" id="voltar_caixa" class="btn_voltar">Fechar</a>--> <div id="div_tb_arquivos" style="min-width: 1000px; border: 1px solid rgb(187, 211, 218); padding: 10px 10px 40px; background-color: rgb(255, 255, 255); border-radius: 8px; width: 546px;">
                                <table id="tb_arquivos" style="min-width: 1000px; width: 546px;">
                                    <thead class="cabecalho_tb">
                                        <tr>
                                            <th style="border-top: 1px solid #333; border-right: 1px solid #333; border-bottom: 1px solid #333; padding: 5px 0 5px 0; max-width: 55px;"><input type="checkbox" id="sel_todos"/></th>
                                            <th style="border-top: 1px solid #333; border-right: 1px solid #333; border-bottom: 1px solid #333; padding: 5px 5px 5px 5px;">Pasta/Arquivo</th>
                                            <th style="border-top: 1px solid #333; border-right: 1px solid #333; border-bottom: 1px solid #333; padding: 5px 5px 5px 5px;">Data</th>
                                            <th style="border-top: 1px solid #333; border-right: 1px solid #333; border-bottom: 1px solid #333; padding: 5px 5px 5px 5px;">Tamanho</th>
                                        </tr>
                                    </thead>

                                    <tbody id="columns">

                                    </tbody>

                                </table>
                            </div></div>

                    </div>

                </div>
            </div>
        </body>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                var pastas_anteriores = [];

                carrega_pasta('', true);
                fun_ajusta_largura();

                $.ajax({
                    type: 'post',
                    url: 'ajax/ajax_info_espaco.php',
                    success: function (retorno) {
                        var array = retorno.split('|');

                        $('#info_espaco').html('HD: Ultilizado: ' + array[0] + ' Livre: ' + array[1] + array[2]);
                        $('#info_espaco').show();
                    }
                });

                $.ajax({
                    type: 'post',
                    url: 'ajax/ajax_carrega_mensagens.php',
                    success: function (retorno) {
                        $('#mensagens').html('Mensagem: ' + retorno);
                    }
                });

                function fun_ajusta_largura() {
                    var w = $(document).width() - 320;

                    $('#div_tb_arquivos').css('width', w);
                    $('#tb_arquivos').css('width', w);
                    $('#menu_superior').css('width', $(document).width() - 73);
                }

                $(window).resize(function () {
                    fun_ajusta_largura();
                });

                $(document).on('click', '.sel_arquivos', function () {
                    var checado = false;

                    $('#sel_todos').prop('checked', false);

                    $('.sel_arquivos').each(function () {
                        if ($(this).prop('checked')) {
                            checado = true;
                        }
                    });

                    if (checado) {
                        $('#download_desat').hide();
                        $('#download').show();

                        $('#delete_desat').hide();
                        $('#delete').show();
                    } else {
                        $('#download').hide();
                        $('#download_desat').show();

                        $('#delete').hide();
                        $('#delete_desat').show();
                    }
                });

                $(document).on('click', '#sel_todos', function () {
                    var checado = $(this).prop('checked');

                    $('.sel_arquivos').each(function () {
                        $(this).prop('checked', checado);
                    });

                    if (checado) {
                        $('#download_desat').hide();
                        $('#download').show();

                        $('#delete_desat').hide();
                        $('#delete').show();
                    } else {
                        $('#download').hide();
                        $('#download_desat').show();

                        $('#delete').hide();
                        $('#delete_desat').show();
                    }
                });
                $(document).on('click', '#sair', function () {
                    $.ajax({
                        type: 'post',
                        url: 'ajax/ajax_sair.php',
                        success: function () {
                            window.location.href = 'index.php';
                        }
                    });
                });
                $(document).on('click', '#delete', function () {

                    var arquivos = [];

                    $('.sel_arquivos').each(function () {
                        if ($(this).prop('checked')) {
                            arquivos[arquivos.length] = $(this).prop('id').split('sel_')[1];
                        }
                    });

                    if (arquivos.length == 0) {
                        arquivos[arquivos.length] = pastas_anteriores[pastas_anteriores.length - 1];
                    }

                    pastas_anteriores.splice(pastas_anteriores.length - 1, 1);
                    $.ajax({
                        type: 'post',
                        data: {
                            'arquivos': arquivos
                        },
                        url: 'ajax/ajax_apaga_arquivos.php',
                        beforeSend: function () {

                        },
                        success: function () {
                            carrega_pasta(pastas_anteriores[pastas_anteriores.length - 1], false);
                            $('.sel_arquivos').prop('checked', false);
                        }
                    });
                });
                $(document).on('click', '#download', function () {

                    var arquivos = [];

                    $('.sel_arquivos').each(function () {
                        if ($(this).prop('checked')) {
                            arquivos[arquivos.length] = $(this).prop('id').split('sel_')[1];
                        }
                    });

                    $.ajax({
                        type: 'post',
                        data: {
                            'arquivos': arquivos
                        },
                        url: 'ajax/ajax_monta_zip.php',
                        beforeSend: function () {

                        },
                        success: function (retorno) {
                            var array = retorno.split('|');
                            if (array[0] == 'ok') {
                                window.location.href = 'temp/' + array[1];
                            } else {
                                alert(array[1]);
                            }
                        }
                    });
                });

                $(document).on('click', '.baixa_arquivo', function () {
                    var arquivo = $(this).attr('file');
                    window.location.href = 'download.php?file=' + arquivo;
                });
                $(document).on('click', '.nav', function () {
                    var id = $(this).prop('id');
                    if (id >= 0) {
                        var qtn = parseInt(id) + 1;
                        pastas_anteriores.splice(qtn, pastas_anteriores.length - 1);
                        carrega_pasta(pastas_anteriores[id], false);
                    }
                    return false;
                });

                $(document).on('click', '#atualizar', function () {
                    carrega_pasta(pastas_anteriores[pastas_anteriores.length - 1], false);
                    return false;
                });

                $(document).on('click', '#voltar', function () {
                    if (pastas_anteriores.length > 1) {
                        pastas_anteriores.splice(pastas_anteriores.length - 1, 1);
                        carrega_pasta(pastas_anteriores[pastas_anteriores.length - 1], false);
                    } else {
                        carrega_pasta('', true);
                    }
                    return false;
                });

                $(document).on('click', '.abre_pasta', function () {
                    var pasta = $(this).prop('id');

                    if (pasta != '') {
                        carrega_pasta(pasta, true);
                    }
                });

                function carrega_pasta(pasta, grava) {
                    if (grava) {
                        pastas_anteriores[pastas_anteriores.length] = pasta;
                    }

                    if (pastas_anteriores.length > 1) {
                        $('#delete_desat').hide();
                        $('#delete').show();
                    } else {
                        $('#delete').hide();
                        $('#delete_desat').show();
                    }
                    $.ajax({
                        type: 'post',
                        data: {
                            'pastas_anteriores': pastas_anteriores
                        },
                        url: 'ajax/ajax_monta_arvore.php',
                        beforeSend: function () {
                            $('body').css('cursor', 'wait');
                        },
                        success: function (retorno) {
                            $('.tb_arquivos').html(retorno);
                        }
                    });

                    $.ajax({
                        type: 'post',
                        data: {
                            'pasta': pasta
                        },
                        url: 'ajax/ajax_carrega_arquivos.php',
                        beforeSend: function () {

                        },
                        success: function (retorno) {
                            $('#columns').html(retorno);
                            $('body').css('cursor', 'default');
                        }
                    });
                }
            });
        </script> 
    </html>
    <?php
}
?>

