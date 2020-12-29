<?php
/*Histórico de Atualizações
    1) Luís - 04/11/2020 - 16h35min
*/
?>
<?php
    session_start();
    if(!isset($_SESSION['nome_adm'])){
     echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
     exit;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cont00t-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Produtos</title>
</head>

<body>
    <a name="topo"></a> <!------------------ TOPO LINK ----------------------------->
    <div class="mae">
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
                    <a class="links_header" href="produtos_adm.php"><label style="font-weight: 900; color: darkslategrey;">PRODUTOS</label></a>
                    <a class="links_header" href="clientes_adm.php">CLIENTES</a>
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

        <h1 style="color: rgb(132, 132, 132)">GERENCIAMENTO DE PRODUTOS</h1>
        <form method=post action=resultado_filtro_adm.php>
            <div>
                <div align=center class="select_prod">
                   <label class="select_prod">Categoria</label>
                    <select class="select_prod" name="categoria">
                        <option value = "" selected></option>
                        <option value="caneca">Caneca</option>	
                        <option value="camiseta">Camiseta</option>
                    </select> 
                    <label class="select_prod">Tamanho</label>
                    <select class="select_prod" name="tamanho">
                        <option value = "" selected></option>
                        <option value="pp">PP</option>	
                        <option value="p">P</option>
                        <option value="m">M</option>
                        <option value="g">G</option>
                        <option value="gg">GG</option>
                        <option value="u">Único</option>
                    </select>

                    <label class="select_prod">Preço</label>
                    <select class="select_prod" name="preco">
                        <option value = "" selected></option>
                        <option value="1">R$ 0,00 - R$ 30,00</option>	
                        <option value="2">R$ 31,00 - R$ 60,00</option>
                        <option value="3">R$ 61,00 - R$ 90,00</option>
                    </select>
                    
                    <input class="select_prod" type="submit" value="Enviar">
                    <br>
                </div>
            </div>
        </form>
        <br>
        <p>Encontre aqui todos os produtos de sua loja! Filtre-os para um resultado mais preciso!</p>
        <form action = cadastro_produto.php>
           <div align=right class="btn_areausu">
                 <input class="btn_add_prod" type="submit" value="+ NOVO PRODUTO">
            </div>
       </form>
       <br>
       
    <!------------------ LISTAGEM PRODUTOS ----------------------------->
    <div class="produto_adm_container">
        <?php
            require "conexao.php";
        
            $sql_contagem = "SELECT * FROM produto  ORDER BY nome ASC";
            $res = pg_query($conecta, $sql_contagem);
            $total = pg_num_rows($res);
        
            // Verifica se $pagina existe, senão deixa na primeira página como padrão
            $pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
            // Defina aqui a quantidade máxima de registros por página.
            $limite = 12;
            // Gera outra variável, desta vez com o número de páginas que será preciso.
            // O comando ceil() arredonda "para cima" o valor
            $tot_paginas = ceil($total/$limite);
            // O sistema calcula o início da seleção fazendo:
            // (página atual * quantidade por página) - quantidade por página
            $inicio = ($pagina * $limite) - $limite;
            /* seleciona os itens a serem apresentados por página.
            
            Uso de LIMIT e OFFSET */
            $sql = "SELECT * FROM produto  ORDER BY tamanho ASC limit $limite offset $inicio";
            $resultado = pg_query($conecta, $sql);
            $qtde = pg_num_rows($resultado);
        ?>
            <table class="produto_adm"><!--------- CARRINHO DE COMPRAS - início ---------->
                <thead class="produto_adm">
                    <tr class="produto_adm">
                        <th class="produto_adm" id="prod_adm_img">produto</th>
                        <th class="produto_adm" id="prod_nome_adm"></th>
                        <th class="produto_adm" id="prod_preco_adm">preço</th>
                        <th class="produto_adm" id="prod_estoque_adm">estoque</th>
                        <th class="produto_adm" id="prod_cat_adm">categoria</th>
                        <th class="produto_adm" id="prod_btn_adm"></th>
                    </tr>
                </thead>
                <?php
                if($qtde>0)
                {
                    while($linha = pg_fetch_array($resultado)){
                    ?>
                    <tbody class="produto_adm">
                        <tr>
                            <td class="nome_prod"> <!-- CÓDIGO PRA APARECER A IMAGEM -->
                                <?php 
                                echo "<img src='imagens/produtos/".$linha["imagem"]."' class='produto_adm'>";
                                ?>
                            </td>
                            <td class="nome_prod"><!-- NOME E TAMANHO DO PRODUTO -->
                                <?php 
                                if(!is_null($linha['tamanho']) && $linha['tamanho'] != 'U')
                                {
                                    $tamanho = $linha['tamanho'];
                                }
                                else if(!is_null($linha['tamanho']) && $linha['tamanho'] == 'U')
                                    $tamanho = "Único";
                                echo "<label class='nome_prod'>".$linha['nome']." - ".$tamanho."</label>";
                                ?>
                            </td>
                            <td class="produto_adm"> <!-- PREÇO DO PRODUTO -->
                                <?php
                                $preco= number_format($linha['preco'], 2, ',', ' ');
                                echo "<label class='prec_prod'>R$ ".$preco."</label>";
                                ?>
                            </td>
                            <td class="produto_adm"> <!-- ESTOQUE DO PRODUTO -->
                            <?php
                            if($linha['qtd_estoque']>1)
                                echo "<label class='nome_prod'>".$linha['qtd_estoque']." unidades</label>";
                            else if($linha['qtd_estoque']=1)
                                echo "<label class='nome_prod'>".$linha['qtd_estoque']." unidade</label>";
                            else
                                echo "<label class='nome_prod'>Sem estoque.</label>";
                            ?>
                            </td>
                            <td class="produto_adm">
                               <?php
                                echo "<label class='nome_prod'>".$linha['tipo']."</label>";
                                ?>
                            </td>
                            <td class="produto_adm">
                                <?php echo "<a href=dados_produto_adm.php?idproduto=".$linha['idproduto'].">
                                    <button class='prod_btn_adm'>
                                        EDITAR
                                    </button>
                                </a>"; ?>
                                <br><br>
                                    <!-- LINK PARA ALTERAÇÃO DO PRODUTO -->
                                    <?php
                                    $excluido = $linha['excluido'];
                                    if($excluido == 'n')
                                    {
                                     echo "<a href=exlusao_produtos_adm.php?idproduto=".$linha['idproduto'].">
                                     <button class='prod_btn_adm'>
                                        EXCLUIR
                                      </button>
                                     </a>"; 
                                     }
                                     if($excluido == 's')
                                    {
                                     echo "<a href=exlusao_produtos_adm.php?idproduto=".$linha['idproduto'].">
                                     <button class='prod_btn_adm'>
                                        REATIVAR
                                      </button>
                                     </a>"; 
                                     }

                                ?>
                                 <!-- LINK PARA EXCLUSÃO DO PRODUTO -->
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    } //-------- final: WHILE -------------    
                } // final IF
                else{
                    echo "<br/>Não há produtos disponíveis!";
                }
                ?>
            </table>
    </div> <!------ final: produto_content ------------>
    <br>
    <div align=center>
        <?php
            for($i = 1; $i < $tot_paginas + 1; $i++) 
            {
                echo "<a class='paginacao' href='produtos_adm.php?pagina=$i'> ".$i."</a> ";
            }
        ?>
    </div>
    <br><br>
     <div align=center>
        <a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a>
    </div>
    <br>
    <!------------------ FIM DA LISTAGEM PRODUTOS -----------------------------> 
               
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
               
        </font> <!-------- FONTE ARIAL - final ------------>
    </div> <!-- final mae -->
</body>
</html>