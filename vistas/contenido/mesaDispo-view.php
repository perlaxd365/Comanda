<div class="cart-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap"> 

					<h3 class="font-weight-bold text-center">Disponibilidad de Mesa</h3><br>

					<select onchange="listarMesas(this)" class="custom-select">
						<option value="" selected>Abrir para seleccionar Piso</option>

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


					<div id="listarMesa">

					</div>

<br>
					<div class="">
						<a href="javascript:history.back()" class="boxed-btn black">Volver</a>
					</div>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>


				</div>
			</div>
		</div>
	</div>



	<script>

		function listarMesas(id) {

			var id=id.value;
			$.ajax({
				url: "<?php echo SERVERURL; ?>ajax/mesaAjax.php",
				method: "POST",
				data: {
					"idMesa": id,
					"opcion": "listar"
				},
				error: function(){
					$("#listarMesa").attr("disabled", false);
					$("#listarMesa").html(respuesta);
				},
				success: function(respuesta) {
					$("#listarMesa").attr("disabled", false);
					$("#listarMesa").html(respuesta);
				}
			})
		}
	</script>