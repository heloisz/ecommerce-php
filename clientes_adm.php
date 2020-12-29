<?php
    session_start();
    if(!isset($_SESSION['nome_adm'])){
     echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
     exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Clientes</title>	
</head>
<body>
   <?php
    function data($data){
        return date("d/m/Y", strtotime($data));
    }
    ?>
    <div class="mae">
    <a name="topo"></a>
    <font face="Arial">
    <div class="header">
        <div class="content_header">
            <a href="index_adm.php">
                <img class="header" src="imagens/logo.png" alt="Site Oficial">
            </a>

            <div class="busca_header">
                <form method="post" action="pesquisa_adm.php">
                    <input type="text" name="busca" class="busca" placeholder="O que você procura?"/>
                    <button class="busca_header" type="submit">
                       <img class="buscar_header" src="imagens/icone_buscar.png">
                    </button>
                </form>
            </div> <!-- final busca_header -->
            
            <br>
            <div class="links_header">
               <div class="link_header"></div>
                    <a class="links_header" href="index_adm.php">HOME</a>
                    <a class="links_header" href="produtos_adm.php">PRODUTOS</a>
                    <a class="links_header" href="clientes_adm.php"><label style="font-weight: 900; color: darkslategrey;">CLIENTES</label></a>
                    <a class="links_header" href="vendas_adm.php">VENDAS</a>
                    <a class="links_header" href="developers_adm.php">DEVELOPERS</a>
            </div> <!-- final links_header -->
            <div class="usuario_header">
                <img class="usuario_header" src="imagens/icone_usuario.png">

                <?php /* ---------------------------------SESSION------------------------------- */
				session_start();
				if (isset($_SESSION['nome_adm']))
				{
					$logado = $_SESSION['nome_adm'];
			?>		<a class="usuario_header"><label><?php echo "$logado"; ?></label></a>
			                <label class="usuario_header">|</label>
                    			<a class="usuario_header" href="sair.php"><label>sair</label></a>
			<?php   }
				else
				{	?>
					<a class="usuario_header" href="login.html"><label>LOGIN</label></a>
                    			<label class="usuario_header">|</label>
                    			<a class="usuario_header" href="cadastro.html"><label>CADASTRO</label></a>
			<?php } ?>

            </div> <!-- final usuario_header -->
        </div> <!-- final content_header -->
    </div> <!-- final header -->
    <div id="espaco"></div>
    



	<h1 style="color: #333">INFORMAÇÕES DOS CLIENTES</h1>
	
	<form method=post action=pesquisa_clientes_adm.php>
        <div align = center>
            <div style="background-color: white;" class="select_prod">
                <select class="select_prod" name="categoria">
                    <option value = "id" selected>ID</option>
                    <option value="nome">Nome</option>	
                    <option value="email">E-mail</option>
                </select> 
                <input style="width:70%;" type="text" name="busca" class="busca" placeholder="selecione o tipo de pesquisa ao lado e digite aqui a sua procura..."/>
                <button class="busca_header" type="submit">
                   <img class="buscar_header" src="imagens/icone_buscar.png">
                </button>
                <br><br>
            </div>
        </div>
    </form>
    <br>
	<form action = cadastro_usuario_adm.php>
       <div class="btn_areausu">
           <center>
             <input class="btn_add_prod" type="submit" value="+ NOVO USUÁRIO">   
           </center>
        </div>
   </form>
   <br>
<!--------------------------------------------------------------------------------------------->
	<?php
		include "conexao.php";
		session_start();
		//DECLARANDO OS ARRAY
		
		$sqlID="SELECT DISTINCT * FROM cliente GROUP BY idcliente ORDER BY idcliente";
        $queryID=pg_query($conecta, $sqlID);
    ?>
    <div class="produto_adm_container">
        <table class="produto_adm"><!--------- CARRINHO DE COMPRAS - início ---------->
            <thead class="produto_adm">
                <tr class="produto_adm">
                    <th class="produto_adm">id</th>
                    <th class="produto_adm">nome</th>
                    <th class="produto_adm">email</th>
                    <th class="produto_adm">nasc.</th>
                    <th class="produto_adm">sexo</th>
                    <th class="produto_adm">endereoço</th>
                    <th class="produto_adm"></th>
                </tr>
            </thead>
            <?php
            if(pg_num_rows($queryID)>0){
            while($rowID=pg_fetch_array($queryID)){
            ?>
            <tbody class="produto_adm">
                <tr>
                    <td class="produto_adm"> <!-- ID DO CLIENTE -->
                        <?php
                            echo "<label class='nome_prod'>".$rowID[idcliente]."</label>";
                            $idcliente_adm = $rowID[idcliente];
                            $_SESSION['idcliente_adm'] = $idcliente_adm;
                        ?>
                    </td>
                    <td class="produto_adm"><!-- NOME DO CLIENTE -->
                        <?php
                            echo "<label class='nome_prod'>".$rowID[nome]."</label>";
                            $nome_adm = $rowID[nome];
                            $_SESSION['nome_adm'] = $nome_adm;
                        ?>
                    </td>
                    <td class="produto_adm"> <!-- EMAIL DO CLIENTE -->
                        <?php
                            echo "<div class='lista_historico'>
                            <li class='lista_historico'>
                            <label class='nome_prod'>".$rowID[email]."</label></li>";
                            $email_adm = $rowID[email];
                            $_SESSION['email_adm'] = $email_adm;

                        ?>
                    </td>
                    <td class="produto_adm"> <!-- DATA DE NASCIMENTO -->
                        <?php
                            echo "<label class='nome_prod'>".data($rowID[dt_nascimento])."</label>";
                            $data_adm = $rowID[dt_nascimento];
                            $_SESSION['data_adm'] = $data_adm;
                        ?>
                    </td>
                    <td class="produto_adm"> <!-- SEXO DO CLIENTE -->
                        <?php
                            echo "<label class='nome_prod'>".$rowID[sexo]."</label>";
                            $sexo_adm = $rowID[sexo];
                            $_SESSION['sexo_adm'] = $sexo_adm;
                        ?>
                    </td>
                    <td class="produto_adm"> <!-- ENDEREÇO DO CLIENTE-->
                        <?php
                            echo "<label class='nome_prod'>".$rowID[endereco]."</label>";
                            $endereco_adm = $rowID[endereco];
                            $_SESSION['endereco_adm'] = $endereco_adm;
                        ?>
                    </td>
                    <td class="produto_adm"> <!-- BOTÕES -->
                        <button class="prod_btn_adm">
                            <!-- LINK PARA ALTERAÇÃO DO CLIENTE -->
                            EDITAR
                        </button>
                        <br><br>
                        <button class="prod_btn_adm">
                            <!-- LINK PARA EXCLUSÃO DO CLIENTE -->
                            EXCLUIR
                        </button>
                    </td>
                </tr>
            </tbody>
            <?php
            } //-------- final: WHILE -------------
        }
            else{
                echo "<br/>Não há produtos disponíveis!";
            }
            ?>
        </table>
    </div>

    <div align="center"><a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a></div><br>
<!------------------------------------------------------------------>

    <footer id="footer"> <!--------- RODAPÉ - início ---------->
        <br>
        <a class="links_header" href="index_adm.php">HOME</a>
        <a class="links_header" href="produtos_adm.php">PRODUTOS</a>
        <a class="links_header" href="clientes_adm.php">CLIENTES</a>
        <a class="links_header" href="vendas_adm.php">VENDAS</a>
        <a class="links_header" href="developers_adm.php">DEVELOPERS</a>
        <br><br><br>
        <label class="footer">16 - Heloísa</label>
        <label class="footer">18 - João</label>
        <label class="footer">20 - Leandro</label>
        <br>
        <label class="footer">23 - Leonardo</label>
        <label class="footer">27 - Luís</label>
        <label class="footer">28 - Rafael</label>
        <br><br><br>
    </footer><!--------- RODAPÉ - fim ---------->
    </font>
    </div>
</body>
</html>