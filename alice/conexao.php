<?php
$stringdeconexao = "host=localhost port=5432 dbname=b31sayuridottore user=b31sayuridottore password=sayuri123";

$conecta = pg_connect($stringdeconexao);

if (!$conecta) {   
    exit;
}
?>    
