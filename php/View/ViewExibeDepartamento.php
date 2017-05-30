<?php
$titulo="Exibir Deparatamentos";
include $_SESSION["root"].'includes/header.php';
include_once $_SESSION["root"].'php/Util/Util.php';
?>

<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include "includes/menu.php" ?>
		<!-- fim menu -->	
		<div id="principal" >
			<h2 class="exibe-funcionario-title">Departamento</h2>
			<table class="table table-striped">
				<tr>
					<th>Sigla</th>
					<th>Nome</th>
				</tr>
			<?php 
				foreach ($departamentos as $value) {
					echo "<tr>";
					echo "<td>".$value->getSigla()."</td>";
					echo "<td>".$value->getNome()."</td>";
					echo "</tr>";
				}
			?>
			</table>
		</div>
	</div>	
	
</body>
<!-- add no footer -->
<?php include "includes/footer.php" ?>
<!-- fim footer -->
</html>

<script>		
	$(document).ready(function () {
        $('.visualisaDepartamento').addClass('active');
    });
</script>