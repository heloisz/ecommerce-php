<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto ALICE</title>
    </head>

    <body>
        <?php
            session_start();
            include "conexao.php";

            $nick = $_SESSION['nick'];
            $nome_invocador = $_POST["invNome"];

            $sql = "UPDATE usuario SET excluido = 's' WHERE nome_de_invocador = '$nome_invocador';";

            $resultado = pg_query($conecta,$sql);
            $linhas= pg_affected_rows($resultado);

            if ($linhas > 0)
            {
                echo "<script type='text/javascript'>alert('$nome_invocador excluido com sucesso!!')</script>";
                if ($nick == $nome_invocador)
                {
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=index.html'>";
                }
                else {
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
                }
            }
            else
            {
                echo "<script type='text/javascript'>alert('ERRO ao excluir!!')</script>";
                echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=usuario_altera.php'>";
            }

            pg_close($conecta);
        ?>
    </body>
</html>