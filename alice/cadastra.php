
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

            $nome = $_POST['nome'];
            $nome_invocador = $_POST['invNome'];
            $email = $_POST['email'];
            $senha = $_POST['senha_cadastro'];
            $lane = $_POST['lane'];
            $main = $_POST['main'];
            $excluido = 'n';

            $sql = "INSERT INTO usuario VALUES ('$nome', '$nome_invocador', '$email', '$senha', '$lane', '$main', '$excluido');";

            $resultado = pg_query($conecta,$sql);

            $linhas= pg_affected_rows($resultado);

            session_start();
            $_SESSION['nick'] = $nome_invocador;
            $_SESSION['email'] = $email;

            if ($linhas > 0)
            {
                echo "<script type='text/javascript'>alert('Cadastrado com sucesso!!')</script>";
                if (isset($_SESSION['nick'])){
                    echo "<script type='text/javascript'>alert('Logado como $nome_invocador!! Email: $email')</script>";
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
                }
                else{
                    echo "<script type='text/javascript'>alert('ERRO ao Logar!!')</script>";
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=usuario_login.html'>";
                }
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('ERRO ao cadastrar!!')</script>";
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=usuario_cadastro.html'>";
            }

            pg_close($conecta);
        ?>
    </body>
</html>