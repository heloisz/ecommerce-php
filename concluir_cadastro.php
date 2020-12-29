<!--
Histórico de Atualizações
    Leandro e Rafael - 14/09/2020 - 18h59min
    Luís - 17/09/2020 - 16h19min 
    Luís - 22/09/2020 - 17h52min
    Luís - 28/09/2020 - 14h23min
    Luís - 29/09/2020 - 13h05min
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
</head> 
<body>
	<hr>
    <?php
	include "conexao.php";
        session_start();
    
	$nome=$_POST['nome']." ".$_POST['sobrenome'];
        $sobrenome=$_POST['sobrenome'];
	$data_nascimento=$_POST['data_nascimento'];
	$rua=$_POST['rua'];
	$numero=$_POST['numero'];
	$bairro=$_POST['bairro'];
	$cidade=$_POST['cidade'];
	$estado=$_POST['estado'];
	$endereco= $_POST['rua'].", ".$_POST['numero']." ".$_POST['bairro'].", ".$_POST['cidade']." - ".$_POST['estado'];
        $mail=$_POST['mail'];
        $senha=$_POST['senha'];
        $senhacrip = md5($senha);
        $genero=$_POST['genero'];
    
        $outrosql="select nextval('cliente_idcliente_seq') as idcliente;";
        $result = pg_query($conecta,$outrosql);
        $linha = pg_fetch_array($result);
        $idcliente = $linha['idcliente'];
    
        $sql="INSERT INTO cliente VALUES($idcliente, '$nome', '$mail', '$senhacrip', '$data_nascimento', '$genero', '$endereco', DEFAULT, NULL)";
	$resultado=pg_query($conecta,$sql);
        $linhas=pg_affected_rows($resultado);

	    if($_POST && $linhas > 0) 
	    {
        	$senha = $_POST['senha'];
        	$confirma_senha = $_POST['confirma_senha'];
            if ($senha == $confirma_senha)
            {		
                $_SESSION['idcliente'] = $idcliente;
                $_SESSION['mail'] = $mail;
                $_SESSION['senha'] = $senha;
                $_SESSION['nome'] = $nome;
                $_SESSION['sexo'] = $genero;
                $_SESSION['senha'] = $senha;
                $_SESSION['dt_nascimento'] = $data_nascimento;
                $_SESSION['endereco'] = $endereco;
                
                echo "<script type='text/javascript'> alert('Cadastro gravado com sucesso!')</script>";
		        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
 
            }
            else if($senha != $confirma_senha)
            {
                echo "<script type='text/javascript'> alert('Senhas não conferem!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastro.html'>";
            }
	   } 
	   else
	   {
           	unset ($_SESSION['email']);
            unset ($_SESSION['senha']);
            echo "<script type='text/javascript'> alert('Erro no cadastro!')</script>";                 
           	echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastro.html'>";
	   }       
    ?> 
</body>
</html>