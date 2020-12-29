<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: TesteBD1
Tabela: produto

Adicionado por Prof. Vitor Simeão (out/2019)

Modificado por Luís Fernando de Oliveira para projeto de ecommerce Styl
    14/09/2020 - 16h09min
    16/09/2020 - 19h50min
    22/09/2020 - 18h47min
    28/09/2020 - 14h22min
    29/09/2020 - 13h05min
*/

      session_start();
      if(!isset($_SESSION['nome'])){
         echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
         exit;
      }
      else if(isset($_SESSION['nome']) && !isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <title>Compra Finalizada</title>
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
        <div align=center>
            <table>
                <form action="?acao=voltar" method="post">
                    <tfoot>
                        <tr>
                        <td colspan="5"><a href="produtos.php">Voltar</a></td>
                    </tfoot>

                    <tbody>
                       <?php
                        if(count($_SESSION['carrinho']) == 0)
                        {
                            echo '<tr><td colspan="5">N&atilde;o h&aacute; produto no carrinho</td></tr>';
                        }
                        else
                        {
                            require("conexao.php");
                            $total = 0;
                        
                            $idcliente = $_SESSION['idcliente'];

                            // Gravar Venda
                            $sql = "INSERT INTO venda VALUES (DEFAULT, ".$idcliente.", NOW(), DEFAULT);";
                            $res = pg_query($conecta, $sql);

                            foreach($_SESSION['carrinho'] as $idproduto => $qtd)
                            { // Início do FOREACH
                                $sql_1 = "SELECT * FROM produto WHERE idproduto=$idproduto AND excluido = 'n' ORDER BY nome";
                                $result = pg_query($conecta, $sql_1);
                                $linha = pg_fetch_array($result);
                                
                                $qntd_estoque = $linha ['qtd_estoque'];
                                $atual_qtd_estoque = $qntd_estoque - $qtd;
                                $preco = $linha['preco'];
                                
                                $sql = "INSERT INTO itensvenda VALUES (CURRVAL('venda_idvenda_seq'),".$idproduto.",".$qtd.",".$preco.",'n');";
                                $res = pg_query($conecta, $sql);
                                
                                $outro_sql="UPDATE produto SET qtd_estoque = $atual_qtd_estoque WHERE idproduto = $idproduto";
                                $resultado=pg_query($conecta,$outro_sql);

                            }// Término do FOREACH

                            echo '<tr><td colspan="3">Compra Finalizada</td></tr>';
                            // Encerra SESSION
                            unset ($_SESSION['carrinho']);

                         }//FECHA ELSE
                       ?>
                    </tbody>
                </form><!--TERMINA O FORM-->
            </table>
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
            
        </font> <!-------- FONTE ARIAL - final ------------>
    </div> <!-- final mae -->
</body>
</html>