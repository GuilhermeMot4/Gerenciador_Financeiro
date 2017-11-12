<?php
	$id   = $_GET['id'];

	if(isset($_GET['confirmarExcluir']) && $_GET['confirmarExcluir'] == 1){
		$sql = "DELETE FROM categoria_tb WHERE id_categoria= $id";	
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		header("Location: categorias.php");
	}else{
		header("Location: categorias.php");
	}
?>