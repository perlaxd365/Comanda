<script>
window.onload = function() {
  imprimirValor();
}

</script>
<div class="cart-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap">

					<h3 class="font-weight-bold text-center">Pedidos Activos </h3><br>


					<select id="" onchange="pedidoActivo(this)" class="custom-select">
						<option selected value="">Abrir para seleccionar Piso</option>

						<?php

						$result = mainModel::ejecutar_consulta_simple("SELECT DISTINCT ambien_piso FROM comand_ambiente WHERE empr_codigo='01' and locale_codigo=1 and ambien_vigencia='SI'");
						while ($filas = odbc_fetch_array($result)) {

						?>
							<option value="<?php echo $filas["ambien_piso"]; ?>">Piso Número <?php echo $filas["ambien_piso"]; ?></option>
						<?php
						}

						?>
					</select>
					<br>
					<br>
					<br>
					<div id="loading" style="display: none;">
						<img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/loading.gif" alt="">
					</div>
					<div id="listarMesa">
					</div>
						<br>

						<div class="cart-buttons">
							<a href="javascript:window.location='<?php echo SERVERURL?>home';" class="boxed-btn black">Volver</a>
						</div>
						<br>
						<br>


					</div>
				</div>
			</div>
		</div>




		<script>
			function pedidoActivo(piso) {

				var ambien_piso = piso.value;
				var comper = "<?php echo $_SESSION['comper_codigo'] ?>";
				$.ajax({
					url: "<?php echo SERVERURL; ?>ajax/mesaAjax.php",
					method: "POST",
					data: {
						"ambien_piso": ambien_piso,
						"comper_codigo": comper
					},
					beforeSend: function() {
						document.getElementById("loading").style.display = "block";
					},
					error: function(respuesta) {
						document.getElementById("loading").style.display = "none";
						$("#listarMesa").attr("disabled", false);
						$("#listarMesa").html(respuesta);
					},
					success: function(respuesta) {
						document.getElementById("loading").style.display = "none";
						$("#listarMesa").attr("disabled", false);
						$("#listarMesa").html(respuesta);
					}
				})
			}
		</script>