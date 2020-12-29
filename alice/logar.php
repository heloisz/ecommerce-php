<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto ALICE</title>
    </head>

    <body>
        <?php
            session_unset();
            session_destroy();
            include "conexao.php";

            $nomeInv = $_POST['invNome'];
            $senha = $_POST['senha'];

            $sql = "SELECT * FROM usuario WHERE nome_de_invocador = '$nomeInv' AND excluido = 'n';";
            $resultado = pg_query($conecta,$sql);
            $qtde = pg_num_rows($resultado);
            $linha = pg_fetch_array($resultado);

            $email = $linha[email];

            session_start();
            $_SESSION['nick'] = $nomeInv;
            $_SESSION['email'] = $email;

            if ($qtde == 0){
                echo "<script type='text/javascript'>alert('ERRO ao logar!! Invocador não encontrado')</script>";
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=usuario_login.html'>";
            }
            else{
                if ($linha[senha] == $senha){
                    echo "<script type='text/javascript'>alert('Logado como $nomeInv!! Email: $email')</script>";
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
                }
                else{
                    echo "<script type='text/javascript'>alert('ERRO ao logar!! Senha incorreta')</script>";
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=usuario_login.html'>";
                }
            }

            pg_close($conecta);
        ?>
    </body>
</html>