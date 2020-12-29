<!--
Retirado de Apostila 3 – LPII - Linguagem PHP da Profª Ariane Scarelli.

Modificado e adaptado por Luís Fernando para o projeto de ecommerce da equipe Styl
    Luís - 17/09/2020 - 18h49min
    Luís - 21/09/2020 - 15h25min
    Luís - 22/09/2020 - 18h49min
    Luís - 30/09/2020 - 21h24min
-->
<?php
    session_start();
    if(!isset($_SESSION['nome_adm'])){
     echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
     exit;
    }
?>
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
                    <?php
                    while($linha = pg_fetch_array($resultado)){
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
                                        <button class="prod_btn_adm">
                                            <!-- LINK PARA ALTERAÇÃO DO PRODUTO -->
                                            EXCLUIR
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
                        <?php
                    } //-------- final: WHILE -------------
		        }
                else
                    echo "<div align = center><br>Não foi encontrado nenhum produto!</div>";
                    ?>
           
        <br><br>
        <div align="center"><a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a></div><br>
               
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