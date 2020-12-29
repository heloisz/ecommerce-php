<?php 
/*Histórico
Heloísa - 06/08/2020 - 19H30MIN
Luís - 09/09/2020 - 18H30MIN
Leandro - 09/09/2020 - 19H30MIN
Luís - 09/09/2020 - 21H14MIN
Heloísa - 10/09/2020 - 01H40MIN
Heloísa - 10/09/2020 - 10H56MIN
Luís - 17/09/2020 - 16H21MIN
Luís - 22/09/2020 - 18H34MIN
*/ 
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <a name="topo"></a> <!------------------ TOPO LINK ----------------------------->
    <div class="mae">
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
                    <a class="links_header" href="index.php" ><label style="font-weight: 900; color: darkslategrey;">HOME</label></a>
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
                
                <div align=center>
                    <img class="principal_home" src="imagens/imagem_principal_home.jpg" alt="Imagem Principal">
                    <br><br>
                    <font size=7><b>MAIS SOBRE OS PRODUTOS</b></font><br>
                    <font size=5><b>CLIQUE NAS IMAGENS PARA SABER MAIS</b></font><br><br>
                </div>
                <!------------------ IMAGENS PEQUENAS ------------------------>
                <div class="imagens_pequenas_home">
                     <div class="container1">
                         <img src="imagens/metodo.png" alt="metodo" class="imagens_pequenas_home">
                        <a href="sobre_silkscreen.php"><!----- destino: ------->
                           <div class="overlay">
                               <div class="text">
                                   <label style="font-size: 30px">TODAS</label><br>
                                   <label style="font-size: 12px">AS NOSSAS CAMISETAS</label>
                                   <br>
                                   <label style="font-size: 12px">SÃO FEITAS COM TECNOLOGIA</label>
                                   <br>
                                   <label style="font-size: 25px">SILK SCREEN</label>
                               </div>
                          </div>
                        </a>
                    </div>
                    &nbsp;&nbsp;
                    <div class="container2">
                        <img src="imagens/tecido.png" alt="metodo" class="imagens_pequenas_home2">
                        <a href="sobre_tecido.php"><!----- destino: ------->
                           <div class="overlay2">
                               <div class="text2">
                                   <label style="font-size: 50px">TECIDOS</label><br>
                                   <label style="font-size: 25px">100% ALGODÃO</label>
                                </div>
                           </div> 
                        </a>
                    </div>
                    &nbsp;&nbsp;
                    <div class="container1">
                        <img src="imagens/canecas.png" alt="metodo" class="imagens_pequenas_home">
                        <a href="sobre_canecas.php"><!----- destino: ------->
                           <div class="overlay" id="overlay3">
                               <div class="text">
                                   <label style="font-size: 30px">DIVERSOS</label><br>
                                   <label style="font-size: 15px">TIPOS DE</label><br>
                                   <label style="font-size: 30px">CANECAS</label>
                                   <br>
                               </div><!-- final text -->
                           </div><!-- final overlay -->
                       </a>
                        
                    </div><!-- final container1 -->
                </div> <!-------- FIM: imagens_pequenas_home --------> 
                
                <div id=video_home align="center">
                    <br><font size=5><b>MÉTODO DE ESTAMPARIA</b></font><br><br>
                    <font size=4>VEJA O VÍDEO E CONHEÇA UM POUQUINHO DA NOSSA PRODUÇÃO</font><br><br>
                    <iframe width="820" height="461" src="https://www.youtube.com/embed/Gn9lZu_BWAU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br><br><br>
                </div>
                <br><br>
               <div align="center"><a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a></div><br>
               
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
               
    </div> <!-- final mae -->
 <!----------------------------------------------- SESSION ----------------------------------------->

	
</body>
</html>
