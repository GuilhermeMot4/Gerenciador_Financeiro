<?php
	$id   = $_GET['id'];

	if(isset($_GET['confirmarExcluir']) && $_GET['confirmarExcluir'] == 1){
		$sql = "DELETE FROM lancamento_tb WHERE id_lancamento= $id";	
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		header("Location: listar_lancamentos.php");
	}else{
		header("Location: listar_lancamentos.php");
	}
?>