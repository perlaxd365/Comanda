<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
	.input {
		height: 150px;
	}
</style>
<div class="latest-news mt-80 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-6">



				<h3 class="font-weight-bold text-center">Nuevo Pedido</h3><br>

				<script>
					$(function() {
						$('#formulario').submit(function(ev) {
							ev.preventDefault();
							var usuario = document.getElementById('nroHombres').value;
							var mujeres = document.getElementById('nroMujeres').value;
							var ninios = document.getElementById('nroNinios').value;
							var piso = document.getElementById('piso-reg').value;
							if (usuario == 0 && mujeres == 0 && ninios == 0) {

								document.getElementById("alertaPersona").style.display = "block";
								$('#alertaPersona').fadeIn();
								setTimeout(function() {
									$("#alertaPersona").fadeOut();
								}, 1000);
								return;
							} else {

								if (piso == 0) {
									document.getElementById("alertaPiso").style.display = "block";
									$('#alertaPiso').fadeIn();
									setTimeout(function() {
										$("#alertaPiso").fadeOut();
									}, 1000);
								} else {

									this.submit();

								}

							}
						});



					});
				</script>
				<form action="<?php echo SERVERURL ?>selProducto" id="formulario" method="POST" class="needs-validation">
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Cliente</span>
								</div>
								<input autocomplete="off" autofocus style="height:40px" name="cliente" id="cliente" type="text" class="form-control" id="validationTooltipUsername" placeholder="Nombres del cliente" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Hombres</span>
								</div>
								<input onClick="this.select();"  style="height:40px" name="nroHombres" id="nroHombres" minlength="0" max="20" type="Number" class="form-control" id="validationTooltipUsername" value="0" placeholder="Número de  hombres" min="0" max="10" aria-describedby="validationTooltipUsernamePrepend" >

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Mujeres</span>
								</div>
								<input onClick="this.select();"  style="height:40px" name="nroMujeres" id="nroMujeres" minlength="0" max="20" type="Number" class="form-control" id="validationTooltipUsername" value="0" placeholder="Número de mujeres" min="0" max="10" aria-describedby="validationTooltipUsernamePrepend">

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Niños</span>
								</div>
								<input onClick="this.select();"  style="height:40px" name="nroNinios" id="nroNinios" minlength="0" max="20" type="number" class="form-control" id="validationTooltipUsername" value="0" placeholder="Número de niños" min="0" max="10" aria-describedby="validationTooltipUsernamePrepend">

							</div>
						</div>

						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Seleccionar Piso y Mesa</span>
								</div>
								<button type="button" onclick="abrirModal()" class="btn btn-outline-primary">Buscar</button>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Piso</span>
								</div>
								<input style="height:40px" value="<?php if (isset($_POST["piso"])) {
																		echo $_POST["piso"];
																	} ?>" type="number" name="piso" id="piso-reg" readonly class="form-control" id="validationTooltipUsername" value="0" placeholder="" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Mesa</span>
								</div>
								<input style="height:40px" value="<?php if (isset($_POST["mesa"])) {
																		echo $_POST["mesa"];
																	} ?>" type="number" name="mesa" id="mesa-reg" readonly class="form-control" id="validationTooltipUsername" value="0" placeholder="" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
					</div>

					<div class="btn-group mr-2" role="group" aria-label="Second group">
						<button type="submit" class="btn btn-primary">Siguiente</button>

					</div>
					<div class="btn-group" role="group" aria-label="Third group"><button class="btn btn-secondary" id="cancelarBoton" type="submit">Cancelar</button>

					</div>
					<br>
					<br>
					<div id="alerta" style="display: none;">
						<div class="alert alert-success" role="alert">Se seleccionó correctamente</div>
					</div>
					<div id="alertaPersona" style="display: none;">
						<div class="alert alert-danger" role="alert">Debe existir minimo una persona para continuar</div>
					</div>

					<div id="alertaPiso" style="display: none;">
						<div class="alert alert-danger" role="alert">Debe seleccionar un Piso y una Mesa</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<br>
<br>
<!-- breadcrumb-section -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Seleccionar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<style>
					tr:hover {
						background-color: #D9D9D9;
						cursor: pointer
					}
				</style>

				<div class="col-md-12 mb-3">
					<div class="input-group">
						<div class="input-group-prepend">
						</div>
						<select onchange="listarMesas(this)" class="custom-select">
							<option selected>Abrir para seleccionar Piso</option>

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
					</div>
				</div>

				<!-- end cart -->


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>







<script>
	function abrirModal() {

		$('#exampleModal').modal('show');
	}

	function enviarDatos(piso, mesa) {
		$('#piso-reg').val(piso);
		$('#mesa-reg').val(mesa);
		$('#cerrar').click();


	}

	function seleccionMesa() {

		document.getElementById("alerta").style.display = "block";
		$('#alerta').fadeIn();
		setTimeout(function() {
			$("#alerta").fadeOut();
		}, 1000);
	}


	document.getElementById("cancelarBoton").addEventListener("click", function(event) {
		event.preventDefault();
		window.location='<?php echo SERVERURL?>home';
	});



	function listarMesas(id) {

		var id = id.value;
		$.ajax({
			url: "<?php echo SERVERURL; ?>ajax/mesaAjax.php",
			method: "POST",
			data: {
				"idMesa": id,
				"opcion": "seleccionar"
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