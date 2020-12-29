<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cont00t-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Detalhes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    * {box-sizing: border-box;}
    </style>
    <script>
    function imageZoom(imgID, resultID) {
      var img, lens, result, cx, cy;
      img = document.getElementById(imgID);
      result = document.getElementById(resultID);
      /*create lens:*/
      lens = document.createElement("DIV");
      lens.setAttribute("class", "img-zoom-lens");
      /*insert lens:*/
      img.parentElement.insertBefore(lens, img);
      /*calculate the ratio between result DIV and lens:*/
      cx = result.offsetWidth / lens.offsetWidth;
      cy = result.offsetHeight / lens.offsetHeight;
      /*set background properties for the result DIV:*/
      result.style.backgroundImage = "url('" + img.src + "')";
      result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
      /*execute a function when someone moves the cursor over the image, or the lens:*/
      lens.addEventListener("mousemove", moveLens);
      img.addEventListener("mousemove", moveLens);
      /*and also for touch screens:*/
      lens.addEventListener("touchmove", moveLens);
      img.addEventListener("touchmove", moveLens);
      function moveLens(e) {
        var pos, x, y;
        /*prevent any other actions that may occur when moving over the image:*/
        e.preventDefault();
        /*get the cursor's x and y positions:*/
        pos = getCursorPos(e);
        /*calculate the position of the lens:*/
        x = pos.x - (lens.offsetWidth / 2);
        y = pos.y - (lens.offsetHeight / 2);
        /*prevent the lens from being positioned outside the image:*/
        if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
        if (x < 0) {x = 0;}
        if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
        if (y < 0) {y = 0;}
        /*set the position of the lens:*/
        lens.style.left = x + "px";
        lens.style.top = y + "px";
        /*display what the lens "sees":*/
        result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
      }
      function getCursorPos(e) {
        var a, x = 0, y = 0;
        e = e || window.event;
        /*get the x and y positions of the image:*/
        a = img.getBoundingClientRect();
        /*calculate the cursor's x and y coordinates, relative to the image:*/
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        /*consider any page scrolling:*/
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return {x : x, y : y};
      }
    }
    </script>
</head>
<body>
    <a name="topo"></a> <!------------------ TOPO LINK ----------------------------->
    <div class="mae">
       <font face="Arial">
       <div class="header">
            <div class="content_header">
                <a href="index.html">
                    <img class="header" src="imagens/logo.png" alt="Site Oficial">
                </a>

                <div class="busca_header">
                    <form method="post" action="consulta.html">
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
                    <a class="links_header" href="index.html">HOME</a>
                    <a class="links_header" href="camiseta">CAMISETAS</a>
                    <a class="links_header" href="caneca">CANECAS</a>
                    <a class="links_header" href="index.html" ><label style="font-weight: 900; color: darkslategrey;">DEVELOPERS</label></a>
                </div> <!-- final links_header -->
                <div class="usuario_header">
                    <img class="usuario_header" src="imagens/icone_usuario.png">
                    <a class="usuario_header" href="login.html"><label>LOGIN</label></a> <!----- destino: ------->
                    <label class="usuario_header">|</label>
                    <a class="usuario_header" href="cadastro.html"><label>CADASTRO</label></a> <!----- destino: ------->
                    
                </div> <!-- final usuario_header -->
            </div> <!-- final content_header -->
        </div> <!-- final header -->
        <div id="espaco"></div><br>
        
        
    <div class="detalhes_container">
        <?php
            require "conexao.php";
            
            $idproduto = $_GET['idproduto'];
        
            $sql = "SELECT * FROM produto WHERE idproduto = $idproduto AND excluido = 'n'";
            $resultado = pg_query($conecta, $sql);
            $qtde = pg_num_rows($resultado);

            if($qtde>0)
                while($linha = pg_fetch_array($resultado)){
                    ?>
                <div class="img-zoom-container" align = center>
                   <?php
                    /*------------ IMAGEM --------------*/
                    //echo "Passe o mouse por cima da foto para dar zoom";
                    echo "<img id='myimage' src='imagens/produtos/".$linha['imagem']."' class='img_det' /> <br/>";
                    ?>
                </div>

                <div class="nome_det">
                    <?php
                    /*------------ NOME --------------*/
                    echo "<h2 class='nome_det'>".$linha['nome']."</h2>";
                    if(!is_null($linha['tamanho']) && $linha['tamanho'] != 'U')
                    {
                        $tamanho = $linha['tamanho'];
                    }
                    else if(!is_null($linha['tamanho']) && $linha['tamanho'] == 'U')
                        $tamanho = "Único";
                    echo "<h3 class='nome_det'>TAMANHO: ".$tamanho."</h3>";
                    ?>
                </div>
                
                <div class="grid_det_3">
                    <div class="bloco_det">
                       <p class="prec_det">Leve por apenas</p>
                        <?php
                        /*------------ PREÇO --------------*/
                        $preco= number_format($linha['preco'], 2, ',', ' ');
                        echo "<p class='prec_det2'>R$ ".$preco."</p>";
                        
                        
                        /*------------ ESTOQUE --------------*/
                        if($linha['qtd_estoque']>0)
                            echo "<p class='estoque_det'>".$linha['qtd_estoque']." restantes</p>";
                        else
                            echo "<p class='estoque_det2'>Produto Esgotado</p>";
                        
                        if($linha['qtd_estoque']>0)
                            echo "<br><br><br><a class='add_prod_det' href='carrinho.php?acao=add&idproduto=".$linha['idproduto']."'>ADICIONAR AO CARRINHO</a>";
                    } //-------- final: WHILE -------------
                        ?>
                    <br><br>
                    <p class="sabermais">Não é este o ítem que você procurava? <br><a href="produtos.php" class="carrinho">voltar para a página produtos.</a></p>
                    </div>
                </div>
                <div id="myresult" class="img-zoom-result">
                    <script>
                        // Initiate zoom effect:
                        imageZoom("myimage", "myresult");
                    </script> 
                </div>

    </div> <!------ final: produto_content ------------>
    <br>
     
    <br>
    <!------------------ FIM DA LISTAGEM PRODUTOS -----------------------------> 
               
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
               
        </font> <!-------- FONTE ARIAL - final ------------>
    </div> <!-- final mae -->
</body>
</html>