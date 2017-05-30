<?php
$titulo="Exibir Funcionários";
include_once $_SESSION["root"].'php/Util/Util.php';
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Funcionários	</h1>
			<?php if(isset($_SESSION["flash"]["msgExclusao"])){
					if($_SESSION["flash"]["sucesso"]==false)
						echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msgExclusao"]."</div>";
					else{
						echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msgExclusao"]."</div>";
					}
				} ?>
			<table class="table table-striped">
			<tr>
				<th>Nome</th>
				<th>Salário</th>
				<th>Login</th>
				<th>Departamento</th>
				<th>Permissão</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
			<?php
				foreach ($funcionarios as $value) {
					echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSalario()."</td>";
						echo "<td>".$value->getLogin()."</td>";
						echo "<td>".$value->getDepartamento()->getNome()."</td>";
						echo "<td>".$value->getPermissao()->getNivel()."</td>";
						echo "<td>
										<a class='glyphicon glyphicon-pencil'
											href='editarFuncionario?id=".$value->getIdFuncionario()."'/>
									</td>";
						echo "<td>
										<a class='glyphicon glyphicon-trash actions'
											href='excluirFuncionario?id=".$value->getIdFuncionario()."'/>
									</td>";
					echo "</tr>";
				}
			?>
			</table>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';		
 ?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.visualizarFuncionario').addClass('active');
    });
</script>