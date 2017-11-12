<!DOCTYPE html>
<html lag="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Categorias - Gerenciador Financeiro</title>
		<link rel="stylesheet" href="css/css.css">
		<link rel="stylesheet" href="css/header.css">
	</head>
	<script>
		function Confirmar(id) {
			if (confirm('Tem certeza que deseja excluir?')){
				window.location.href = 'excluir_categoria.php?id='+id+'&confirmarExcluir=1';
			}
		}		
	</script>
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
		$sql = "SELECT * FROM categoria_tb";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
	?>
	<body>
		<center><h1>Gerenciador Financeiro</h1>
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
		<table>
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Operações</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($financeiro as $categorias){
						$id                  = $categorias['id_categoria'];
						$nome                = $categorias['nome'];
						$categoria           = $categorias['categoria'];
						$editar              = "<a href='editar_categoria.php?id=$id'><img src='imgs/editar.png'   width='25px' height='25px' title='Editar'></a>";
						$excluir             = "<a onClick='Confirmar($id)'><img src='imgs/excluir.png' width='25px' height='25px' title='Excluir'></a>";
						
						echo "<tr>";
						echo "<td>";
						echo $id;
						echo "</td>";
						echo "<td>";
						echo $nome;
						echo "</td>";
						echo "<td>";
						echo $categoria;
						echo "</td>";
						echo "<td>";
						echo $editar;
						echo $excluir;
						echo "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table><br> 
		<a href="form_categoria.php"><button class="datas-button">Novo</button></a>
		<a href="listar_lancamentos.php"><button class="datas-button">Voltar</button></a>
		</center>
	</body>
</html>