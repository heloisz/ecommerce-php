<style>
    body{
    background-image: url(imagens/bg_consulta.jpg);
    background-size: cover;
    background-attachment: fixed;
    top: 80px;
    }
</style>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   
    <meta charset="UTF-8">
    <title>COMUNIDADE</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    
</head>
<body>
    <div id="header">
            <a href="https://br.leagueoflegends.com/pt-br/" target="_blank">
                <img class="header" src="imagens/lol_logo.png" alt="Site Oficial">
            </a>

            <a class="home" href="usuario_altera.php" style="left: 300px;">ALTERAR</a>
            <a class="home" href="usuario_exclui.php" style="left: 410px;">EXCLUIR</a>
            <a class="home" href="consulta.php" style="left: 515px;">COMUNIDADE</a>

            <?php
                session_start();
                $nick = $_SESSION['nick'];
                if (isset($nick)){
                    ?><select name="usuario" id="usuario" onchange="location = this.value;" style="position: absolute; top: 30px; right: 20px;">
                        <option value="consulta.php" style="display: none;"><?php echo $nick; ?></option>
                        <!--<option value="perfil.html">Perfil</option>-->
                        <option value="logout.php">Logout</option>
                    </select>
                    <?php
                }
            ?>
    </div>
    <div id="espaco"></div>
    
    <br><br>
    
    <div class="content">
      <!--CADASTRO-->
            <?php
                include "conexao.php";
                $invocador = $_GET["invNome"];

                $sql="SELECT * FROM usuario WHERE nome_de_invocador = '$invocador';";
                $resultado=pg_query($conecta,$sql);
                $qtde=pg_num_rows($resultado);

                if ( $qtde == 0 ){
                    echo "<script type='text/javascript'>alert('Invocador $invocador não encontrado!!')</script>";
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
                }
                $linha = pg_fetch_array($resultado);
            ?>

            <form method="post" action="confirma_exclui.php">
                <h2 class="usuario">EXCLUIR CONTA</h2>
                <img id="divisor" src="imagens/divisor.png">

                <p class="usuario">
                    <label class="center" for="nome">NOME</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="nome" name="nome" readonly type="text" value="<?php echo $linha[nome]; ?>"/>
                </p>

                <p class="usuario">
                    <label class="center" for="invNome">NOME DE INVOCADOR</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="invNome" name="invNome" readonly type="text" value="<?php echo $linha[nome_de_invocador]; ?>"/>
                </p>

                <p class="usuario"> 
                    <label class="center" for="email">EMAIL</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="email"  name="email" readonly type="email" value="<?php echo $linha[email]; ?>"/> 
                </p> 

                <p class="usuario"> 
                    <label class="center" for="senha_cadastro">SENHA</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="senha_cadastro" name="senha_cadastro" readonly value="<?php echo $linha[senha]; ?>" type="text"/> 
                </p>

                <p class="usuario">
                    <label class="center" for="lane">LANE</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="lane" name="lane" readonly type="text" value="<?php echo $linha[lane]; ?>"/>             
                </p>
                    
                <p class="usuario">
                    <label class="center" for="main">MAIN</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="main" name="main" readonly type="text" value="<?php echo $linha[main]; ?>"/>             
                </p>

                <br>
                
                <p class="usuario"> 
                    <input id="submit_button" type="submit" value="EXCLUI">
                </p>
            </form>
    </div>
    <br><br>

    <footer>
        <br><br>
        Projeto ALICE
        <br><br><br>
    </footer>
    
</body>
</html>
