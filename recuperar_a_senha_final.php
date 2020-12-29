<?php
    require_once('./PHPMailer/php_mailer/PHPMailer.php');
    use PHPMailer\PHPMailer\PHPMailer;
    require_once('./PHPMailer/php_mailer/SMTP.php');
    use PHPMailer\PHPMailer\SMTP;
    require_once('./PHPMailer/php_mailer/Exception.php');
    use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Recuperar a senha</title>
</head>

<body>
    <?php

        include "conexao.php";
        session_start();

        $email = $_POST['mail'];

        $sql="select * from cliente WHERE  email = '$email' and excluido = 'n'";
        $resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);
        $line = pg_fetch_array($resultado);
        $nome = $line['nome'];
    
        $sql2="select * from administrador WHERE email = '$email' and excluido = 'n'";
        $resultado2=pg_query($conecta,$sql2);
        $linhas2=pg_affected_rows($resultado2);
        $line2 = pg_fetch_array($resultado2);
        $nome2 = $line2['nome'];

        if($linhas>0)
        {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'utf-8';
            $random = rand(1000,9999);

            $_SESSION['email'] = $email;
            $_SESSION['cod'] = $random;

            try 
            {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'company.styl@gmail.com';
                $mail->Password = 'styl_cti72b';
                $mail->Port = 587;

                $mail->setFrom('company.styl@gmail.com'); //email que vai fazer envio
                $mail->addAddress("$email"); //email do usuario
                
                $mail->AddEmbeddedImage('imagens/logoemail.png', 'logo_2u');

                $mail->isHTML(true);
                $mail->Subject = 'Pedido de Alteração de Senha';
                $mail->Body = "
                    <div align = center>
                        <img alt='PHPMailer' src='cid:logo_2u'><br>
                        <h1>Pedido de Alteração de Senha</h1>
                    </div>
                    <div align = justify>
                        <font size = 3>
                            <p>Olá $nome!</p>
                            <p>Obrigado por entrar em contato sobre a alteração da sua senha. Seu código é: <b>$random</b>, basta inseri-lo na página em que será redirecionado ao <a href='200.145.153.175/heloisasabioni/ecommerce/escreva_o_cod.php'>clicar aqui</a>.</p>
                            <p>Você não solicitou a alteração de sua senha? Então ignore este email.</p>
                            <p>- Styl Ltda.</p>
                        </font>
                    </div>
                ";
                $email->AltBody = "Seu código é: $random";

                if ($mail->send()) 
                {
                    // o que vai fazer quando enviar                
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=escreva_o_cod.php'>";
                    exit();
                }
                else 
                {
                    echo "<script type='text/javascript'> alert('O envio do email falhou!')</script>";                 
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=recuperar_a_senha.php'>";
                }
            } 
            catch (Exception $e) 
            {
                echo "<script type='text/javascript'> alert('O envio do email falhou!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=recuperar_a_senha.php'>";
            }
        }
    
        else if($linhas2>0)
        {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'utf-8';
            $random = rand(1000,9999);

            $_SESSION['email'] = $email;
            $_SESSION['cod'] = $random;

            try 
            {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'company.styl@gmail.com';
                $mail->Password = 'styl_cti72b';
                $mail->Port = 587;

                $mail->setFrom('company.styl@gmail.com'); //email que vai fazer envio
                $mail->addAddress("$email"); //email do usuario
                
                $mail->AddEmbeddedImage('imagens/logoemail.png', 'logo_2u');

                $mail->isHTML(true);
                $mail->Subject = 'Pedido de Alteração de Senha';
                $mail->Body = "
                    <div align = center>
                        <img alt='PHPMailer' src='cid:logo_2u'><br>
                        <h1>Pedido de Alteração de Senha</h1>
                    </div>
                    <div align = justify>
                        <font size = 3>
                            <p>Olá $nome2!</p>
                            <p>Obrigado por entrar em contato sobre a alteração da sua senha. Seu código é: <b>$random</b>, basta inseri-lo na página em que será redirecionado ao <a href='200.145.153.175/heloisasabioni/ecommerce/escreva_o_cod.php'>clicar aqui</a>.</p>
                            <p>Você não solicitou a alteração de sua senha? Então ignore este email.</p>
                            <p>- Styl Ltda.</p>
                        </font>
                    </div>
                ";
                $email->AltBody = "Seu código é: $random";

                if ($mail->send()) 
                {
                    // o que vai fazer quando enviar                
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=escreva_o_cod.php'>";
                    exit();
                }
                else 
                {
                    echo "<script type='text/javascript'> alert('O envio do email falhou!')</script>";                 
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=recuperar_a_senha.php'>";
                }
            } 
            catch (Exception $e) 
            {
                echo "<script type='text/javascript'> alert('O envio do email falhou!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=recuperar_a_senha.php'>";
            }
        }
    
        else
        {
            echo "<script type='text/javascript'> alert('Insira um email válido!')</script>";                 
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=recuperar_a_senha.php'>";
        }
    ?>
</body>
</html>