<?php
	$correto = null;
	$email = $_POST['email'];
	$senha   = $_POST['senha'];

		session_start();	
		include "conexao.php";
		$sql= "SELECT * FROM login"; 
		$banco = $conexao -> prepare($sql);
		$banco -> execute();
	
		foreach($banco as $login){		
			$usuariobd  = $login['email'];
			$senhabd  	= $login['senha'];
			
			if(($usuariobd == $email) && ($senhabd == $senha)){
				$correto = 1;
				
			}
		}
		
		if($correto == 1){
			$_SESSION['login'] = 1;	
			header("Location: listar_lancamentos.php");
		}else{
			header("Location: index.php");
			session_destroy();
		}		
?>