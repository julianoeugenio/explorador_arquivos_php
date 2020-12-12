<?php
require('verifica_sessao.php');
if ($_SESSION['cod_usuario'] == 1) {
    require('config.php');
    require('bd.php');
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
                    width: 375px;
                    padding: 30px;
                    border: 1px solid #ccc;
                    margin-top: 100px;
                }
                .linha_separador{
                    border:1px solid #000;
                    margin:5px 0 5px 0;
                    clear:both;
                }

                .div_principal .salvar{
                    padding: 4px;
                    background-color: #7290c1;
                    border: 1px solid #688bc4;
                    color: #fff;
                    font-size: 15px;
                }
                .div_principal .salvar:hover{
                    background-color: #1d66e5;
                    border: 1px solid #1d66e5;
                    color: #f4f8ff;
                    cursor: pointer;
                }
                .div_principal .salvar:active{
                    background-color: #0642a3;
                    border: 1px solid #0642a3;
                    color: #f4f8ff;
                    cursor: pointer;
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
                <select id="usuario" style="width: 200px;">
                    <option value="0">Selecione um usuário</option>
                    <?php
                    $bd = new bd();
                    $con = $bd->open();

                    $sql = "SELECT cod_usuario, nome_usuario FROM usuario where cod_usuario <> 1";

                    $query = mysqli_query($con, $sql);

                    if ($query) {
                        $mensagens = '';
                        while ($reg = mysqli_fetch_assoc($query)) {
                            echo'<option value="' . $reg['cod_usuario'] . '">' . $reg['nome_usuario'] . '</option>';
                        }
                    } else {
                        echo 'Erro interno.';
                    }
                    ?>
                </select>
                <br><br>
                <textarea style="width: 350px;height: 100px;" id="mensagem" maxlength="200"></textarea>
                <br><br>
                <div class="salvar">Salvar</div>
            </div>
            <a href="cadastro.php">Voltar</a>

        </center> 
    </body>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.salvar').on('click', function () {
                var cod_usuario = $('#usuario').val();
                var mensagem = $('#mensagem').val();

                if (cod_usuario > 0) {
                    $.ajax({
                        type: 'post',
                        data: {
                            'cod_usuario': cod_usuario,
                            'mensagem': mensagem
                        },
                        url: 'ajax/ajax_salva_mensagem.php',
                        success: function (retorno) {
                            if (retorno == 'ok') {
                                alert('Dados salvos com sucesso.');
                            } else {
                                alert(retorno);
                            }
                        }
                    });
                } else {
                    alert('Preencha todos os dados corretamente.');
                }
            });
            $('#usuario').on('change', function () {
                var cod_usuario = $(this).val();
                if (cod_usuario > 0) {
                    $.ajax({
                        type: 'post',
                        data: {
                            'cod_usuario': cod_usuario
                        },
                        url: 'ajax/ajax_carrega_mensagens.php',
                        success: function (retorno) {
                            $('#mensagem').html(retorno);
                        }
                    });
                }
            });
        });
    </script>
    </html>
    <?php
}
?>