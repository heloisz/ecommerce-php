<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
<meta charset="utf-8" />
<title>Cadastro final</title>
		
	
		
    </head>
    
<body>        
	
	
	 <a href="cadastro.html" >   Home  </a>               <br>
	<hr>
	
	
    <?php
	    include "conect.php";
            
	    $nome=$_POST['nome']." ".$_POST['sobrenome'];
            $sobrenome=$_POST['sobrenome'];
	    $data_nascimento=$_POST['data_nascimento'];
	    $rua=$_POST['rua'];
	    $numero=$_POST['numero'];
	    $bairro=$_POST['bairro'];
	    $cidade=$_POST['cidade'];
	    $estado=$_POST['estado'];
	    $endereco= $_POST['rua'].", ".$_POST['numero']." ".$_POST['bairro'].", ".$_POST['cidade']." - ".$_POST['estado'];
	
	    echo $endereco;
            $mail=$_POST['mail'];
            $senha=$_POST['senha'];
            $genero=$_POST['genero'];
            $sql="INSERT INTO cliente VALUES(DEFAULT, '$nome', '$data_nascimento', '$endereco', '$mail', '$senha', '$genero', 1, NULL)";
            echo $sql;
	    $resultado=pg_query($conecta,$sql);
            $linhas=pg_affected_rows($resultado);

            /*
	    if ($linhas > 0 )
                echo "Produto gravado !!!<br><br>";
            else
                echo "Erro na gravação do produto !!!<br><br>";
            */

	    pg_close($conecta);

	    if($_POST && $linhas > 0) 
	    {
        	$senha         = $_POST['senha'];
        	$confirma_senha  = $_POST['confirma_senha'];
        	if ($senha == $confirma_senha) 
		{
            		echo "<script type='text/javascript'> alert('Cadastro gravado com sucesso!!')</script>";  
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.html'>";
        	} 
	    	else if($senha != $confirma_senha)
		{
            		echo "<script type='text/javascript'> alert('Senhas não conferem!!')</script>";                 
	    		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastro.html'>";
        	}
	     } 
	     else
	     {
		echo "<script type='text/javascript'> alert('Erro no cadastro!!')</script>";                 
	    	echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.html'>";
	     }
                
     ?>
     
</body>
</html>