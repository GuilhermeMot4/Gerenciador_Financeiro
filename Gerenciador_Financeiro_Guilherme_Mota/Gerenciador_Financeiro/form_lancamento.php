<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Formulário Lançamentos - Gerenciador Financeiro</title>
		<link rel="stylesheet" href="css/css.css">
		<link rel="stylesheet" href="css/header.css">
	</head>
	<?php 
		session_start();
		if(isset($_SESSION['login'])){
			if($_SESSION['login'] == 1){
			}else{
				header("Location: index.php");
			}
		}else{
			header("Location: index.php");
			session_destroy();
		}
	?>
	<?php
	$tipo = $_GET['tipo'];
	
	if(isset($_POST['enviar'])){
		
		$id               = "";
		$data_prevista    = $_POST['data_prevista'];
		$data_efetivada   = $_POST['data_efetivada'];
		$categoria        = $_POST['categoria'];
		$descricao        = $_POST['descricao'];
		$valor            = $_POST['valor'];
		$tipo             = $_POST['tipo'];
	
	include "conexao.php";
	$sql = "INSERT INTO lancamento_tb VALUES (?,?,?,?,?,?,?)";
	$financeiro = $conexao -> prepare($sql);	
	$financeiro -> execute(array($id, $data_prevista, $data_efetivada, $categoria, $descricao, $valor, $tipo));	
	$financeiro = null;
	header("Location: listar_lancamentos.php");
	}
	?>
	<body>
		<header class="header" role="banner">
		    <nav class="nav_bar">
		        <ul class="ul_bar">
		            <li class="li_bar"><a href="form_lancamento.php?tipo=R"><img width="40px" height="40px" title="Adicionar Receita" src="imgs/mais.png"></a></li>
		            <li class="li_bar"><a href="form_lancamento.php?tipo=D"><img width="40px" height="40px" title="Adicionar Despesa" src="imgs/menos.png"></a></li>
		            <li class="li_bar"><a href="listar_lancamentos.php">Lançamentos</a></li>
		            <li class="li_bar"><a href="categorias.php">Categorias</a></li>
		            <li class="li_bar"><a href="logoff.php">Sair</a></li>
		        </ul>
		    </nav>
		</header>
		<center>
		<form method="POST" action="">
		<input type="hidden" name="tipo" value="<?php echo $tipo;?>">
			<h1>Formulário de Lançamento</h1><hr>	
			<div class="card">
				<div class="container">
					<h3>Formulário de Lançamentos</h3>
					<p>Data Prevista</p>
					<input type="date" name="data_prevista" autofocus required><br>
					<p>Data Efetivada:</p>
					<input type="date" name="data_efetivada" ><br>
					<p>Categoria:</p>
					<select name="categoria" required>
						<?php 
						include "conexao.php";
						$sql = "SELECT * FROM categoria_tb WHERE categoria='$tipo' OR categoria='A' ORDER BY categoria ASC";	
						$financeiro = $conexao -> prepare($sql);
						$financeiro -> execute();
					
						foreach($financeiro as $categorias){ ?>
						<option value="<?php echo $categorias['id_categoria'];?>"><?php echo $categorias['nome'];?></option>
						<?php														
							}
						?>
					</select><br>
					<p>Descrição:</p>
					<input type="text" name="descricao"><br>
					<p>Valor:</p>
					<input type="number" name="valor"  step="0.01" required>
				</div>
			</div><br>
			<input class="datas-button" type="submit" name="enviar">
		</form><br>
		<a href="listar_lancamentos.php"><button class="datas-button">Voltar</button></a>
		</center>
	</body>
</html>