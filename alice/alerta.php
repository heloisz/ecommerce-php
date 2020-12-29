
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto ALICE</title>
    </head>

    <body bgcolor="#333333">
        <?php
            include "conexao.php";

            $nome = $_POST['nome'];
            $nome_invocador = $_POST['invNome'];
            $email = $_POST['email'];
            $senha = $_POST['senha_cadastro'];
            $lane = $_POST['lane'];
            $main = $_POST['main'];

            echo $lane[0];

            $sql = "INSERT INTO usuario VALUES (DEFAULT, '$nome', '$nome_invocador', '$email', '$senha', '$lane', '$main');";

            $resultado = pg_query($conecta,$sql);

            $linhas= pg_affected_rows($resultado);

            if ($linhas > 0)
            {
                echo "<script type='text/javascript'>alert('Cadastrado com sucesso!!')</script>";
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.html'>";
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