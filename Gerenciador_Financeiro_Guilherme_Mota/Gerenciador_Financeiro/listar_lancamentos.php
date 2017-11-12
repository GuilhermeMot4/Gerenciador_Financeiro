<!DOCTYPE html>
<html lag="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Gerenciador Financeiro</title>
		<link rel="stylesheet" href="css/css.css">
		<link rel="stylesheet" href="css/header.css">
	</head>
	<script>
		function Confirmar(id) {
			if (confirm('Tem certeza que deseja excluir?')){
				window.location.href = 'excluir_lancamento.php?id='+id+'&confirmarExcluir=1';
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
	
		$dataHoje = date('Ymd');
			$ano = date('Y');
			
		if(isset($_POST['confDia'])){
				$delimiter = $_POST['dia'];
				$order = "AND data_prevista='$delimiter'";
			}else if(isset($_POST['confMes'])){
				$delimiter = $_POST['mes'];
				$order = "AND YEAR(data_prevista)=$ano AND MONTH(data_prevista) BETWEEN $delimiter AND $delimiter";
			}else if(isset($_POST['periodo'])){
				$dataInicial = $_POST['dataInicial'];
				$dataFinal = $_POST['dataFinal'];
				$order = "AND data_prevista BETWEEN '$dataInicial' AND '$dataFinal'";
			}else{
				$order = "";
			}
	?>
	<?php
		
		$sql = "SELECT SUM(valor) as 'total_receitas' FROM lancamento_tb WHERE tipo='R' AND data_efetivada!='0000-00-00'";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		
		foreach($financeiro as $soma_receitas){
			$receitas = $soma_receitas['total_receitas'];
		}

		$sql = "SELECT SUM(valor) as 'total_despesas' FROM lancamento_tb WHERE tipo='D' AND data_efetivada!='0000-00-00'";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		$nLinha = $financeiro -> rowCount();
		
		if($nLinha >=1){
		foreach($financeiro as $soma_despesas){
			$despesas = $soma_despesas['total_despesas'];
		}
		}else{
			$despesas = 0;
		}
		
		$saldo = $receitas - $despesas;
		$saldo_novo =  ' R$ ' . number_format($saldo, 2, ',', '.');
	?>
	<?php
		
		$sql = "SELECT SUM(valor) as 'total_receitas_atrasado' FROM lancamento_tb WHERE tipo='R'  AND data_efetivada='0000-00-00' AND data_prevista < $dataHoje";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		
		foreach($financeiro as $soma_receitas_atrasado){
			$receitas_atrasado = $soma_receitas_atrasado['total_receitas_atrasado'];
		}

		$sql = "SELECT SUM(valor) as 'total_despesas_atrasado' FROM lancamento_tb WHERE tipo='D' AND data_efetivada='0000-00-00' AND data_prevista < $dataHoje";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		$nLinha = $financeiro -> rowCount();
		
		if($nLinha >=1){
		foreach($financeiro as $soma_despesas_atrasado){
			$despesas_atrasado = $soma_despesas_atrasado['total_despesas_atrasado'];
		}
		}else{
			$despesas_ = 0;
		}
		
		$saldo_atrasado = $receitas_atrasado - $despesas_atrasado;
		$saldo_atrasado_novo =  ' R$ ' . number_format($saldo_atrasado, 2, ',', '.');
	?>
	<?php
		
		$sql = "SELECT SUM(valor) as 'total_receitas_pendente' FROM lancamento_tb WHERE tipo='R'  AND data_efetivada='0000-00-00' AND data_prevista > $dataHoje OR data_prevista = $dataHoje ";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		
		foreach($financeiro as $soma_receitas_pendente){
			$receitas_pendente = $soma_receitas_pendente['total_receitas_pendente'];
		}

		$sql = "SELECT SUM(valor) as 'total_despesas_pendente' FROM lancamento_tb WHERE tipo='D' AND data_efetivada='0000-00-00' AND data_prevista > $dataHoje OR data_prevista = $dataHoje";
		include "conexao.php";
		$financeiro = $conexao -> prepare($sql);
		$financeiro -> execute();
		$nLinha = $financeiro -> rowCount();
		
		if($nLinha >=1){
		foreach($financeiro as $soma_despesas_pendente){
			$despesas_pendente = $soma_despesas_pendente['total_despesas_pendente'];
		}
		}else{
			$despesas_pendente = 0;
		}
		
		$saldo_pendente = $receitas_pendente - $despesas_pendente;
		$saldo_pendente_novo =  ' R$ ' . number_format($saldo_pendente, 2, ',', '.');
	?>
	<body>
		<center><h1>Gerenciador Financeiro</h1></center>
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
		<div class="card">
			<div class="container">
				<h2><b>Saldo Atual:</b></h2> 
				<p><?php echo $saldo_novo; ?></p> 
			</div>
			<div class="container">
				<h2><b>Saldo Atrasado:</b></h2> 
				<p><?php echo $saldo_atrasado_novo; ?></p> 
			</div>
			<div class="container">
				<h2><b>Saldo Pendente:</b></h2> 
				<p><?php echo $saldo_pendente_novo; ?></p> 
			</div>
		</div><br>
		<div class="datas">
			<div class="card">
				<div class="container">
					<h2><b>Ordenar por:</b></h2>
					<form method="POST" action="" class="opcoes">
					<div class="inputESubmit">
						<input type="date" name="dia">
						<br><br>
						<input class="datas-button" type="submit" name="confDia" value="Selecionar por Dia">
					</div>
				</div><br>
				<div class="container">
					<div class="inputESubmit">
						<select name="mes">
							<option value="1">Janeiro</option>
							<option value="2">Fevereiro</option>
							<option value="3">Março</option>
							<option value="4">Abril</option>
							<option value="5">Maio</option>
							<option value="6">Junho</option>
							<option value="7">Julho</option>
							<option value="8">Agosto</option>
							<option value="9">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
						</select>
						<br><br>
						<input class="datas-button" type="submit" name="confMes" value="Selecionar por Mês">
					</div>
				</div>
				<div class="container"><br>
					<div class="inputESubmit">
						<input type="date" name="dataInicial">
						<input type="date" name="dataFinal">
						<br><br>
						<input class="datas-button" type="submit" name="periodo" value="Selecionar por Período">
					</div><br>
					</form>
				</div>
			</div>
		</div><br>
		<table>
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Data Prevista</th>
					<th>Data Efetivada</th>
					<th>Categoria</th>
					<th>Descrição</th>
					<th>Valor</th>
					<th>Status</th>
					<th>Operações</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT * FROM lancamento_tb,categoria_tb WHERE lancamento_tb.categoria=categoria_tb.id_categoria $order ORDER BY lancamento_tb.data_efetivada ASC";
					include "conexao.php";
					$financeiro = $conexao -> prepare($sql);
					$financeiro -> execute();
					
					$cont = 1;
					
					foreach($financeiro as $lancamentos){
						if($cont <=15){
						$id                  = $lancamentos['id_lancamento'];
						$data_prevista       = $lancamentos['data_prevista'];
						$data_efetivada      = $lancamentos['data_efetivada'];
						$categoria           = $lancamentos['nome'];
						$descricao           = $lancamentos['descricao'];
						$valor               = $lancamentos['valor'];
						$dataHoje = date('Ymd');
						$tempo = str_replace("-","",$data_prevista);
						
						if($data_efetivada == "0000-00-00"){			
							if($tempo < $dataHoje){
								$classe = "atrasado";
								$status = "Atrasado";
							}
							if($tempo == $dataHoje){
								$classe = "paraHoje";
								$status = "Para Hoje";
							}
							if($tempo > $dataHoje){
								if($tempo <= $dataHoje + 7){
									$classe = "naSemana";
									$status = "Para esta Semana";
								}else{
									$classe = "aPagar";
									$status = "A Pagar";
								}
							}
							
							$data_efetivada = "Não Efetivada";
						}else{
							$classe = "pago";
							$status = "Pago";
							$data_efetivada = date('d/m/Y',strtotime($data_efetivada));
						}
						
						$tipo = $lancamentos['tipo'];
						if($tipo == "R"){
							$imagem_tipo = 'imgs/mais.png';
						}else{
							$imagem_tipo = 'imgs/menos.png';	
						}
						
						$editar              = "<a href='editar_lancamento.php?id=$id'><img src='imgs/editar.png'   width='25px' height='25px' title='Editar'></a>";
						$excluir             = "<a onClick='Confirmar($id)'><img src='imgs/excluir.png' width='25px' height='25px' title='Excluir'></a>";
						
						echo "<tr>";
						echo "<td>";
						echo "<img width='20px' height='20px' src='$imagem_tipo'>";
						echo "</td>";
						echo "<td>";
						echo date('d/m/Y',strtotime($data_prevista));
						echo "</td>";
						echo "<td>";
						echo $data_efetivada;
						echo "</td>";
						echo "<td>";
						echo $categoria;
						echo "</td>";
						echo "<td>";
						echo $descricao;
						echo "</td>";
						echo "<td>";
						echo $valor;
						echo "</td>";
						echo "<td class='$classe'>";
						echo $status;
						echo "</td>";
						echo "<td>";
						echo $editar;
						echo $excluir;
						echo "</td>";
						echo "</tr>";
						
						$cont++;
					}else{
						break;
					}
				}
				?>
			</tbody>
		</table>
	</body>
</html>