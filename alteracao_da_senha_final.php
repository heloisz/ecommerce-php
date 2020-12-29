<!DOCTYPE html>
<html lang="pt-br">
<head>
         <meta charset="utf-8">
        <title>Login</title>
</head>
<body>
	<hr>
    <?php
        include "conexao.php";
        session_start();

        $email = $_SESSION['email'];
        $senha_conf = md5($_POST['senha_confirm']);
        $senha=md5($_POST['senha']);
        if($senha == $senha_conf)
        {
            $sql= "UPDATE cliente SET senha = '$senha' WHERE email = '$email'";
            $resultado=pg_query($conecta,$sql);
            $linhas=pg_affected_rows($resultado);

            if ($linhas > 0)
            {
                echo "<script type='text/javascript'> alert('Alteração realizada com sucesso!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
            }
            else
            {
                echo "<script type='text/javascript'> alert('Erro na alteração!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alteracao_da_senha.php'>";
            }
        }
        else
        {
            echo "<script type='text/javascript'> alert('Erro na senha!')</script>";                 
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=alteracao_da_senha.php'>";
        }      
     ?>
</body>
 </html>