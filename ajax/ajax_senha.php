<?php

error_reporting(1);
if (!isset($_SESSION)) {
    session_start();
}

require('../config.php');
require('../bd.php');
require('../funcoes.php');

if (!empty($_POST['email']) && !empty($_POST['captcha'])) {

    $captcha = $_POST['captcha'];
    $captcha_session = $_SESSION['captcha'];

    if (strcmp($captcha, $captcha_session) == 0) {

        $email = Anti_Injection($_POST['email']);

        $bd = new bd();
        $con = $bd->open();

        $sql = "SELECT cod_usuario, senha, nome FROM usuario WHERE email = '" . $email . "'";

        $query = mysqli_query($con, $sql);

        if ($query) {
            $reg = mysqli_fetch_assoc($query);
            if (!empty($reg['cod_usuario']) && !empty($reg['senha'])) {

                $msg = '<html><head><title> Cloud Backup</title></head><body>';
                $msg .= 'Olá ' . $reg['nome'] . ", sua senha é: " . $reg['senha'] . "<br>";
                $msg .= '<p>Clique no link para acessar sua conta</p><a href="http://177.74.188.154:6080">http://177.74.188.154:6080</a>';
                $msg .= '</body></html>';

                if (envia_email($email, $msg)) {
                    echo 'ok';
                } else {
                    echo 'erro|Erro interno.';
                }
            }
        } else {
            echo 'erro|Erro interno.';
        }

        $bd->close();
    } else {
        echo 'erro|captcha incorreto.';
    }
} else {
    echo 'erro|preencha todos os campos.';
}

function envia_email($para, $body) {
    require("../email/PHPmailer.class.php");



    $host = host_email;
    $porta_smtp = porta_email;
    $nome_real = 'Sistem';
    $email = email;
    $senha_email = senha_email;
    $assunto = " Cloud Backup - Recuperação de Senha";


    $mail = new PHPMailer(true); //Cria instancia


    $mail->From = $email; //E-mail remetente
    $mail->FromName = $nome_real; //Nome remetente
    $mail->Subject = $assunto; //Assunto do e-mail
    $mail->Host = $host; //Host SMTP
    $mail->SMTPAuth = true; //Se o SMTP precisa de autenticação
    $mail->Username = $email; //Usuário SMTP
    $mail->Password = $senha_email; //Senha SMTP
    $mail->Port = $porta_smtp; //Porta
    $mail->Body = $body; //Mensagem a ser enviada
    $mail->IsHtml(true); //Mensagem no formato de texto
    $mail->IsSMTP(); //Configura mailer para entrega por SMTP
    $mail->SMTPDebug = 1; //Habilita debug do SMTP
//  $mail->SingleTo   = true;//Enviar e-mail individualmente
    $mail->AddReplyTo($email, $nome_real); //Configura o endereço para receber resposta da msg
    $mail->CharSet = 'utf-8'; //codificação
    $mail->AddAddress($para); //Adiciona destinatário da mensagem


    return $mail->Send();
}
