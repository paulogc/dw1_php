	<div><h5 class="text-center" style="color: black">Sistema desenvolvido por Rodrigo H. Ramos</h5></div>
	</body>
</html>
<?php if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);
		}
	}?>