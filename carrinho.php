<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: TesteBD1
Tabela: produto

Adaptado por Luís Fernando de Oliveira para projeto de ecommerce Styl
    14/09/2020 - 15h52min
    16/09/2020 - 20h12min
    22/09/2020 - 14h43min
    01/10/2020 - 20h44min
    05/10/2020 - 15h01min
    
    Heloísa - 
*/
      session_start();
      if(!isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }
       
      //adiciona produto
       
      if(isset($_GET['acao'])){
          
         //ADICIONAR CARRINHO
         if($_GET['acao'] == 'add'){
            $idproduto = intval($_GET['idproduto']); // Código do produto que vem da página produtos.php
            if(!isset($_SESSION['carrinho'][$idproduto]))
            {
               $_SESSION['carrinho'][$idproduto] = 1;
            }
            else
            {
               $_SESSION['carrinho'][$idproduto] += 1;
            }
         }
          
         //REMOVER CARRINHO
         if($_GET['acao'] == 'del'){
            $idproduto = intval($_GET['idproduto']);
            if(isset($_SESSION['carrinho'][$idproduto]))
            {
               unset($_SESSION['carrinho'][$idproduto]);
            }
         }
          
         //ALTERAR QUANTIDADE
         if($_GET['acao'] == 'up'){
            if(is_array($_POST['prod'])){
               foreach($_POST['prod'] as $idproduto => $qtd){
                  $idproduto  = intval($idproduto);
				  //desprezar a parte decimal
                  $qtd = intval($qtd);
                  if(!empty($qtd) && $qtd > 0)
                  {
                     $_SESSION['carrinho'][$idproduto] = $qtd;
                  }
                  else
                  {
                     unset($_SESSION['carrinho'][$idproduto]);
                  }
               }//fim foreach
            }//fim if
         }
       
		 // Modifica a url para remover qualquer uma das ações: add, del ou up, evita que a ação seja processada novamente caso a página seja recarregada
		 header("location:./carrinho.php");
      }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Carrinho de Compras</title>
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
			<?php } ?>                </div> <!-- final usuario_header -->
            </div> <!-- final content_header -->
        </div> <!-- final header -->
        <div id="espaco"></div>
    
        <h1 style="margin-left:8%;">MEU CARRINHO</h1>
        <div class="content_carrinho" align=center>
            <table class="carrinho"><!--------- CARRINHO DE COMPRAS - início ---------->
                <thead class="carrinho">
                    <tr class="carrinho">
                        <th class="carrinho" id="carrinho_prod">Produto</th>
                        <th class="carrinho" id="carrinho_nome"></th>
                        <th class="carrinho" id="carrinho_qtd">qtd.</th>
                        <th class="carrinho" id="carrinho_prec">Preço</th>
                    </tr>
                </thead>
                <form action="?acao=up" method="post">
                    <tfoot>
                        <tr>
                        <!------ LINKS SOBRE O CARRINHO ------>
                        <td  class="carrinho" id="ft_car">
                            <input class="carrinho" type="submit" value="Atualizar">
                            
                        </td>
                        <td></td>
                        <td></td>
                        <td align=center class="carrinho" id="ft_car">
                            <a class="carrinho" id="cont_comp" href="produtos.php">Continuar Comprando</a>
                        </td>
                    </tfoot>

                    <tbody>
                       <?php
                        if(count($_SESSION['carrinho']) == 0){
                            echo '<tr>
                                <td  class="carrinho" colspan="5">Não há produto no carrinho</td>
                            </tr>';
                        }
                        else{
                            require("conexao.php");
                            $total = 0;

                            foreach($_SESSION['carrinho'] as $idproduto => $qtd)
                            { // Início do FOREACH
                                $sql = "SELECT * FROM produto WHERE idproduto=$idproduto AND excluido = 'n' ORDER BY nome";
                                $res = pg_query($conecta, $sql);
                                $regs = pg_num_rows($res);
                                if($regs>0)
                                {
                                    $linha = pg_fetch_array($res);
                                    $_SESSION['estoque'] = $linha['qtd_estoque'];
                                    $nome = $linha['nome'];
                                    $preco = $linha['preco'];
                                    $sub = $preco * $qtd;
                                    $total += $sub;
                                    $preco = number_format($preco, 2, ',', '.');
                                    $sub = number_format($sub, 2, ',', ' ');//formata para padrão brasileiro.
                                }
                                //------------------IMAGEM                            
                                echo '
                                <tr>
                                    <td class="carrinho" align=center>
                                        <img src="imagens/produtos/'.$linha['imagem'].'" class="carrinho">
                                    </td>';
                                
                                //------------------ NOME E TAMANHO
                                if(!is_null($linha['tamanho']) && $linha['tamanho'] != 'U')
                                {
                                    $tamanho = $linha['tamanho'];
                                }
                                else if(!is_null($linha['tamanho']) && $linha['tamanho'] == 'U')
                                {
                                    $tamanho = "Único";
                                }
                                echo '
                                    <td class="carrinho">
                                        <label class="nome_prod">'.$linha['nome'].' - '.$tamanho.'</label>
                                    </td>';
                                //------------------ QUANTIDADE
                                echo '
                                    <td class="carrinho" align=center>
                                        <input type="number" size="3" name="prod['.$idproduto.']" max = "'.$_SESSION['estoque'].'" min= "1" value="'.$qtd.'"/>
                                        </br></br>
                                        <a class="carrinho" href="?acao=del&idproduto='.$idproduto.'">remover</a>
                                    </td>';
                                echo '
                                     <td class="carrinho" align=center>
                                        <label id="preco_carrinho">R$'.$preco.'</label>
                                     </td>
                                </tr>';
                            }// Término do FOREACH
                         }//FECHA ELSE
                       ?>
                    </tbody>
                </form>
            </table><!--------- CARRINHO DE COMPRAS - fim ---------->
                
                
            <?php
                $btn_comprar=0;
            ?>
            <table class="resumo"><!--------- RESUMO DA COMPRA ---------->
                <thead class="resumo">
                    <tr class="resumo">
                        <th class="resumo">
                            <label class="resumo">Resumo da Compra</label>
                        </th>
                    </tr>
                </thead>
                <form action="?acao=up" method="post">
                    <tfoot>
                        <tr>
                            <td  class="resumo">
                               <?php
                                    if($btn_comprar==0){
                                        echo '
                                        <a href="finalizacompra.php" class="btn_fin_comp" enable>Finalizar Compra</a>';
                                    }else{
                                        echo '
                                        <a href="finalizacompra.php" class="btn_fin_comp" disable>Finalizar Compra</a>';
                                    }
                                ?>
                                
                            </td>
                        </tr>
                    </tfoot>

                    <tbody>
                       <?php
                        $btn_comprar = 0;
                        if(count($_SESSION['carrinho']) == 0){
                            echo '
                            <tr>
                                <td  class="resumo">
                                    Seu carrinho está vazio!
                                </td>
                            </tr>';
                        }
                        else
                        {
                            $btn_comprar = 1;
                            require("conexao.php");
                            $total = 0;

                            foreach($_SESSION['carrinho'] as $idproduto => $qtd)
                            { // Início do FOREACH
                                $sql = "SELECT * FROM produto WHERE idproduto=$idproduto AND excluido = 'n' ORDER BY nome";
                                $res = pg_query($conecta, $sql);
                                $regs = pg_num_rows($res);
                                if($regs>0)
                                {
                                    $linha = pg_fetch_array($res);
                                    $_SESSION['estoque'] = $linha['qtd_estoque'];
                                    $preco = $linha['preco'];
                                    $sub = $preco * $qtd;  
                                    $total += $sub;
                                    $preco = number_format($preco, 2, ',', '.');
                                    $sub = number_format($sub, 2, ',', ' ');
                                }
                                echo '
                                <tr class="resumo">
                                    <td class="resumo" id="carrinho_res" align=left>
                                        <label class="resumo" id="preco_sub">R$ '.$preco.' x '.$qtd.'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="resumo" id="sub_preco">R$ '.$sub.'</label>
                                    </td>
                                </tr>';
                            }// Término do FOREACH
                            /*---------- ECHO DO TOTAL ----------*/
                            $total = number_format($total, 2, ',', ' ');
                            echo '
                            <tr>
                                <td class="resumo">
                                    <label id="total_txt" class="resumo">Total</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label id="total_var" class="resumo">R$ '.$total.'</label><br>
                                </td>
                            </tr>';
                         }//FECHA ELSE
                       ?>
                    </tbody>
                </form>
            </table><!--------- RESUMO DE COMPRA - fim ---------->
        </div>    
        <br><br>
        <div align="center"><a href="#topo"><img id="voltar_topo" src="imagens/voltar_topo.png"></a></div><br>
        </font> <!-------- FONTE ARIAL - final ------------>
    </div> <!-- final mae -->
</body>
</html>