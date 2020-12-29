<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Usuário</title>	
</head>
<body>
   <?php
    function data($data){
        return date("d/m/Y", strtotime($data));
    }
    ?>
    <font face="Arial">
    <div class="header">
        <div class="content_header">
            <a href="index.php">
                <img class="header" src="imagens/logo.png" alt="Site Oficial">
            </a>

            <div class="busca_header">
                <form method="post" action="pesquisa.php">
                    <input type="text" name="busca" class="busca" placeholder="O que você procura?"/>
                    <button class="busca_header" type="submit">
                       <img class="buscar_header" src="imagens/icone_buscar.png">
                    </button>
                </form>
            </div> <!-- final busca_header -->

            <div>
                <a href="carrinho.php"><img class="carrinho_icone" src="imagens/carrinho_vazio.png"></a>
            </div>
            <br>
            <div class="links_header">
               <div class="link_header"></div>
                <a class="links_header" href="index.php">HOME</a>
                <a class="links_header" href="produtos.php">PRODUTOS</a>
                <a class="links_header" href="developers.php">DEVELOPERS</a>
		<?php /* ---------------------------------SESSION------------------------------- */
			session_start();
			if (isset($_SESSION['nome']))
			{
		?>		<a class="links_header" href="area_usuario.php">ÁREA DO USUÁRIO</a>
		<?php   }	?>
            </div> <!-- final links_header -->
            <div class="usuario_header">
                <img class="usuario_header" src="imagens/icone_usuario.png">
                <?php /* ---------------------------------SESSION------------------------------- */
				session_start();
				if (isset($_SESSION['nome']))
				{
					$logado = $_SESSION['nome'];
			?>		<a class="usuario_header" href="area_usuario.php"><label><?php echo "$logado"; ?></label></a>
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
    

<!--------------------------------------------------------------------------------------------->
	<?php
		include "conexao.php";
		session_start(); 
              	$n=1;
               $idcliente = $_SESSION['idcliente'];

               $sqlID="SELECT DISTINCT idvenda FROM venda WHERE idcliente = $idcliente ORDER BY idvenda";
               $queryID=pg_query($conecta, $sqlID);
               if(pg_num_rows($queryID)>0)
               {
            ?>
            <div class="area_usu_content">    
                <div class="area_cliente_content">
                    <div class="btn_usu">
                        <ul class="btn_usu">
                            <h1>MINHA CONTA</h1>
                            <li class="btn_usu">
                                <img class="btn_usu" src="imagens/user.png"><a class="link_usu" href="area_usuario.php">perfil</a>
                            </li>
                            <br>
                            <li class="btn_usu">
                                <img class="btn_usu" src="imagens/box.png"><a class="link_usu" href="historico_compras.php">pedidos</a>
                            </li>
                            <br>
                            <li class="btn_usu">
                                <img class="btn_usu" src="imagens/lapis.png"><a class="link_usu" href="alterar_cadastro.php">alterar conta</a>
                            </li>
                            <br><br>
                            <div class="contato_usu">
                                <label class="contato_usu">Algum problema?<br>Fale com a gente!</label><br><br>
                                <label class="contato_usu">Email</label>
                                <p class="contato_usu">company.styl@gmail.com</p>
                                <label class="contato_usu">Whatsapp</label>
                                <p class="contato_usu">(xx)xxxx-xxxx</p>
                            </div>
                        </ul>
                    </div>
                    <div class="area_usu">
                        <div class="historico_content">
                        <img class="btn_usu" src="imagens/box.png"><h1>MINHAS COMPRAS</h1>
                            <?php
                                while($rowID=pg_fetch_array($queryID)) //COMPRA
                            {
                                    $precoTotal = 0;
                                echo $rowID[id_cliente];
                                
                                //agora vamos selecionar os itens comprados
                                $sqlItens="select venda.idcliente, itensvenda.idvenda, produto.nome, produto.preco, produto.tamanho, venda.dt_venda, itensvenda.qtd
                                FROM produto, venda, itensvenda
                                WHERE itensvenda.idvenda = venda.idvenda
                                        AND venda.idvenda = $rowID[idvenda]
                                AND venda.idcliente = $idcliente
                                AND itensvenda.idproduto = produto.idproduto
                                ORDER BY venda.dt_venda";
                    
                                $queryItens=pg_query($conecta, $sqlItens);
                                 
				$sqlData = $sqlItens;
				$queryData=pg_query($conecta, $sqlData);
                $rowData = pg_fetch_array($queryData);
                ?>
            <div class="historico">     
                                    <?php
                /*------------------ ID E DATA DA COMPRA ------------------*/       
                    $data = data($rowData[dt_venda]);
                    echo "Data da Compra: ".$data."</label>"; 
					echo "<br><br>";
                                
                                        while($rowItens=pg_fetch_array($queryItens))
                                    { 

                                        $preco = $rowItens[preco] * $rowItens[qtd];
                                        $precoTotal+=$preco;
                                        /*---------- NOME E TAMANHO ----------*/
                                        echo "<div class='lista_historico'>
                                        <li class='lista_historico'>
                                        <label>".$rowItens[nome]." - ".$rowItens[tamanho]."</label>
                                        </li>";
                                        /*---------- QUANTIDADE E PREÇO ----------*/
                                        $preco = number_format($preco, 2, ',', ' ');
                                        if($rowItens[qtd]==1){
                                            echo "".$rowItens[qtd]." unidade - R$ ".$preco."<br>";
                                        }else{
                                            echo "".$rowItens[qtd]." unidades - R$ ".$preco."<br>";
                                        }
                                        echo "</div><br>";
                                        }
                                            $n++;
                                    $precoTotal = number_format($precoTotal, 2, ',', ' ');
                                    echo "Preço Total da compra: R$ ".$precoTotal;
                                            echo "</div><br><br>";
                                    }
                                    ?>
                                    </div>
                                </div>
                <?php
                }
                else{
                    ?>
                    <div class="area_usu_content">    
                    <div class="area_cliente_content">
                        <div class="btn_usu">
                            <ul class="btn_usu">
                                <h1>MINHA CONTA</h1>
                                <li class="btn_usu">
                                    <img class="btn_usu" src="imagens/user.png"><a class="link_usu" href="area_usuario.php">perfil</a>
                                </li>
                                <br>
                                <li class="btn_usu">
                                    <img class="btn_usu" src="imagens/box.png"><a class="link_usu" href="historico_compras.php">pedidos</a>
                                </li>
                                <br>
                                <li class="btn_usu">
                                    <img class="btn_usu" src="imagens/lapis.png"><a class="link_usu" href="alterar_cadastro.php">alterar conta</a>
                                </li>
                                <br><br>
                                <div class="contato_usu">
                                    <label class="contato_usu">Algum problema?<br>Fale com a gente!</label><br><br>
                                    <label class="contato_usu">Email</label>
                                    <p class="contato_usu">email@email.com</p>
                                    <label class="contato_usu">Whatsapp</label>
                                    <p class="contato_usu">(xx)xxxx-xxxx</p>
                                </div>
                            </ul>
                        </div>
                        <div class="area_usu">
                        <h2>Você ainda não realizou nenhuma compra :(</h2>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>	
                    </div>
                </div>
            </div>

                
<!------------------------------------------------------------------>
    
    </font>
</body>
</html>