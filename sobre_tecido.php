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
               <h1 class="sabermais">TECIDO 100% ALGODÃO</h1>
                <p class="sabermais">
                    A fibra brasileira é cultivada de forma responsável (75% da produção possui certificação socioambiental), gera empregos, movimenta a economia, contribui para uma moda consciente e muito mais.  
                   <br><br>
                   O algodão é forte, resistente e não precisa ter medo de sujá-lo, ele dura muito tempo e não se desintegra no primeiro desgaste, é mais fácil de lavar e cuidar do que outros tecidos, respira melhor do que os tecidos sintéticos à base de óleo, como o poliéster,  por isso é o material perfeito para vestir quando você está trabalhando. Sem mencionar que o algodão que absorve a umidade é especialmente projetado para mantê-lo mais seco e mais frio durante o exercício.
                 </p>
            </div>
              <img class="sabermais" src="imagens/gif_algodao.gif">
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