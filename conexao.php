<?php
	//Histórico de modificações
    //14/09/2020 - Luís Fernando - 14h55min

	$conecta = pg_connect("host=localhost port=5432 dbname=b20leandrobrasil 
							user=b20leandrobrasil password=lagb210103"); 
	if (!$conecta)
	{
		echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
		exit;
	}
?>
