<?php
if (!isset($_SESSION)) {
    session_start();
}
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AW2Store Cloud Backup</title>
        <style>
            .div_principal{
               /* position: absolute;
                top: 20%;
                left: 25%;  */
                width: 212px;
                padding: 30px;
                border: 1px solid #ccc;
                margin-top: 100px;
            }
            .div_principal input{
                margin: 5px 0 5px 0;
            }
            .div_principal label{
                font-weight: bold;
                display: inline-block;
                width: 64px;
                text-align: right;
            }
            .div_principal img{
                width: 174px;
                margin-left: 68px;
            }
            .div_principal .login,.senha{
                float: right;
                padding: 4px;
                background-color: #7290c1;
                border: 1px solid #688bc4;
                color: #fff;
                font-size: 15px;
            }
            .div_principal .login:hover,.voltar:hover{
                background-color: #1d66e5;
                border: 1px solid #1d66e5;
                color: #f4f8ff;
                cursor: pointer;
            }
            .div_principal .login:active, .voltar:active{
                background-color: #0642a3;
                border: 1px solid #0642a3;
                color: #f4f8ff;
                cursor: pointer;
            }
            .div_principal .senha{
                float: left!important;
            }

            #mensagem{
                width: 152px;
                padding: 5px 10px 5px 14px;
                text-align: center;
                margin: -94px 0 0px 86px;
                display: none;
                color: #262525;
                float: right;
                border: 1px solid red;
                position: relative;
                left: -30px;
                top: -210px;
            }
            
                        .linha_separador{
            border:1px solid #000;
            margin:5px 0 5px 0;
            clear:both;
            }
            
            .voltar{
                float: right;
                padding: 4px;
                background-color: #7290c1;
                border: 1px solid #688bc4;
                color: #fff;
                font-size: 15px;
                margin-right: 74px;
            }

        </style>
        <title></title>
    </head>
    <body>
            <img src="img/logo.jpg" style="float:left;"/>
        <div style="clear:both;"></div>
        <div class="linha_separador"></div>
        <center>
        <div class="div_principal">
            <label>Email:</label>
            <input type="text" name="email" id="email" maxlength="50"/>
            <br />
            <label>Captcha:</label>
            <input type="text" name="captcha" id="captcha" maxlength="4"/>
            <br />
            <img src="captcha/captcha.php"/>
            <br/>
            <div class="login">Enviar Senha</div>
            <div class="voltar">Voltar</div>
            <br />
            <div style="clear: both;"></div>
            <div id="mensagem"></div>
        </div>
        </center>
    </body>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
        $('.voltar').on('click', function () {
        window.location.href="index.php";
        });
        
        
            $('.login').on('click', function () {
                var email = $('#email').val();
                var captcha = $('#captcha').val();

                if (email != '' && captcha != '') {
                    $.ajax({
                        type: 'post',
                        data: {
                            'email': email,
                            'captcha': captcha
                        },
                        url: 'ajax/ajax_senha.php',
                        success: function (retorno) {
                            if (retorno == 'ok') {
                                mensagem('Senha enviada para o email informado.');
                            } else {
                                mensagem(retorno.split('|')[1]);
                            }
                        }
                    });
                } else {
                    mensagem('Preencha todos os campos corretamente.');
                }

            });

            function mensagem(msg) {
                $('#mensagem').html(msg);
                $('#mensagem').show();

                setTimeout(function () {
                    $('#mensagem').fadeOut(1000);
                }, 6000);
            }
        });
    </script>
</html>
