<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="imagens/estilo.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="imagens/icone.png">
    <title>Área do Usuário</title>	
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
                       <a href = "carrinho.php"><img class="buscar_header" src="imagens/icone_buscar.png"></a>
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
                ?>
                <a class="links_header" href="area_usuario.php"><label style="font-weight: 900; color: darkslategrey;">ÁREA DO USUÁRIO</label></a>
                <?php
                    }
                ?>
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
</font>
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
                        <img class="btn_usu" src="imagens/lapis.png"><a class="link_usu" href="dados.php">alterar conta</a>
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
                    <img class="btn_usu" src="imagens/user.png"><h1>SEU PERFIL</h1>
                    <br>
                    <?php
                        include "conexao.php";
                        session_start();
                        function data($data){
                            return date("d/m/Y", strtotime($data));
                        }
                        $id =$_SESSION['idcliente'];
                        $nome = $_SESSION['nome'];
                        $email = $_SESSION['mail'];
                        $sexo = $_SESSION['sexo'];
                        $data_nasc = $_SESSION['dt_nascimento'];
                        $dt_nasc = data($data_nasc);
                        $end = $_SESSION['endereco'];
                        echo '<label class="perfil_usu_nome">Nome   </label><label class="perfil_usu_info">'.$nome.'</label><br><br>';
                        echo '<label class="perfil_usu_nome">Email   </label><label class="perfil_usu_info">'.$email.'</label><br><br>';
                        if($sexo == 'F'){
                            $sex="Feminino";
                        }
                        else if($sexo == 'M'){
                            $sex="Masculino";
                        }
                        else if($sexo == 'O'){
                            $sex="Outro";
                        }
                        echo '<label class="perfil_usu_nome">Sexo   </label><label class="perfil_usu_info">'.$sex.'</label><br><br>';
                        echo '<label class="perfil_usu_nome">Nascimento   </label><label class="perfil_usu_info">'.$dt_nasc.'</label><br><br>';
                        echo '<label class="perfil_usu_nome">Endereço   </label><label class="perfil_usu_info">'.$end.'</label><br><br>';
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
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
</body>
</html>