<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Editar Categoria - Gerenciador Financeiro</title>
		<meta charset="UTF-8">
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
		$id   = $_GET['id'];
		
		include "conexao.php";
		$sql = "SELECT * FROM categoria_tb WHERE id_categoria= $id";	
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		
		foreach($financeiro as $categorias){
		
			if(isset($_POST['enviar'])){
				$nome             = $_POST['nome'];
				$categoria        = $_POST['categoria'];
				
				include "conexao.php";
				$sql = "UPDATE categoria_tb SET nome=?,categoria=? WHERE id_categoria='$id'";	
				$financeiro = $conexao -> prepare($sql);
				$financeiro -> execute(array($nome,$categoria));
				
				$sql = "UPDATE lancamento_tb SET tipo=? WHERE categoria='$id'";	
				$financeiro = $conexao -> prepare($sql);
				$financeiro -> execute(array($categoria));
				$financeiro = null;
				header("Location:categorias.php");
			}
		}
		
		
	
	?>
	<body>
		<center>
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
		<form method="POST" action="">
			<h1>Editar Categoria</h1><hr>	
			<div class="card">
				<div class="container">
					<h3>Editar Categoria</h3>
					<p>Nome:</p>
					<input type="text" name="nome" value="<?php echo $categorias['nome'];?>"><br>
					<p>Categoria:</p>
					<select name="categoria" >
						<option><?php echo $categorias['categoria'];?></option>
						<option value="A">A</option>
						<option value="D">D</option>
						<option value="R">R</option>
					</select>
				</div>
			</div><br>
			<input class="datas-button" type="submit" name="enviar">
		</form><br>
		<a href="categorias.php"><button class="datas-button">Voltar</button></a>
		</center>
	</body>
<html>