
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

            $nome_invocador = $_SESSION['nick'];
            $email = $_SESSION['email'];

            echo "<script type='text/javascript'>alert('Desconectado de $nome_invocador!! Email: $email')</script>";
            echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=index.html'>";

            session_unset();
            session_destroy();
        ?>
    </body>
</html>