<!--
Histórico
Heloísa - 14/09/2020 - 16H42MIN
Luís - 17/09/2020 - 18H55MIN
Luís - 22/09/2020 - 18H43MIN
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <title>Developers</title>
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
                    <a class="links_header" href="developers.php" ><label style="font-weight: 900; color: darkslategrey;">DEVELOPERS</label></a>
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
        <h1 align=center style="color: #333">DEVELOPERS</h1>
        <h1 class="text_sobre">O que é a Styl?</h1>
           <p class="text_sobre" style="text-align: justify">A Styl é uma empresa de vendas on-line de canecas e camisetas cujo objetivo é oferecer os melhores produtos dentro do mercado para seu conforto e estilo. Nossas camisetas são feitas 100% de algodão, ajudando na respiração da pele através de suas malhas que permitem a passagem de ar entre suas fibras, que possuem especificidades para manter sua pele fresca e seca durante todo o verão. Já as nossas canecas são personalizadas e únicas, feitas e pensadas especialmente para você.</p>
        <h1 class="text_sobre">Conheça os desenvolvedores</h1>
        <div class="content_dev">
            <div class="card-wrapper">
                <div class="card">
                    <div class="dev_foto">
                        <img class="dev_foto" src="imagens/dev/heloisa.jpg" alt="profile one">
                    </div>
                    <div class="info_dev">
                        <h2 class="nome_dev">Heloísa Gutierrez
                            <br>
                            <span class="num_turma_dev">16 - 7282B</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card">
                    <div class="dev_foto">
                        <img class="dev_foto" src="imagens/dev/joao.jpg" alt="profile one">
                    </div>
                    <div class="info_dev">
                        <h2 class="nome_dev">João Inácio Piton
                            <br>
                            <span class="num_turma_dev">18 - 7282B</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card">
                    <div class="dev_foto">
                        <img class="dev_foto" src="imagens/dev/leandro.jpg" alt="profile one">
                    </div>
                    <div class="info_dev">
                        <h2 class="nome_dev">Leandro Augusto Brasil
                            <br>
                            <span class="num_turma_dev">20 - 7282B</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card">
                    <div class="dev_foto">
                        <img class="dev_foto" src="imagens/dev/leonardo.jpg" alt="profile one">
                    </div>
                    <div class="info_dev">
                        <h2 class="nome_dev">Leonardo Garcia
                            <br>
                            <span class="num_turma_dev">23 - 7282B</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card">
                    <div class="dev_foto">
                        <img class="dev_foto" src="imagens/dev/luis.jpg" alt="profile one">
                    </div>
                    <div class="info_dev">
                        <h2 class="nome_dev">Luís Fernando de Oliveira
                            <br>
                            <span class="num_turma_dev">27 - 7282B</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card">
                <div class="dev_foto">
                        <img class="dev_foto" src="imagens/dev/rafael.jpg" alt="profile one">
                    </div>
                    <div class="info_dev">
                        <h2 class="nome_dev">Rafael Tavares Duarte
                            <br>
                            <span class="num_turma_dev">28 - 7282B</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text_sobre">Docentes que auxiliaram na realização do projeto</h1>
        <p class="text_sobre">Profª Jovita Mercedes Hojas Baenas - Gestão de Negócios I</p>
        <p class="text_sobre">Profº Rodrigo Ferreira de Carvalho - Aplicativos I</p>
        <p class="text_sobre">Profº Vitor José Del Gaudio Simeão - Banco de Dados e PHP</p>
        <br>
          
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
