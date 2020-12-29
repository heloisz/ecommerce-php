<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: carrinho
Tabela: produto

Adaptado por Luís Fernando de Oliveira para projeto de ecommerce Styl 
    28/09/2020 - 20h47min
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cont00t-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <title>Produtos</title>
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
                    <a class="links_header" href="index.php" >HOME</a>
                    <a class="links_header" href="produtos.php"><label style="font-weight: 900; color: darkslategrey;">PRODUTOS</label></a>
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
        <div id="espaco"></div><br>
        <form method=post action=resultado_filtro.php>
            <div align = center>
                <div class="select_prod">
                   <label class="select_prod">Categoria</label>
                    <select class="select_prod" name="categoria">
                        <option value = "" selected></option>
                        <option value="camiseta">Camiseta</option>
                        <option value="caneca">Caneca</option>	
                    </select> 
                    <label class="select_prod">Tamanho</label>
                    <select class="select_prod" name="tamanho">
                        <option value = "" selected></option>
                        <option value="pp">PP</option>	
                        <option value="p">P</option>
                        <option value="m">M</option>
                        <option value="g">G</option>
                        <option value="gg">GG</option>
                        <option value="u">Único</option>
                    </select>

                    <label class="select_prod">Preço</label>
                    <select class="select_prod" name="preco">
                        <option value = "" selected></option>
                        <option value="1">R$ 0,00 - R$ 30,00</option>	
                        <option value="2">R$ 31,00 - R$ 60,00</option>
                        <option value="3">R$ 61,00 - R$ 90,00</option>
                    </select>
                    
                    <input class="select_prod" type="submit" value="Enviar">
                    <br><br>
                    <label class="select_prod">Você pode selecionar mais de uma opção ou deixar em branco :)</label>
                </div>
            </div>
        </form>
              
    <!------------------ Resultados Filtros ----------------------------->
       <div align = center><h1>Resultados Encontrados</h1></div>
    
    <div class="produto_container">
        <?php
            require "conexao.php";
        
            $categoria=$_POST['categoria'];
            $tamanho=$_POST['tamanho'];
            $preco=$_POST['preco'];
        
            if($categoria == null && $tamanho == null && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE excluido = 'n' ORDER BY nome ASC";
            }
        
            // --------------------------------------------------------------------------------------------
            else if($categoria == "caneca" && $tamanho == null && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == null && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND excluido = 'n' ORDER BY nome ASC";
            }
            // --------------------------------------------------------------------------------------------
            else if($categoria == null && $tamanho == "pp" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'PP' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "p" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'P' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "m" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'M' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "g" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'G' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "gg" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'GG' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "u" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'U' AND excluido = 'n' ORDER BY nome ASC";
            }
            // --------------------------------------------------------------------------------------------
            if($categoria == null && $tamanho == null && $preco == 1)
            {
                $sql = "SELECT * FROM produto WHERE preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            if($categoria == null && $tamanho == null && $preco == 2)
            {
                $sql = "SELECT * FROM produto WHERE preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            if($categoria == null && $tamanho == null && $preco == 3)
            {
                $sql = "SELECT * FROM produto WHERE preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
        
            // --------------------------------------------------------------------------------------------
            else if($categoria == "caneca" && $tamanho == "pp" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'PP' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "p" && $preco == null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'P' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "m" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'M' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "g" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'G' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "gg" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'GG' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "u" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'U' AND excluido = 'n' ORDER BY nome ASC";
            }        
            // --------------------------------------------------------------------------------------------
            else if($categoria == "camiseta" && $tamanho == "pp" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'PP' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "p" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'P' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "m" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'M' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "g" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'G' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "gg" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'GG' AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "u" && $preco==null)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'U' AND excluido = 'n' ORDER BY nome ASC";
            }
            // --------------------------------------------------------------------------------------------
            else if($categoria == null && $tamanho == "pp" && $preco == 1)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'PP' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "p" && $preco == 1)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'P' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "m" && $preco==1)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'M' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "g" && $preco==1)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'G' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "gg" && $preco==1)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'GG' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "u" && $preco==1)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'U' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }        
            // --------------------------------------------------------------------------------------------
            else if($categoria == null && $tamanho == "pp" && $preco == 2)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'PP' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "p" && $preco == 2)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'P' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "m" && $preco==2)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'M' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "g" && $preco==2)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'G' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "gg" && $preco==2)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'GG' AND preco BETWEEN 31.00 AND 60.00 excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "u" && $preco==2)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'U' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }        
            // --------------------------------------------------------------------------------------------
            else if($categoria == null && $tamanho == "pp" && $preco == 3)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'PP' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "p" && $preco == 3)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'P' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "m" && $preco==3)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'M' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "g" && $preco==3)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'G' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "gg" && $preco==3)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'GG' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == null && $tamanho == "u" && $preco==3)
            {
                $sql = "SELECT * FROM produto WHERE tamanho = 'U' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            // --------------------------------------------------------------------------------------------
            else if($categoria == 'caneca' && $tamanho == null && $preco==1)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == 'caneca' && $tamanho == null && $preco==2)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == 'caneca' && $tamanho == null && $preco==3)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            // --------------------------------------------------------------------------------------------
            else if($categoria == 'camiseta' && $tamanho == null && $preco==1)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == 'camiseta' && $tamanho == null && $preco==2)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == 'camiseta' && $tamanho == null && $preco==3)
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
        
            // --------------------------------------------------------------------------------------------
            else if($categoria == "caneca" && $tamanho == "pp" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'PP' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "pp" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'PP' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "pp" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'PP' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "p" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'P' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "p" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'P' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "p" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'P' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "m" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'M' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "m" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'M' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "m" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'M' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "g" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'G' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "g" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'G' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "g" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'G' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "gg" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'GG' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "gg" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'GG' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "gg" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'GG' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "u" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'U' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "u" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'U' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "caneca" && $tamanho == "u" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Caneca' AND tamanho = 'U' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            // --------------------------------------------------------------------------------------------
            else if($categoria == "camiseta" && $tamanho == "pp" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'PP' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "pp" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'PP' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "pp" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'PP' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "p" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'P' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "p" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'P' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "p" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'P' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "m" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'M' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "m" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'M' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "m" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'M' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "g" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'G' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "g" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'G' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "g" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'G' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "gg" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'GG' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "gg" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'GG' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "gg" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'GG' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "u" && $preco=="1")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'U' AND preco BETWEEN 0.00 AND 30.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "u" && $preco=="2")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'U' AND preco BETWEEN 31.00 AND 60.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            else if($categoria == "camiseta" && $tamanho == "u" && $preco=="3")
            {
                $sql = "SELECT * FROM produto WHERE tipo = 'Camiseta' AND tamanho = 'U' AND preco BETWEEN 61.00 AND 90.00 AND excluido = 'n' ORDER BY nome ASC";
            }
            
            $res = pg_query($conecta, $sql);
            $total = pg_num_rows($res);
        
            // Verifica se $pagina existe, senão deixa na primeira página como padrão
            $pagina = (isset($_GET["pagina"])) ? ($_GET["pagina"]) : 1;
            // Defina aqui a quantidade máxima de registros por página.
            $limite = 12;
            // Gera outra variável, desta vez com o número de páginas que será preciso.
            // O comando ceil() arredonda "para cima" o valor
            $tot_paginas = ceil($total/$limite);
            // O sistema calcula o início da seleção fazendo:
            // (página atual * quantidade por página) - quantidade por página
            $inicio = ($pagina * $limite) - $limite;
            /* seleciona os itens a serem apresentados por página.
            
            Uso de LIMIT e OFFSET */
            $outro_sql = $sql." limit $limite offset $inicio";
            $resultado = pg_query($conecta, $outro_sql);
            $qtde = pg_num_rows($resultado);

            if($qtde>0)
                while($linha = pg_fetch_array($resultado)){
                    ?>
                    <div class="prod_over">
                        <div class="produto">
                           <?php
                            /*------------ IMAGEM --------------*/
                            echo "<img src='imagens/produtos/".$linha['imagem']."' class='img_prod' /> <br/>";
                            /*------------ NOME --------------*/
                            if(!is_null($linha['tamanho']) && $linha['tamanho'] != 'U')
                            {
                                $tamanho = $linha['tamanho'];
                            }
                            else if(!is_null($linha['tamanho']) && $linha['tamanho'] == 'U')
                                $tamanho = "Único";
                            echo "<label class='nome_prod'>".$linha['nome']." - ".$tamanho."</label>";
                            /*------------ ESTOQUE --------------*/
                            if($linha['qtd_estoque']>0)
                                echo "<label class='nome_prod'>Estoque: ".$linha['qtd_estoque']."</label>";
                            else
                                echo "<label class='nome_prod'>Produto Indisponível</label>";
                            /*------------ PREÇO --------------*/
                            $preco= number_format($linha['preco'], 2, ',', ' ');
                            echo "<label class='prec_prod'>R$ ".$preco."</label>";
                            ?>
                            <div class="overlay_prod">
                                <?php
                                echo"<a class='det_prop' href='detalhe_produto.php?idproduto=".$linha['idproduto']."'><div class='det_prod'>Detalhes</div></a>";
                                /*------------ BOTÃO COMPRAR --------------*/
                                if($linha['qtd_estoque']>0)
                                    echo "<a class='add_prod' href='carrinho.php?acao=add&idproduto=".$linha['idproduto']."'><div class='add_prod'>ADICIONAR AO CARRINHO</div></a>";
                                ?>
                            </div> <!------ final div overlay_prod ------>
                        </div>
                        
                    </div>
                    <?php
                } //-------- final: WHILE -------------
                else
                    echo "<br/>Não há produtos disponíveis!";
                ?>
    </div> <!------ final: produto_content ------------>
    <br><div align = center>
        <?php
            for($i = 1; $c < $tot_paginas + 1; $c++) 
            {
                echo "<a class='paginacao' href='resultado_filtro.php?pagina=$c'> ".$c."</a> ";
            }
        ?>
    </div>
    <br>
     <div align="center">
        <a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a>
    </div>
    <br>
    <!------------------ FIM DA LISTAGEM PRODUTOS -----------------------------> 
               
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