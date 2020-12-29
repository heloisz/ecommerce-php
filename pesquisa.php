<!--
Retirado de Apostila 3 – LPII - Linguagem PHP da Profª Ariane Scarelli.

Modificado e adaptado por Luís Fernando para o projeto de ecommerce da equipe Styl
    Luís - 17/09/2020 - 18h49min
    Luís - 21/09/2020 - 15h25min
    Luís - 22/09/2020 - 18h49min
    Luís - 30/09/2020 - 21h24min
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Resultado da Pesquisa</title>
</head>
<body>
    <a name="topo"></a> <!------------------ TOPO LINK ----------------------------->
    <div class="mae">
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
                            echo "$logado";
                    ?>              <label class="usuario_header">|</label>
                                        <a class="usuario_header" href="sair.php"><label>Sair</label></a>
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
        
        
            <?php
                require "conexao.php";

                $pesquisa = strtolower($_POST["busca"]); //transforma texto em minúsculo
                $sql="SELECT * FROM produto WHERE excluido = 'n' AND lower(nome) LIKE '$pesquisa%' OR lower(nome) LIKE '%$pesquisa%' ORDER BY tamanho";
                $resultado = pg_query($conecta, $sql);
                $qtde = pg_num_rows($resultado);

                if($qtde>0)
		        {
                    echo "<div align=center><h2>Produtos encontrados para ".$_POST["busca"]."</h2></div>";
                    ?>
                    <div class="produto_container" align=center>
                    <?php
                    while($linha = pg_fetch_array($resultado)){
                        ?>
                        <div class="prod_over">
                            <div class="produto">
                               <?php
                                /*------------ IMAGEM --------------*/
                                echo "<img src='imagens/produtos/".$linha['imagem']."' class='img_prod' /> <br/>";
                                /*------------ NOME --------------*/
                                if(!is_null($linha['tamanho']) && $linha['tamanho'] != 'U')
                                {
                                    $tamanho = $linha['tamanho'];
                                }
                                else if(!is_null($linha['tamanho']) && $linha['tamanho'] == 'U')
                                    $tamanho = "Único";
                                echo "<label class='nome_prod'>".$linha['nome']." - ".$tamanho."</label>";
                                /*------------ ESTOQUE --------------*/
                                if($linha['qtd_estoque']>0)
                                    echo "<label class='nome_prod'>Estoque: ".$linha['qtd_estoque']."</label>";
                                else
                                    echo "<label class='nome_prod'>Produto Indisponível</label>";
                                /*------------ PREÇO --------------*/
                                $preco= number_format($linha['preco'], 2, ',', ' ');
                                echo "<label class='prec_prod'>R$ ".$preco."</label>";
                                ?>
                                <div class="overlay_prod">
                                    <?php
                                        echo"<a class='det_prop' href='detalhe_produto.php?idproduto=".$linha['idproduto']."'><div class='det_prod'>Detalhes</div></a>";
                                        /*------------ BOTÃO COMPRAR --------------*/
                                        if($linha['qtd_estoque']>0)
                                            echo "<a class='add_prod' href='carrinho.php?acao=add&idproduto=".$linha['idproduto']."'><div class='add_prod'>ADICIONAR AO CARRINHO</div></a>";
                                    ?>
                                </div> <!------ final div overlay_prod ------>
                            </div>
                        </div>
                        <?php
                    } //-------- final: WHILE -------------
		        }
                else
                    echo "<div align = center><br>Não foi encontrado nenhum produto!</div>";
                    ?>

        </div> <!------ final: produto_content ------------>            
        <br><br>
        <div align="center"><a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a></div><br>
               
        <footer id="footer"> <!--------- RODAPÉ - início ---------->
            <br>
            <a class="links_header" href="index.php">HOME</a>
            <a class="links_header" href="produtos.php">PRODUTOS</a>
            <a class="links_header" href="developers.php">DEVELOPERS</a>
            <?php /* ---------------------------------SESSION------------------------------- */
                session_start();
                if (isset($_SESSION['nome']))
                {
            ?>		<a class="links_header" href="area_usuario.php">ÁREA DO USUÁRIO</a>
            <?php   }	?>
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