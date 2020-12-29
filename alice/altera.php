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
                    echo "<script type='text/javascript'>alert('$invocador ERRO ao encontrar os dados!')</script>";
                    echo "<meta HTTP-EQUIV = 'refresh' CONTENT = '0;URL=consulta.php'>";
                }
                $linha = pg_fetch_array($resultado);
            ?>

            <form method="post" action="grava_altera.php">
            <h2 class="usuario">ALTERAR DADOS</h2>
            <img id="divisor" src="imagens/divisor.png">

                <p class="usuario">
                    <label class="center" for="nome">NOME</label><br>
                    <input class="center" id="nome" name="nome" required="required" type="text" value="<?php echo $linha[nome]; ?>"/>
                </p>

                <p class="usuario">
                    <label class="center" for="invNome">NOME DE INVOCADOR</label><br>
                    <input class="center" style="background-color: rgba(50, 95, 39, 0.7);" id="invNome" name="invNome" required="required" type="text" value="<?php echo $linha[nome_de_invocador]; ?>" readonly />
                </p>

                <p class="usuario"> 
                    <label class="center" for="email">EMAIL</label><br>
                    <input class="center" id="email" style="background-color: rgba(50, 95, 39, 0.7);" name="email" required="required" type="email" value="<?php echo $linha[email]; ?>" readonly/> 
                </p> 

                <p class="usuario"> 
                    <label class="center" for="senha_cadastro">SENHA</label><br>
                    <input class="center" id="senha_cadastro" name="senha_cadastro" required="required" value="<?php echo $linha[senha]; ?>" type="password"/> 
                </p>

                <p class="usuario">
                <label class="center">LANE PRINCIPAL</label><br>
                <div id="center">
                    <div class="tooltip">
                        <label for="topo" class="radio">
                            <input id="topo" type="radio" name="lane" value="topo" required><img class="img_lane" src="imagens/lane_top.png"><span class="tooltiptext">TOPO</span>
                            </label>   
                    </div>

                    <div class="tooltip">
                        <label for="jungle" class="radio">
                            <input id="jungle" type="radio" name="lane" value="jungle"><img class="img_lane" src="imagens/lane_jungle.png"><span class="tooltiptext">JUNGLE</span>
                            </label>   
                    </div>

                    <div class="tooltip">
                        <label for="meio" class="radio">
                        <input id="meio" type="radio" name="lane" value="meio"><img class="img_lane" src="imagens/lane_mid.png"><span class="tooltiptext">MEIO</span>
                        </label>
                    </div>

                    <div class="tooltip">
                        <label for="adc" class="radio">
                        <input id="adc" type="radio" name="lane" value="atirador"><img class="img_lane" src="imagens/lane_adc.png"><span class="tooltiptext">ATIRADOR</span>
                        </label>
                    </div>

                    <div class="tooltip">
                        <label for="sup" class="radio">
                        <input id="sup" type="radio" name="lane" value="suporte"><img class="img_lane" src="imagens/lane_sup.png"><span class="tooltiptext">SUPORTE</span>
                        </label>
                    </div>
                </div> <!-- /center -->
                                    
                </p>
                    <br><br><br><br><br>
                <p class="usuario">
                    <label class="center" for="main">MAIN</label><br>
                    <input class="center" list="mains" name="main" id="main">
                    <datalist id="mains" class="usuario" required>
                    <option class="usuario" name="ahri" value="AHRI">
                    <option class="usuario" name="akali" value="AKALI">
                    <option class="usuario" name="amumu" value="AMUMU">
                    <option class="usuario" name="anivia" value="ANIVIA">
                    <option class="usuario" name="annie" value="ANNIE">
                    <option class="usuario" name="aurelion" value="AURELION SOL">
                    <option class="usuario" name="azir" value="AZIR">
                    <option class="usuario" name="bardo" value="BARDO">
                    <option class="usuario" name="blitz" value="BLITZCRANK">
                    <option class="usuario" name="brand" value="BRAND">
                    <option class="usuario" name="braum" value="BRAUM">
                    <option class="usuario" name="caitlyn" value="CAITLYN">
                    <option class="usuario" name="camille" value="CAMILLE">
                    <option class="usuario" name="cassiopeia" value="CASSIOPEIA">
                    <option class="usuario" name="chogath" value="CHO'GATH">
                    <option class="usuario" name="darius" value="DARIUS">
                    <option class="usuario" name="diana" value="DIANA">
                    <option class="usuario" name="draven" value="DRAVEN">
                    <option class="usuario" name="ekko" value="EKKO">
                    <option class="usuario" name="ez" value="EZREAL">
                    <option class="usuario" name="fiddle" value="FIDDLESTICKS">
                    <option class="usuario" name="fizz" value="FIZZ">
                    <option class="usuario" name="galio" value="GALIO">
                    <option class="usuario" name="gp" value="GANGPLANK">
                    <option class="usuario" name="garen" value="GAREN">
                    <option class="usuario" name="gnar" value="GNAR">
                    <option class="usuario" name="gragas" value="GRAGAS">
                    <option class="usuario" name="heimer" value="HEIMERDINGER">
                    <option class="usuario" name="illaoi" value="ILLAOI">
                    <option class="usuario" name="irelia" value="IRELIA">
                    <option class="usuario" name="ivern" value="IVERN">
                    <option class="usuario" name="janna" value="JANNA">
                    <option class="usuario" name="jax" value="JAX">
                    <option class="usuario" name="jayce" value="JAYCE">
                    <option class="usuario" name="jhin" value="JHIN">
                    <option class="usuario" name="jinx" value="JINX">
                    <option class="usuario" name="kalista" value="KALISTA">
                    <option class="usuario" name="karma" value="KARMA">
                    <option class="usuario" name="karthus" value="KATHUS">
                    <option class="usuario" name="kassadin" value="KASSADIN">
                    <option class="usuario" name="katarina" value="KATARINA">
                    <option class="usuario" name="kennen" value="KENNEN">
                    <option class="usuario" name="kindred" value="KINDRED">
                    <option class="usuario" name="kled" value="KLED">
                    <option class="usuario" name="kog" value="KOG'MAW">
                    <option class="usuario" name="kzx" value="KAH'ZIX">
                    <option class="usuario" name="lb" value="LE BLANC">
                    <option class="usuario" name="leona" value="LEONA">
                    <option class="usuario" name="lissandra" value="LISSANDRA">
                    <option class="usuario" name="lucian" value="LUCIAN">
                    <option class="usuario" name="lulu" value="LULU">
                    <option class="usuario" name="lux" value="LUX">
                    <option class="usuario" name="malph" value="MALPHITE">
                    <option class="usuario" name="malza" value="MALZAHAR">
                    <option class="usuario" name="maokai" value="MAOKAI">
                    <option class="usuario" name="mf" value="MISS FORTUNE">
                    <option class="usuario" name="morgana" value="MORGANA">
                    <option class="usuario" name="mundo" value="DR. MUNDO">
                    <option class="usuario" name="nasus" value="NASUS">
                    <option class="usuario" name="nidalee" value="NIDALEE">
                    <option class="usuario" name="olaf" value="OLAF">
                    <option class="usuario" name="oriana" value="ORIANA">
                    <option class="usuario" name="poppy" value="POPPY">
                    <option class="usuario" name="rammus" value="RAMMUS">
                    <option class="usuario" name="reksai" value="REK'SAI">
                    <option class="usuario" name="renek" value="RENEKTON">
                    <option class="usuario" name="rengar" value="RENGAR">
                    <option class="usuario" name="rumble" value="RUMBLE">
                    <option class="usuario" name="ryze" value="RYZE">
                    <option class="usuario" name="shaco" value="SHACO">
                    <option class="usuario" name="shen" value="SHEN">
                    <option class="usuario" name="shyvana" value="SHYVANA">
                    <option class="usuario" name="singed" value="SINGED">
                    <option class="usuario" name="sion" value="SION">
                    <option class="usuario" name="sona" value="SONA">
                    <option class="usuario" name="soraka" value="SORAKA">
                    <option class="usuario" name="syndra" value="SYNDRA">
                    <option class="usuario" name="taliyah" value="TALIYAH">
                    <option class="usuario" name="teemo" value="TEEMO">
                    <option class="usuario" name="tk" value="TAHM KENCH">
                    <option class="usuario" name="tristana" value="TRISTANA">
                    <option class="usuario" name="trynda" value="TRYNDAMERE">
                    <option class="usuario" name="twich" value="TWICH">
                    <option class="usuario" name="udyr" value="UDYR">
                    <option class="usuario" name="varus" value="VARUS">
                    <option class="usuario" name="vayne" value="VAYNE">
                    <option class="usuario" name="veigar" value="VEIGAR">
                    <option class="usuario" name="velkoz" value="VEL'KOZ">
                    <option class="usuario" name="viktor" value="VIKTOR">
                    <option class="usuario" name="vlad" value="VLADIMIR">
                    <option class="usuario" name="voli" value="VOLIBEAR">
                    <option class="usuario" name="wukong" value="WUKONG">
                    <option class="usuario" name="xayah" value="XAYAH">
                    <option class="usuario" name="xerath" value="XERATH">
                    <option class="usuario" name="xin" value="XIN ZHAO">
                    <option class="usuario" name="yasuo" value="YASUO">
                    <option class="usuario" name="zed" value="ZED">
                    <option class="usuario" name="ziggs" value="ZIGGS">
                    </datalist>
                </p>
                
                <p class="usuario"> 
                    <input id="submit_button" type="submit" value="ALTERAR">
                </p>
            </form>
        </div>
    </div>
    <br><br>

    <footer>
        <br><br>
        Projeto ALICE
        <br><br><br>
    </footer>
    
</body>
</html>
