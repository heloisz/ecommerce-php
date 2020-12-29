<?php
$conecta = pg_connect("host=localhost port=5432 dbname=b28rafaelduarte user=b28rafaelduarte password=01042020");
    if (!$conecta)
    {
        echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
    }
else
echo "Conexão estabelecida com o banco de dados!<br><br>";

?>