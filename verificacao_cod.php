<!DOCTYPE html>
<html lang="pt-br">
<html>
    <head>
         <meta charset="utf-8">
        <title>Alterar a senha</title>
    </head>
    <body>
	<hr>
    <?php
            include "conexao.php";
            session_start();
            $codigo_enviado= $_SESSION['cod'];
            $codigo_recebido = $_POST['codigo'];
            if ($codigo_enviado == $codigo_recebido )
            {
               header("Location: http://200.145.153.175/heloisasabioni/ecommerce/alteracao_de_senha.php");
               exit();
            }
            else
            {
                echo "<script type='text/javascript'> alert('O código informado está errado!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=escreva_o_cod.php'>";
            }    
     ?>
    </body>
 </html>