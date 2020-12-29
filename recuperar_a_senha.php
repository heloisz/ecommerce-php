<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
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
            </div> <!-- final links_header -->
            <div class="usuario_header">
                <img class="usuario_header" src="imagens/icone_usuario.png">
                <a class="usuario_header" href=""><label>LOGIN</label></a> <!----- destino: ------->
                <label class="usuario_header">|</label>
                <a class="usuario_header" href="cadastro.html"><label>CADASTRO</label></a> <!----- destino: ------->
            </div> <!-- final usuario_header -->
        </div> <!-- final content_header -->
    </div> <!-- final header --><br><br><br><br>
    
    <font size="2">
       <div class="login_content">
         <h1 class="login">RECUPERAR A SENHA</h1>
         <label>Digite seu emal abaixo para recuperar a sua senha.</label>
             <form action= "./recuperar_a_senha_final.php" method="post">
                <div class="login">
                    <input class="imp_cadastro" type="email" name="mail" placeholder=" " required>
                    <label>Email</label>
                    <span class="focus-border"></span>
                </div>
                <div>
                   <center>
                       <input class="btn_submit" type="submit" value="Enviar">
                   </center>
                </div>
            </form>
        </div>
    </font>
        <footer id="footer" style="bottom:0; position:absolute;"> <!--------- RODAPÉ - início ---------->
           <br>
            <a class="links_header" href="index.php">HOME</a>
            <a class="links_header" href="produtos.php">PRODUTOS</a>
            <a class="links_header" href="developers.php">DEVELOPERS</a>
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