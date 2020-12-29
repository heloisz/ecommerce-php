<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Alterar Cadastro</title>
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
</head> 
<body>
	<hr>
    <?php
	include "conexao.php";
        session_start();
    
	$nome=$_POST['nome'];
	$endereco=$_POST['endereco'];
        $mail=$_POST['mail'];
        $senha=$_POST['senha'];
        $senhacrip = md5($senha);
	$confirma_senha = $_POST['confirma_senha'];
	$confirma_senhacrip = md5($confirma_senha);
        $genero=$_POST['genero'];
	$idcliente=$_SESSION['idcliente'];
		
	/* ===== SQL SEM SENHA ===== */

	$sqlc_email = "SELECT * FROM cliente WHERE email = '$mail'";
        $resu = pg_query($conecta,$sqlc_email);
        $l = pg_affected_rows($resu);
    
        $sqla_email = "SELECT * FROM administrador WHERE email = '$mail'";
        $resul = pg_query($conecta,$sqla_email);
        $li = pg_affected_rows($resu);
    
        if($l>0)
        {
            echo "<script type='text/javascript'> alert('Email já cadastrado!')</script>";                 
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=dados.php'>";
        }

        else if (li>0)
        {
            echo "<script type='text/javascript'> alert('Email já cadastrado!')</script>";                 
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=dados.php'>";
        }
    
        else
	{
		if ($senha == "" && $confirma_senha == ""){
        	$sql="UPDATE cliente
		      SET nome = '$nome', email = '$mail', sexo = '$genero', endereco = '$endereco'
		      WHERE idcliente = $idcliente";}
		/* ===== SQL COM SENHA ===== */
		else
		if ($senha != NULL && $confirma_senha != NULL){
        	$sql="UPDATE cliente
		      SET nome = '$nome', email = '$mail', sexo = '$genero', endereco = '$endereco', senha = '$senhacrip'
		      WHERE idcliente = $idcliente";}
	
		$resultado=pg_query($conecta,$sql);
	        $linhas=pg_affected_rows($resultado);
	    
		    if($_POST && $linhas > 0)
		    {
	            	if ($senhacrip == $confirma_senhacrip)
		            	{		
				$_SESSION['mail'] = $mail;
        	        	$_SESSION['nome'] = $nome;
		    		$_SESSION['sexo'] = $genero;
		    		$_SESSION['senha'] = $senha;
		    		$_SESSION['endereco'] = $endereco;
        	        
					echo "<script type='text/javascript'> alert('Cadastro alterado com sucesso!')</script>";
					header("Refresh: 0; url=area_usuario.php");
			        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=area_usuario.php'>";
 	
 	           	}
 	           	else if($senhacrip != $confirma_senhacrip)
 	           	{
 	               echo "<script type='text/javascript'> alert('Senhas não conferem!')</script>";                
 	               echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=dados.php'>";
 	           	}
		   }
		   else
		   {                
	           	echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=dados.php'>";
		   }
	}
    ?> 
</body>
</html>