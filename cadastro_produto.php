<!--
Histórico de Atualizações
    1) Luís - 04/11/2020 - 16h36min
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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Cadastro de Produtos</title>	
</head>
<body>
    <style>
        body{
            background-image: url(imagens/bg_cadastro.jpg);
        }
    </style>
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
            
            <br>
            <div class="links_header">
                <a class="links_header" href="index_adm.php" >HOME</a>
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
    
    <font face="Arial" size="2">
       <div class="cadastro_content">
          <h1 align=center style="color: #333">CADASTRAR PRODUTO</h1>
           <div class="cadastro">
                <form action= "concluir_cadastro_produto.php" method="post" enctype="multipart/form-data">
                    <!------ NOME ------>
                    <div class="cadastro">
                        <input class="imp_cadastro" type="text" name="nome" placeholder=" " autocomplete="off" required>
                        <label>Nome</label>    
                        <span class="focus-border"></span>
                    </div>
                    <!------ TIPO ------>
                    <div class="select_sexo">
                        <label class="select_sexo">Tipo</label><br>
                        <select name="tipo" class="select_sexo" required>
                           <option selected></option>
                            <option value="Camiseta">Camiseta</option>	
                            <option value="Caneca">Caneca</option>
                        </select>
                    </div>
                    <br><br>
                    <!------ TAMANHO ------>
                    <div class="select_sexo">
                        <label class="select_sexo">Tamanho</label><br>
                        <select name="tamanho" class="select_sexo" required>
                           <option selected></option>
                            <option value="PP">PP</option>	
                            <option value="P">P</option>
                            <option value="M">M</option>
                            <option value="G">G</option>
                            <option value="GG">GG</option>
                            <option value="U">Único</option>
                        </select>
                    </div>
                    <!------ QUANTIDADE ESTOQUE ------>
                    <div class="cadastro">
                        <input class="imp_cadastro" type="number" name="qtd_estoque" maxlength="4" placeholder=" " required>
                        <label>Quantidade Estoque</label>
                        <span class="focus-border"></span>
                    </div>
                    <!------ PREÇO ------>
                    <div align = center><p class="atencao">ATENÇÃO! Digitar o preço no modelo dos EUA. Exemplo: 23.50.</p></div>
                    <div class="cadastro">
                        <input class="imp_cadastro" type="text" name="preco" maxlength="40" placeholder=" " required>
                        <label>Preço</label>
                        <span class="focus-border"></span>
                    </div>
                    <!------ IMAGEM ------>
                    <div align = center><p class="atencao">ATENÇÃO! A imagem deve estar nos formatos GIF, JPG, JPEG OU PNG<br>Não deve ter um tamanho maior que 1 MB.<br>E deve ter uma proporção de 10:8.</p></div>
                    <div class="cadastro">
                    <label style="color: #FF9900;">Imagem</label><br><br>
                        <input type="file" name="fileToUpload" id="fileToUpload" placeholder=" " required>
                    </div>
                    <!------ SUBMIT ------>
                    <div class="btn_submit">
                       <center>
                         <input class="btn_submit" type="submit" value="Cadastrar">   
                       </center>
                    </div>
                </form>
            </div>
       </div>
    </font>
    <footer id="footer"> <!--------- RODAPÉ - início ---------->
   <br>
    <a class="links_header" href="index_adm.php" >HOME</a>
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
</body>
</html>