<style>
	.input {
		height: 150px;
	}
</style>
<div class="latest-news mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-6">
				<div id="alerta" style="display: none;">
					<div class="alert alert-success" role="alert">Se seleccionó correctamente</div>
				</div>
				<h3 class="font-weight-bold text-center">Nuevo Pedido</h3><br>
				<form action="<?php echo SERVERURL ?>selProducto" class="needs-validation" novalidate>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Hombres</span>
								</div>
								<input style="height:40px" type="Number" class="form-control" id="validationTooltipUsername" value="0" placeholder="Número de  hombres" min="0" max="10" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Mujeres</span>
								</div>
								<input style="height:40px" type="Number" class="form-control" id="validationTooltipUsername" value="0" placeholder="Número de mujeres" min="0" max="10" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Niños</span>
								</div>
								<input style="height:40px" type="number" class="form-control" id="validationTooltipUsername" value="0" placeholder="Número de niños" min="0" max="10" aria-describedby="validationTooltipUsernamePrepend" required>

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
								<input style="height:40px" type="number" id="piso-reg" readonly class="form-control" id="validationTooltipUsername" value="0" placeholder="" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Mesa</span>
								</div>
								<input style="height:40px" type="number" id="mesa-reg" readonly class="form-control" id="validationTooltipUsername" value="0" placeholder="" aria-describedby="validationTooltipUsernamePrepend" required>

							</div>
						</div>
					</div>

					<div class="btn-group mr-2" role="group" aria-label="Second group">
						<button class="btn btn-primary" type="submit">Siguiente</button>

					</div>
					<div class="btn-group" role="group" aria-label="Third group"><button class="btn btn-secondary" id="cancelarBoton" type="submit">Cancelar</button>

					</div>

				</form>
			</div>
		</div>
	</div>
</div>

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
					}
				</style>

				<div class="col-md-12 mb-3">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="validationTooltipUsernamePrepend">Piso</span>
						</div>
						<select class="custom-select" id="nroPiso" name="nroPiso">
							<option selected>Seleccionar Piso</option>
							<option value="1">Primer Piso</option>
							<option value="2">Segundo Piso</option>
							<option value="3">Tercer Piso</option>
						</select>
					</div>
				</div>

				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nombre de Mesa</th>
							<th scope="col">Estado</th>
						</tr>
					</thead>
					<tbody>
						<tr onclick="enviarDatos(); seleccionMesa();">
							<th scope="row">1</th>
							<td onclick="">Mesa 1</td>
							<td>
								<button type="button" class="btn btn-outline-success">Disponible</button>
							</td>
						</tr>
						<tr onclick="enviarDatos(); seleccionMesa();">
							<th scope="row">2</th>
							<td>Mesa 2</td>
							<td>
								<button type="button" class="btn btn-outline-success">Disponible</button>
							</td>
						</tr>
						<tr onclick="enviarDatos(); seleccionMesa();">
							<th scope="row">3</th>
							<td>Mesa 3</td>
							<td>
								<button type="button" class="btn btn-outline-danger">Ocupada</button>
							</td>
						</tr>

					</tbody>
				</table>
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

	function enviarDatos() {
		var dato = document.getElementsByName("nroPiso")[0].value;
		$('#piso-reg').val(dato);
		$('#mesa-reg').val(dato);
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
		javascript: history.back();
	});
</script>