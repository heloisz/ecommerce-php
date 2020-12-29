<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto ALICE</title>
    </head>

    <body>
        <?php
            include "conexao.php";

            $nome = $_POST["nome"];
            $nome_invocador = $_POST["invNome"];
            $email = $_POST["email"];
            $senha = $_POST["senha_cadastro"];
            $lane = $_POST["lane"];
            $main = $_POST["main"];

            $sql = "UPDATE usuario SET nome = '$nome', senha = '$senha', lane = '$lane', main = '$main'
            WHERE nome_de_invocador = '$nome_invocador';";

            $resultado = pg_query($conecta,$sql);

            $linhas= pg_affected_rows($resultado);

            if ($linhas > 0)
            {
                echo "<script type='text/javascript'>alert('Dados de $nome_invocador atualizados com sucesso!!')</script>";
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('ERRO ao atualizar!!')</script>";
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=usuario_altera.php'>";
            }

            pg_close($conecta);
        ?>
    </body>
</html>