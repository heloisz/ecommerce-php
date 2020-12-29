<style>
    body{
    background-image: url(imagens/bg_alteraexclui.jpg);
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
      
        <div class="content">
            <!--ALTERAÇÃO-->
            <div id="login">
                
                <h2  class="usuario">ALTERAR DADOS</h2> 
                <img id="divisor" src="imagens/divisor.png">

                <br><br>

                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <b>INFO!</b> É possivel alterar dados de todas as contas vinculadas ao seu email <br>
                    Ao cadastrar outras contas com o mesmo email, as opções já aparecerão nesta tabela!
                </div>
            </div>
        </div>

         <br>       

        <p class="usuario">
            <center>
            <!--<div class="dados">-->
                    <table>
                        <thead>
                            <tr>
                                <th><label class="dados">NOME DE INVOCADOR</label></th>
                                <th><label class="dados">LANES JOGADAS</label></th>
                                <th><label class="dados">MAIN</label></th>
                                <th><label class="dados">ALTERAR</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "conexao.php";
                                $email = $_SESSION['email'];

                                $sql="SELECT * FROM usuario WHERE excluido='n' AND email = '$email' ORDER BY nome_de_invocador;";
                                $resultado = pg_query($conecta, $sql);
                                $qtde = pg_num_rows($resultado);

                                if ($qtde > 0){
                                    for ($cont=0; $cont <$qtde; $cont++){
                                        $linha = pg_fetch_array($resultado);
                                        $invocador = $linha[nome_de_invocador];

                                        ?><tr class="separar">
                                        <td><label class="dados"><?php echo $linha['nome_de_invocador']; ?></label></td>
                                        <td><label class="dados"><?php echo $linha['lane']; ?></label></td>
                                        <td><label class="dados"><?php echo $linha['main']; ?></label></td>
                                        <?php
                                        echo "<td><label><a href='altera.php?invNome=$linha[1]'>" ?> <img style="width: 30px;" src="imagens/alterar.png" alt="Alterar"></a></label></td>
                                        </tr>
                                        <?php
                                        
                                    }
                                }
                                pg_close($conecta);
                            ?>
                        </tbody>
                    </table>       
                <!--</div> /dados -->
            </center>
        </p>

        <br><br>

        <br><br><br><br><br><br><br>
        <!--<footer>
            <br><br>
            Projeto ALICE
            <br><br><br>
        </footer>-->

    </body>
</html>