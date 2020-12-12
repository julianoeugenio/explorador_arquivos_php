<?php
require('verifica_sessao.php');
if ($_SESSION['cod_usuario'] == 1) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <style>
                .div_principal{
                    /*position: absolute;
                    top: 20%;
                    left: 25%;     */
                    width: 275px;
                    padding: 30px;
                    border: 1px solid #ccc;
                    margin-top: 100px;
                }
                .div_principal input{
                    margin: 5px 0 5px 0;
                    width: 200px;
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
                .div_principal .cadastrar{
                    float: right;
                    padding: 4px;
                    background-color: #7290c1;
                    border: 1px solid #688bc4;
                    color: #fff;
                    font-size: 15px;
                }
                .div_principal .cadastrar:hover{
                    background-color: #1d66e5;
                    border: 1px solid #1d66e5;
                    color: #f4f8ff;
                    cursor: pointer;
                }
                .div_principal .cadastrar:active{
                    background-color: #0642a3;
                    border: 1px solid #0642a3;
                    color: #f4f8ff;
                    cursor: pointer;
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
                    top: -250px;
                }

                #sair{
                    float: left!important;
                    color: red!important;
                }

                #limpar_pasta{
                    float: left!important;
                    color: red!important;
                }

                .linha_separador{
                    border:1px solid #000;
                    margin:5px 0 5px 0;
                    clear:both;
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
                <div class="cadastrar" id="limpar_pasta">Limpar pasta temporária</div>
                <div style="clear: both;"></div>
                <label>Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="40"/>
                <br />
                <label>Email:</label>
                <input type="text" name="email" id="email" maxlength="50"/>
                <br />
                <label>Login:</label>
                <input type="text" name="login" id="login" maxlength="20"/>
                <br />
                <label>Senha:</label>
                <input type="password" name="senha" id="senha" maxlength="20"/>
                <br />
                <label>Captcha:</label>
                <input type="text" name="captcha" id="captcha" maxlength="4"/>
                <br />
                <div class="cadastrar" id="sair">Cancelar</div>
                <div class="cadastrar" id="cadastrar">Cadastrar</div>
                <div style="clear: both;"></div>
                <br/>
                <div id="mensagem"></div>
                <div class="cadastrar" id="nova_mensagem">Nova mensagem</div>
            </div>

        </center> 
    </body>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#nova_mensagem', function () {
                window.location.href = 'nova_mensagem.php';
            });
            $(document).on('click', '#limpar_pasta', function () {
                $.ajax({
                    type: 'post',
                    url: 'ajax/ajax_limpa_pasta_temp.php',
                    beforeSend: function () {

                    },
                    success: function (retorno) {
                        $('#limpar_pasta').html(retorno);
                    }
                });
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

            $('#cadastrar').on('click', function () {
                var nome = $('#nome').val();
                var email = $('#email').val();
                var login = $('#login').val();
                var senha = $('#senha').val();

                if (nome != '' && email != '' && login != '' && senha != '') {
                    if (validateEmail(email)) {
                        $.ajax({
                            type: 'post',
                            data: {
                                'nome': nome,
                                'email': email,
                                'login': login,
                                'senha': senha
                            },
                            url: 'ajax/ajax_cadastro.php',
                            beforeSend: function () {

                            },
                            success: function (retorno) {
                                if (retorno == 'ok') {
                                    window.location.href = 'index.php';
                                } else {
                                    mensagem(retorno.split('|')[1]);
                                }
                            }
                        });
                    } else {
                        mensagem('Email inválido.');
                    }
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

            function validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
        });
    </script>
    </html>
    <?php
}
?>
