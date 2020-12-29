<!--**
 * @author Cesar Szpak - Celke -   cesar@celke.com.br
 * @pagina desenvolvida usando framework bootstrap,
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php include_once("conect.php");
$result_produtos = "SELECT * FROM produtos";
$resultado_produtos = pg_query($conn, $result_produtos);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Criar pagina com abas</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>CAMISETAS</h1>
			</div>
			<div class="row">
				<?php while($rows_produtos = pg_fetch_assoc($resultado_produtos)){ ?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="imagens/produto.jpg" alt="...">
							<div class="caption text-center">
								<a href="detalhes.php?id_prod=<?php echo $rows_produtos['id']; ?>"><h3><?php echo $rows_produtos['nome']; ?></h3></a>
								<p><a href="#" class="btn btn-primary" role="button">ADICIONAR AO CARRINHO</a> </p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		
	</body>
</html>