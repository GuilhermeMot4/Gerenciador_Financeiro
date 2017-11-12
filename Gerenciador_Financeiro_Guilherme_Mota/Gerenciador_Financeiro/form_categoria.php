<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Formulário Categorias - Gerenciador Financeiro</title>
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
	if(isset($_POST['enviar'])){
		
		$id               = "";
		$nome             = $_POST['nome'];
		$categoria        = $_POST['categoria'];
	
	include "conexao.php";
	$sql = "INSERT INTO categoria_tb VALUES (?,?,?)";
	$financeiro = $conexao -> prepare($sql);	
	$financeiro -> execute(array($id, $nome, $categoria));	
	$financeiro = null;
	header("Location: categorias.php");
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
			<h1>Formulário de Categoria</h1><br>
			<div class="card">
				<div class="container">
					<h3>Formulário de Categorias</h3>
					<p>Nome:</p>
					<input type="text" name="nome" autofocus required><br>
					<p>Categoria:</p>
					<select name="categoria" required>
						<option>A</option>
						<option>D</option>
						<option>R</option>
					</select>
				</div>
			</div><br>
			<input class="datas-button" type="submit" name="enviar">
		</form><br>
		<a href="categorias.php"><button class="datas-button">Voltar</button></a>
		</center>
	</body>
</html>