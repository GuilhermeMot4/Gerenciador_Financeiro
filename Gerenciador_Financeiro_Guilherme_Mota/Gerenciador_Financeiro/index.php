<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Início - Gerenciador Financeiro</title>
		<link rel="stylesheet" href="css/css.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/login.css">
    <?php
      if(isset($_POST['enviar'])){
        
        $id         = "";
        $nome       = $_POST['nome'];
        $email      = $_POST['email'];
        $senha      = $_POST['senha'];
      
      include "conexao.php";
      $sql = "INSERT INTO login VALUES (?,?,?,?)";
      $banco = $conexao -> prepare($sql); 
      $banco -> execute(array($id, $nome, $email, $senha)); 
      $banco = null;  
      header("Location: index.php");
      }
    ?>
	</head>
	<body>
    <div class="login-page">
      <div class="form">
        <form class="register-form" method="POST" action="">
          <h1>Cadastro</h1>
          <input type="text" name="nome" placeholder="Nome">
          <input type="text" name="email" placeholder="E-mail">
          <input type="password" name="senha" placeholder="Senha">
          <input class="logininput" type="submit" value="Cadastrar" name="enviar">
          <p class="message">Já tem uma conta? <a href="#">Login</a></p>
        </form>
        <form method="POST" action="verificar.php">
          <h1>Login</h1>
          <input type="text" name="email" placeholder="E-mail">
          <input type="password" required name="senha" placeholder="Senha">
          <input class="logininput" type="submit" value="Login" name="enviar">
          <p class="message">Não tem conta? <a href="#">Cadastrar</a></p>
        </form>
      </div>
    </div>
    <script src='js/jquery.js'></script>
    <script  src="js/login.js"></script>
	</body>
</html>