<?php
if (!isset($_SESSION)) {
    session_start();
}

require('config.php');
require('bd.php');

        $bd = new bd();
        $con = $bd->open();

        $sql = "SELECT email FROM usuario WHERE cod_usuario = " . $_SESSION['cod_usuario'];
        
        $query = mysqli_query($con, $sql);

        if ($query) {
            $reg = mysqli_fetch_assoc($query);
            $email = $reg['email'];
        }
        
        $bd->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Cloud Backup</title>
        <style>
            .div_principal{
               /* position: absolute;
                top: 20%;
                left: 25%;    */
                width: 360px;
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
                width: 143px;
                text-align: right;
            }
            .div_principal img{
                width: 174px;
                margin-left: 116px;
            }
            .div_principal .alerar_senha{
                float: right;
                padding: 4px;
                background-color: #7290c1;
                border: 1px solid #688bc4;
                color: #fff;
                font-size: 15px;
            }
            .div_principal .alerar_senha:hover,.voltar:hover{
                background-color: #1d66e5;
                border: 1px solid #1d66e5;
                color: #f4f8ff;
                cursor: pointer;
            }
            .div_principal .alerar_senha:active,.voltar:active{
                background-color: #0642a3;
                border: 1px solid #0642a3;
                color: #f4f8ff;
                cursor: pointer;
            }

            #mensagem{
                width: 152px;
                padding: 5px 10px 5px 14px;
                text-align: center;
                margin: -128px 0 0px 86px;
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
            <input type="text" name="email" id="email" maxlength="50" value="<?php echo $email;?>" style="width: 200px;"/>
            <br />
             <label>Senha atual:</label>
            <input type="password" name="senha_atual" id="senha_atual" maxlength="50" style="width: 200px;"/>
            <br />
            <br />
            <label>Nova senha:</label>
            <input type="password" name="nova_senha" id="nova_senha" maxlength="50" style="width: 200px;"/>
            <br />
            <label>Repita a nova senha:</label>
            <input type="password" name="nova_senha_rep" id="nova_senha_rep" maxlength="50" style="width: 200px;"/>
            <br />
            <br />
            <div class="alerar_senha">Alterar Senha</div>
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
        window.location.href="pastas.php";
        });
        
            $('.alerar_senha').on('click', function () {
                var email = $('#email').val();
                var senha_atual = $('#senha_atual').val();

                var nova_senha = $('#nova_senha').val();
                var nova_senha_rep = $('#nova_senha_rep').val();


                if (senha_atual != '' && email != '') {
                    if (nova_senha == '' || nova_senha == nova_senha_rep) {
                        $.ajax({
                            type: 'post',
                            data: {
                                'senha_atual': senha_atual,
                                'email': email,
                                'nova_senha': nova_senha,
                                'nova_senha_rep': nova_senha_rep
                            },
                            url: 'ajax/ajax_altera_senha.php',
                            success: function (retorno) {
                                if (retorno == 'ok') {
                                   window.location.href="index.php"
                                } else {
                                    mensagem(retorno);
                                }
                            }
                        });
                    } else {
                        mensagem('Repita a nova senha corretamente.');
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
        });
    </script>
</html>
