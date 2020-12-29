<!--
Histórico de Atualizações
    Rafael - 01/10/2020 - 22h43min
    Luís - 01/10/2020 - 23h52min
    Luís - 05/10/2020 - 15h54min
-->

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Recuperar a senha</title>
</head>
<body>
   <style>
       body{
           background-image: url(imagens/bg_login.jpg);
           background-size: 100%;
       }
    </style>
    <a name="topo"></a> <!------------------ TOPO LINK ----------------------------->
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
                <a class="links_header" href="index.php">HOME</a>
                <a class="links_header" href="produtos.php">PRODUTOS</a>
                <a class="links_header" href="developers.php">DEVELOPERS</a>
                <?php /* ---------------------------------SESSION------------------------------- */
                    session_start();
                    if (isset($_SESSION['nome']))
                    {
                ?>
                <a class="links_header" href="area_usuario.php">ÁREA DO USUÁRIO</a>
                <?php
                    }
                ?>
            </div> <!-- final links_header -->
            <div class="usuario_header">
                <img class="usuario_header" src="imagens/icone_usuario.png">
                <a class="usuario_header" href=""><label>LOGIN</label></a> <!----- destino: ------->
                <label class="usuario_header">|</label>
                <a class="usuario_header" href="cadastro.html"><label>CADASTRO</label></a> <!----- destino: ------->
            </div> <!-- final usuario_header -->
        </div> <!-- final content_header -->
    </div> <!-- final header --><br><br><br><br><br>
    
    <font size="2">
       <div class="login_content">
         <h1 class="login">RECUPERAR A SENHA</h1>
             <form action= "alteracao_da_senha_final.php" method="post">
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
        
                    <div class="cadastro">
                        <table id="mostra"></table>
                        <input class="imp_cadastro" type="password" name="senha" id="senha" onkeyup="javascript:verifica()" minlength="8" maxlength="18" placeholder=" " required>
                        <label>Nova Senha (8-18 caracteres)</label>
                        <span class="focus-border"></span>
                    </div>
                    <div class="cadastro">
                        <input class="imp_cadastro" type="password" name="senha_confirm" minlength="8" maxlength="18" placeholder=" " required>
                        <label>Confirma Nova Senha</label>
                        <span class="focus-border"></span>
                    </div>
                <div>
                   <center>
                       <input class="btn_submit" type="submit" value="Alterar">
                   </center>
                </div>
            </form>
        </div>
    </font>
        <footer id="footer" style="bottom:0;position:absolute;"> <!--------- RODAPÉ - início ---------->
           <br>
            <a class="links_header" href="index.php">HOME</a>
            <a class="links_header" href="produtos.php">PRODUTOS</a>
            <a class="links_header" href="developers.php">DEVELOPERS</a>
            <?php /* ---------------------------------SESSION------------------------------- */
                session_start();
                if (isset($_SESSION['nome']))
                {
            ?>
            <a class="links_header" href="area_usuario.php">ÁREA DO USUÁRIO</a>
            <?php
                }
            ?>
            <br><br>
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