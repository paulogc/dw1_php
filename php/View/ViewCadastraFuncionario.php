<?php
$titulo="Cadastrar Funcionario";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Cadastro de Funcionário</h1>
			<form action=<?php if (isset($_SESSION["flash"]["idFuncionario"])) {
													echo	"postCadastraFuncionario?id=".$_SESSION["flash"]["idFuncionario"]."";
											} else {
													echo "postCadastraFuncionario";
											}
										?>
			method="POST">
				<div class="row">
					<?php if(isset($_SESSION["flash"]["msg"])){
							if($_SESSION["flash"]["sucesso"]==false)
								echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							else{
								echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							}
						} ?>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Login:<span class="requerido">*</span></label>
							<input type="text" name="login" class="form-control" id="login" 
								value="<?php if(isset($_SESSION["flash"]["login"]))echo $_SESSION["flash"]["login"];?>">
						</div>
						<div class="form-group">
							<label for="pwd">Senha:<span class="requerido">*</span></label>
							<input type="password" name="senha" class="form-control" id="pwd" value="">
						</div>
						<div class="form-group">
							<label for="idPermissao">Permissão:<span class="requerido">*</span></label>
							<select type="text" name="idPermissao" class="form-control" id="idPermissao">
								<?php
									if(isset($_SESSION["flash"]["idPermissao"]))
										echo "<option value='".$_SESSION["flash"]["idPermissao"]."' selected>";
										echo $_SESSION["flash"]["valuePermissao"];
										echo "</option>"
								?>
								<?php
									foreach ($permissoes as $value) {
											echo "<option value=\"".$value->getIdPermissao()."\">";
											echo $value->getNivel();
											echo "</option>";
									}
								?>
							</select>
						</div>
						
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="nome">Nome:<span class="requerido">*</span></label>
							<input type="text" name="nome" class="form-control" id="nome" value="<?php if(isset($_SESSION["flash"]["nome"]))echo $_SESSION["flash"]["nome"];?>">
						</div>	
						<div class="form-group">
							<label for="salario">Salario:<span class="requerido">*</span></label>
							<input type="text" name="salario" class="form-control" id="salario" value="<?php if(isset($_SESSION["flash"]["salario"]))echo $_SESSION["flash"]["salario"];?>">
						</div>
						<div class="form-group">
							<label for="idDepartamento">Departamento:<span class="requerido">*</span></label>
							<select type="text" name="idDepartamento" class="form-control" id="idDepartamento">
								<?php
								if(isset($_SESSION["flash"]["idDepartamento"]))
									echo "<option value='".$_SESSION["flash"]["idDepartamento"]."' selected>";
									echo $_SESSION["flash"]["valueDepartamento"];
									echo "</option>"
								?>
								<?php
									foreach ($departamentos as $value) {
											echo "<option value=\"".$value->getIdDepartamento()."\">";
											echo $value->getNome();
											echo "</option>";
									}
								?>
							</select>
						</div>
					</div>
			  	</div>
			  <button type="submit" class="btn btn-default center-block">Submit</button>
			</form>
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
        $('.cadastrarFuncionario').addClass('active');
    });
</script>