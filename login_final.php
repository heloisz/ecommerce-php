<!-- 
 Rafael e Leandro - XX/XX/XXXX - XXhXXmin
 Luís - 22/09/2020 - 17h51min
 Luís - 28/09/2020 - 14h22min
 Luís - 05/10/2020 - 20h11min
-->
<!DOCTYPE html>
<html lang="pt-br">
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="imagem/png" href="imagens/icone.png">
        <title>Login</title>
    </head>
    <body>
        <hr>
        <?php    
            include "conexao.php";
            session_start();
        
            $mail=$_POST['mail'];
            $senhacod = md5($_POST['senha']);
            
            $sql="select * from cliente WHERE email = '$mail' and senha = '$senhacod' and excluido = 'n'";            
            $resultado = pg_query($conecta,$sql);
            $row=pg_fetch_array($resultado);
            $linhas=pg_affected_rows($resultado);
        
            $_SESSION['mail'] = $mail;
            $_SESSION['nome'] = $row[nome];
            $_SESSION['idcliente'] = $row[idcliente];
            $_SESSION['sexo'] = $row[sexo];
            $_SESSION['dt_nascimento'] = $row['dt_nascimento'];
            $_SESSION['endereco'] = $row['endereco'];
            $_SESSION['senha'] = $row['senha'];
            $_SESSION['email'] = $row['email'];

            if ($linhas > 0)
            {               
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
            }
            else if (linhas <= 0)
            {
                $mail=$_POST['mail'];
                $senhacod = md5($_POST['senha']);
                
                $outro_sql="select * from administrador WHERE email = '$mail' and senha = '$senhacod' and excluido = 'n'";            
                $result = pg_query($conecta,$outro_sql);
                $r=pg_fetch_array($result);
                $linha=pg_affected_rows($result);
                
                $_SESSION['mail'] = $mail;
                $_SESSION['nome_adm'] = $r[nome];
                $_SESSION['idadministrador'] = $r[idadministrador];
                $_SESSION['sexo'] = $r[sexo];
                $_SESSION['dt_nascimento'] = $r['dt_nascimento'];
                $_SESSION['endereco'] = $r['endereco'];
                $_SESSION['senha'] = $r['senha'];
                $_SESSION['email'] = $r['email'];

                if ($linha > 0)
                {
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index_adm.php'>";
                    header("Refresh: 0; url=area_usuario.php");
                }
                else if ($senhacod != $_SESSION['senha'] || $mail != $_SESSION['email'])
                {
                    
                    echo "<script type='text/javascript'> alert('Email e/ou Senha incorretos!')</script>";                 
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
                } 
            }
            else if ($senhacod != $_SESSION['senha'] || $mail != $_SESSION['email'])
            {
                echo "<script type='text/javascript'> alert('Email e/ou Senha incorretos!')</script>";                 
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
            }
            pg_close($conecta);
         ?>
    </body>
 </html>