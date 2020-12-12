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
            <title> Cloud Backup</title>
            <style>
                body {
                    font-family: "Open Sans Condensed", sans-serif;
                }

                .linha_separador{
                    border:1px solid #000;
                    margin:5px 0 5px 0;
                    clear:both;
                }
                .div_principal{
                    /* position: absolute;
                     top: 20%;
                     left: 25%;  */
                    width: 220px;
                    padding: 30px;
                    border: 1px solid #ccc;
                    margin-top: 100px;
                }
                #dia_ret{
                    width: 20px;
                }
                .separador{
                    margin:10px 0 10px 0;
                }
                .div_principal label{
                    font-weight: bold;
                    display: inline-block;
                    width: 145px;
                    text-align: right;
                    font-size: 15px;
                }

                .div_principal .salvar,.voltar{
                    float: right;
                    padding: 4px;
                    background-color: #7290c1;
                    border: 1px solid #688bc4;
                    color: #fff;
                    font-size: 15px;
                }
                .div_principal .salvar:hover,.voltar:hover{
                    background-color: #1d66e5;
                    border: 1px solid #1d66e5;
                    color: #f4f8ff;
                    cursor: pointer;
                }
                .div_principal .salvar:active,.voltar:active{
                    background-color: #0642a3;
                    border: 1px solid #0642a3;
                    color: #f4f8ff;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <img src="img/logo.jpg" style="float:left;"/>
            <div style="clear:both;"></div>
            <div class="linha_separador"></div>
        <center>
            <div class="div_principal">
                <label>Habilitar retenção</label><input type="checkbox" id="hab_retencao" name="hab_retencao" />
                <div class="separador"></div>
                <label>Retenção diária de </label><input type="text" name="dia_ret" id="dia_ret" maxlength="2"/><label style="width: auto;text-align: unset;">dias</label>
                <div class="separador"></div>
                <label>Retenção mensal</label><input type="checkbox" id="hab_retencao" name="hab_retencao" />
                <div class="separador"></div>
                <label>para todo dia </label><input type="text" name="dia_ret" id="dia_ret" maxlength="2"/>
                <div class="separador"></div>
                <div class="voltar" style="float: left;">Voltar</div>
                <div class="salvar">Salvar</div>
            </div>
        </center>
    </body>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.voltar').on('click', function () {
                window.location.href = 'pastas.php';
            });
        });
    </script> 
    </html>
    <?php
}
?>