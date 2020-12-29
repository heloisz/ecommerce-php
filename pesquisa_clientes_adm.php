<!--
Retirado de Apostila 3 – LPII - Linguagem PHP da Profª Ariane Scarelli.

Modificado e adaptado por Luís Fernando para o projeto de ecommerce da equipe Styl
    Luís - 07/11/2020 - 13h09min
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
                
                $categoria = $_POST["categoria"];
                $pesquisa = strtolower($_POST["busca"]); //transforma texto em minúsculo
                
                if($pesquisa == null)
                {
                    echo "<script type='text/javascript'> alert('Insira algum termo para pesquisar!')</script>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=clientes_adm.php'>";
                }
                else if($categoria == "id")
                {
                    $sql="SELECT DISTINCT * FROM cliente WHERE idcliente = '$pesquisa' ORDER BY idcliente ASC";
                }
                else if($categoria == "nome")
                {
                    $sql="SELECT DISTINCT * FROM cliente WHERE lower(nome) LIKE '$pesquisa%' OR lower(nome) LIKE '%$pesquisa%' ORDER BY nome ASC";
                }
                else if($categoria == "email")
                {
                    $sql="SELECT DISTINCT * FROM cliente WHERE lower(email) LIKE '$pesquisa%' OR lower(email) LIKE '%$pesquisa%' ORDER BY idcliente ASC";
                }
                $resultado = pg_query($conecta, $sql);
                $qtde = pg_num_rows($resultado);

                ?>
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
                if($qtde>0)
		        {
                    echo "<div align=center><h2>Resultados encontrados para ".$_POST["busca"]."</h2></div>";
                    ?>
                    <div class='historico_content'>
                    <?php
                    while($rowID = pg_fetch_array($resultado)){
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
                }
            }
                else
                {
                    echo "<div align=center><h2>Resultados encontrados para ".$_POST["busca"]."</h2></div>";
                    echo "<div align = center><br>Não foi encontrado nenhum resultado!</div>";
                }
                    ?>            
        </table>
        <br>
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