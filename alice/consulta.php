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
    <div id="divcomunidade">
        <img id="comunidade" src="imagens/comunidade.png">
    </div>
    <br><br>
    
    <div id="divpesquisa">
        <form method="post" action="consulta.php">
            
            <input type="text" name="pesq" id="pesq" placeholder="Buscar..."/>
            <input type="submit" value="Pesquisar"/>
            <a class="pesquisa"><img class="pesquisa" src="imagens/pesquisa.png" id="btnBusca" alt="Buscar"/></a>
        
    </div>
    <br><br>
    
    <!-- FILTRO -->
    <div id="consulta">
        <!--<div class="filtro">
            
            <input id="todos" class="filtro" type="radio" name="filtro" value="todos" ><label for="todos" id="check" class="radio">TODOS</label>
            
            <input id="topo" class="filtro" type="radio" name="filtro" value="topo"><label for="topo" id="check" class="radio">TOPO</label>
            
            <input id="jungle" class="filtro" type="radio" name="filtro" value="jungle"><label for="jungle" id="check" class="radio">JUNGLE</label>
            
            <input id="meio" class="filtro" type="radio" name="filtro" value="meio"><label for="meio" id="check" class="radio">MEIO</label>
            
            <input id="atirador" class="filtro" type="radio" name="filtro" value="adc"><label for="atirador" id="check" class="radio">ATIRADOR</label>
            
            <input id="suporte" class="filtro" type="radio" name="filtro" value="sup"><label for="suporte" id="check" class="radio">SUPORTE</label>-->
            </form>
        </div>    <!-- TABELA PARA OS DADOS A SEREM MOSTRADOS -->
        <div class="dados">
            <table>
                <thead>
                    <tr>
                           <th><label class="dados">NOME</label></th>
                           <th><label class="dados">NOME DE INVOCADOR</label></th>

                           <th><label class="dados">LANES JOGADAS</label></th>
                           <th><label class="dados">MAIN</label></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "conexao.php";

                        $pesquisa = $_POST['pesq'];
                        
                        if ($pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if (isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' OR lower(lane) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        /*$filtro = $_POST['filtro'];

                        $sql = "SELECT * FROM usuario WHERE excluido='n' ORDER BY nome_de_invocador;";
                        $resultado = pg_query($conecta, $sql);
                        $qtde = pg_num_rows($resultado);
                        if ($qtde > 0){
                            for ($cont=0; $cont <$qtde; $cont++){
                                $linha = pg_fetch_array($resultado);

                                ?><tr class="separar">
                                <td><label class="dados"><?php echo $linha['nome']; ?></label></td>
                                <td><label class="dados"><?php echo $linha['nome_de_invocador']; ?></label></td>
                                <td><label class="dados"><?php echo $linha['lane']; ?></label></td>
                                <td><label class="dados"><?php echo $linha['main']; ?></label></td>
                                </tr><?php
                            }
                        }

                        if ($filtro == 'todos' && $pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if ($filtro == 'todos' && isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }

                        if ($filtro == 'topo' && $pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'topo' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if ($filtro == 'topo' && isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'topo' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }

                        if ($filtro == 'jungle' && $pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'jungle' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if ($filtro == 'jungle' && isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'jungle' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }

                        if ($filtro == 'meio' && $pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'meio' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if ($filtro == 'meio' && isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'meio' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }

                        if ($filtro == 'adc' && $pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'atirador' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if ($filtro == 'adc' && isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'atirador' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }

                        if ($filtro == 'sup' && $pesquisa == ''){
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'suporte' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }
                        if ($filtro == 'sup' && isset($pesquisa)) {
                            $pesquisa = strtolower($pesquisa);
                            $sql = "SELECT * FROM usuario WHERE excluido='n' AND lane = 'suporte' AND lower(nome) LIKE '%$pesquisa%' OR lower(nome_de_invocador) LIKE '%$pesquisa%' 
                            OR lower(main) LIKE '%$pesquisa%' ORDER BY nome_de_invocador;";
                            $resultado = pg_query($conecta, $sql);
                            $qtde = pg_num_rows($resultado);
                        }*/

                        if ($qtde > 0){
                            for ($cont=0; $cont <$qtde; $cont++){
                                $linha = pg_fetch_array($resultado);

                                ?><tr class="separar">
                                <td><label class="dados"><?php echo $linha['nome']; ?></label></td>
                                <td><label class="dados"><?php echo $linha['nome_de_invocador']; ?></label></td>
                                <td><label class="dados"><?php echo $linha['lane']; ?></label></td>
                                <td><label class="dados"><?php echo $linha['main']; ?></label></td>
                                </tr><?php
                            }
                        }
                        pg_close($conecta);
                    ?>
                </tbody>
            </table>       
        </div><!-- /dados -->
    </div><!-- /consulta -->
    
        <footer>
            <br><br>
            Projeto ALICE
            <br><br><br>
        </footer> 
</body>
</html>
