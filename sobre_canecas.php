 <!--
Histórico
Heloísa - 14/09/2020 - 16H42MIN
Luís - 17/09/2020 - 19h22min
Luís - 22/09/2020 - 18h52min
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <title>Styl</title>
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
                    <img class="carrinho_icone" src="imagens/carrinho_vazio.png">
                </div>
                <br>
                <div class="links_header">
                   <div class="link_header"></div>
                    <a class="links_header" href="index.php" >HOME</a>
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
          
          <div id="video_home" align="center">
           <br>
            <div class="sabermais">
               <h1 class="sabermais">DIVERSOS TIPOS DE CANECAS</h1>
                <p class="sabermais">
                    Muitas estampas legais para você e para a sua família, feitas com sublimação de primeira, garantindo muita durabilidada.
                 </p>
            </div>
              <img class="sabermais" src="imagens/caneca_porcelana.jpg">
              <br><br>
          </div>
          
          
           <footer id="footer"> <!--------- RODAPÉ - início ---------->
               <br>
                <a class="links_header" href="index.php">HOME</a>
                <a class="links_header" href="produtos.php">PRODUTOS</a>
                <a class="links_header" href="developers.php">DEVELOPERS</a>
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