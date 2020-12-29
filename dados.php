<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Alterar Dados</title>	
</head>
<body>
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
                    <font face="Arial" size="2">
                    <img class="btn_usu" src="imagens/lapis.png">
                        <h1>SEUS DADOS</h1>
                            <p class="atencao" style="text-align:justify;">Caso você queira alterar algum dado do seu cadastro, basta digitá-lo no campo correspondente e clicar em alterar.<br><br>
                                 Só é necessário preencher os campos que você queira alterar, os demais não serão modificados.</p>
                                <form action= "alterar_cadastro.php" method="post">
                        <?php session_start(); ?>
                                    <!------ NOME ------>
                                    <div class="cadastro">
                                        <input class="imp_cadastro" type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>" placeholder="<?php echo $_SESSION['nome'] ?>" autocomplete="off">
                                        <label>Nome</label>    
                                        <span class="focus-border"></span>
                                    </div>
                                    <!------ EMAIL ------>
                                    <div class="cadastro">
                                        <input class="imp_cadastro" type="email" name="mail" value="<?php echo $_SESSION['mail'] ?>" placeholder="<?php echo $_SESSION['mail'] ?>">
                                        <label>Email</label>
                                        <span class="focus-border"></span>
                                    </div>
                                    <script>
                                    function verifica()
                                    {
                                    senha= document.getElementById("senha").value;
                                        forca=0;
                                        mostra=document.getElementById("mostra");
                                        if((senha.length>=4)&&(senha.length<=7)){
                                            forca += 5;
                                        }else if(senha.length>8){
                                            forca += 30;
                                        }
                                        if(senha.match(/[a-z]+/)){
                                            forca += 10; 
                                        }if(senha.match(/[A-Z]+/)){
                                            forca += 20;
                                        }
                                        if(senha.match(/[!@#$%]+/)){
                                            forca += 20;
                                        }
                                        if(senha.match(/[0-9]+/)){
                                            forca += 25;
                                        }
                                        return mostra_res();
                                    }
                                    function mostra_res(){
                                    if(forca < 30){
                                            mostra.innerHTML = '<tr><td bgcolor="red" width="'+forca+'"></td><td>Fraca </td></tr>';
                                    }else if((forca >= 30) && (forca < 60)){
                                            mostra.innerHTML = '<tr><td bgcolor="yellow" width="'+forca+'"></td><td>Média </td></tr>';;
                                    }else if((forca >= 60) && (forca < 85)){
                                            mostra.innerHTML = '<tr><td bgcolor="blue" width="'+forca+'"></td><td>Forte </td></tr>';
                                    }else if(forca >= 85){
                                            mostra.innerHTML = '<tr><td bgcolor="green" width="'+forca+'"></td><td>Excelente </td></tr>';
                                    }
                                    }                      
                                    </script>
                                    <!------ SENHA ------>
                                    <div class="cadastro">
                                        <table id="mostra"></table>
                                        <input class="imp_cadastro" type="password" name="senha" name="senha" id="senha" onkeyup="javascript:verifica()" minlength="8" maxlength="18" placeholder="">
                                        <label>Nova senha (8-18 caracteres)</label>
                                        <span class="focus-border"></span>
                                    </div>
                                    <div class="cadastro">
                                        <input class="imp_cadastro" type="password" name="confirma_senha" minlength="8" maxlength="18" placeholder="">
                                        <label>Confirma alteração de senha</label>
                                        <span class="focus-border"></span>
                                    </div>
                                    <!------ SEXO ------>
                                    <div class="select_sexo">
                                        <label class="select_sexo">Sexo</label><br>
                                        <select name="genero" class="select_sexo" required>
                                        <option></option>
                                        <?php
                                switch($_SESSION['sexo']){
                                    case "M":
                                        echo '<option value="F">Feminino</option>	
                                                        <option value="M" selected>Masculino</option>
                                                        <option value="O">Outro</option>';
                                        break;
                                    case "F":
                                        echo '<option value="F" selected>Feminino</option>	
                                                        <option value="M">Masculino</option>
                                                        <option value="O">Outro</option>';
                                        break;
                                    case "O":
                                        echo '<option value="F">Feminino</option>	
                                                        <option value="M" selected>Masculino</option>
                                                        <option value="O" selected>Outro</option>';
                                    }
                            ?>
                                        </select>
                                    </div>
                                    <!------ ENDEREÇO  ------>
                                    <div class="cadastro">
                                        <input class="imp_cadastro" type="text" name="endereco" maxlength="150" value="<?php echo $_SESSION['endereco'] ?>" placeholder="<?php echo $_SESSION['endereco'] ?>">
                                        <label>Endereço</label>
                                        <span class="focus-border"></span>
                                    </div>
                                    <!------ SUBMIT ------>
                                    <div class="btn_submit">
                                    <center>
                                        <input class="btn_submit" type="submit" value="Alterar">   
                                    </center>
                                    </div>
                                </form>
                    </font>
                </div>
            </div>
        </div>
    </div>




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
    </font>
</body>
</html>