<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styl</title>
</head>
<body>
    <style>
        body{
            background-color: white;
            font-family: "Arial";
            :focus{outline: none;}
        }

        .mae{
            width: 1300px;
            margin-left: auto;
            margin-right: auto;
        }

        p{
            margin-top: 0px;
            margin-left: 15px;
            margin-right: 15px;
        }

        div.header{
            position: absolute;
            border: solid 1px gray;
            top: 0;
            left: 0;
            width: 100%;
            height:  120px;
            z-index: 3;
            background-color: #ffffff;
        }

        div.content_header{
            width: 90%;
            height: inherit;
            margin-left: auto;
            margin-right: auto;
        }

        div.content1_header{
            display: flex;
        }

        #espaco{
            position: static;
            height: 120px;
        }

        img.header{
        width: 100%;
        
        }

        a.logo{
            padding-right: 20px;
            padding-top: 10px;
            width: 15%;
        }

        #busca_header{
        margin-top: 1.5%;
        margin-left: 5px;
        vertical-align: middle;
        }

        div.links_header{
        left: auto;
        margin-left: 15%;
        width: 50%;
        }

        a.links_header{
            position: relative;
        text-decoration-line: none;
        font-family: "Monaco", monospace;
        font-size: 2em;
        color: #999999;
        padding: 2%;
        padding-top: 30px;
        letter-spacing: 5px;
        font-size: 80%;
        }
        a.links_header:hover{
        color:  #666666;
        }

        links{
            margin-top: 20px;
        }

        div.busca_header:hover{
        transition-duration: .3s;
        border-bottom: solid 4px #660099;
        border-left: solid 4px #FF9900;
        }


        div.busca_header:focus-within{
        border-bottom: solid 4px #660099;
        border-left: solid 4px #FF9900;
        }


        input[type=text].busca{
        border: none;
        font-size: 1rem;
        width: 90%;
        height: 1.3rem;
        }

        input, div, button{
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
        }

        button.busca_header{
        background-color: transparent;
        width: 40px;
        height: 30px;
        margin-top: 9px;
        margin-right: 0px;
        border: none;
        cursor: pointer;
        }

        .usuario_header{
            text-decoration-line: none;
            font-size: 2em;
            color: #999999;
            font-size: 12px;
            margin-top: 3.5%;
            cursor: pointer;
        }

        a.usuario_header:hover{
        color:  #666666;
        }

        img.buscar_header{
        width: 100%;
        height: 100%;
        }
        img.carrinho_icone{
            margin-top: 10px;
            margin-left: 20px;
            width: 50%;
        }

        .busca_header{
        padding-left: 10px;
        width: 60%;
        height: 50px;
        margin-top: 1%;
        transition-duration: .3s;
        border: solid 1px #cccccc;
        }
    </style>
<div class="mae">
    <div class="header">
        <div class="content_header">
            <div class="content1_header">
                <!------------ LOGO ------------>
                <a href="index.php" class="logo">
                    <img class="header" src="imagens/logo.png" alt="Site Oficial">
                </a>
                <!------------ BUSCA HEADER ------------>
                <div class="busca_header">
                    <form method="post" action="pesquisa.php">
                        <input type="text" name="busca" class="busca" placeholder="O que você procura?"/>
                        <button class="busca_header" type="submit">
                           <img class="buscar_header" src="imagens/icone_buscar.png">
                        </button>
                    </form>
                </div> <!-- final busca_header -->
                <!------------ ICONE CARRINHO ------------>
                <a href="carrinho.php" class="carrinho_icone">
                    <img class="carrinho_icone" src="imagens/carrinho_cheio.png">
                </a>	
                <!------------ SESSION ------------>
                <div class="usuario_header">
                        <?php
                            if (isset($_SESSION['nome']))
                            {
                                $logado = $_SESSION['nome']; ?>

                                $partes = explode(' ', $logado);
                                $somente_nome = array_shift($partes);
                                    <a class="usuario_header" href="area_usuario.php"><?php echo "$somente_nome"; ?></a>
                                    <label class="usuario_header">|</label>
                                    <a class="usuario_header" href="sair.php">sair</a><?php
                        }
                            else
                            {	?>
                                    <a class="usuario_header" href="login.html">LOGIN</a>
                                    <label class="usuario_header">|</label>
                                    <a class="usuario_header" href="cadastro.html">CADASTRO</a>
                    <?php   } ?>
                </div>
                
            </div>
            <div class="links">
                <?php 
                if (isset($_SESSION['nome']))
                {
                    ?>
                    <a class="links_header" href="index.php" ><label style="font-weight: 900; color: darkslategrey;">HOME</label></a>
                    <a class="links_header" href="produtos.php">PRODUTOS</a>
                    <a class="links_header" href="developers.php">DEVELOPERS</a>
                    <a class="links_header" href="area_usuario.php">ÁREA DO USUÁRIO</a><?php
                }	
                else
                {
                    ?>
                    <a class="links_header" href="index.php" ><label style="font-weight: 900; color: darkslategrey;">HOME</label></a>
                    <a class="links_header" href="produtos.php">PRODUTOS</a>
                    <a class="links_header" href="developers.php">DEVELOPERS</a><?php
                }
                ?>
            </div>
    </div>
</div>
</body>
</html>