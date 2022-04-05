<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
if (isset($_POST["comcom_codigo"])) {

	require_once "./controladores/comandaControlador.php";
	$classDoc = new comandaControlador();
	$est = $classDoc->data_comanda_controlador($_POST["comcom_codigo"]);
	$filesL = $classDoc->data_comanda_detalle_controlador($_POST["comcom_codigo"]);
	$numeroFilas = $classDoc->data_comanda_detalle_controlador($_POST["comcom_codigo"]);
	$contadorFilas = 0;
	while ($item = odbc_fetch_array($numeroFilas)) {
		if ($item["cocode_atendido"] == "SI") {
			$contadorFilas++;
		}
	}

	while ($estatico = odbc_fetch_array($est)) {
		$comcom_codigo = $estatico["comcom_codigo"];
		$comcom_apenom = $estatico["comcom_cliente_apenom"];
		$mesa = $estatico["comcom_mesas"];
	}


?>


	<!-- check out section -->
	<div class="checkout-section mt-80 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">

					<div class="card-header row">
						<div class="col-7">

							<h6 class="font-weight-bold">Detalle Pedido de : <a href="#"><?php echo $comcom_apenom; ?></a> - Mesa : <a href="#"><?php echo $mesa; ?></a> </h6>

							Acción: Eliminar <button type="submit" class="btn btn-outline-danger btn-sm">x</button> , Cortesía <button type="submit" class="btn btn-outline-success btn-sm">✓</button><br><br>

							Estado: Espera <button type="button" class="btn btn-outline-danger btn-sm">E</button> , Atendido <button type="button" class="btn btn-outline-success  btn-sm">A</button>

						</div>
						<div class="col-5" style="padding-top: 40px; padding-left: 100px;">
							<?php
							if ($contadorFilas == 0) {
							?>
								<form action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="deleteComanda" class="cortesiaAjax" autocomplete="off" enctype="multipart/form-data">
									<input type="hidden" name="comcom_codigo_eliminar_comanda" value="<?php echo $comcom_codigo; ?>">

									<input type="hidden" name="usua_codigo_eliminar_comanda" value="<?php echo $_SESSION['usua_codigo']; ?>">
									<button type="submit" class="btn btn-outline-danger">Eliminar comanda <img width="20" height="20" src="https://cdn-icons-png.flaticon.com/512/812/812853.png" alt=""></button>
								</form>
							<?php
							} else {
							?>
								<button type="button" onclick="eliminarComanda('<?php echo $comcom_codigo; ?>', '<?php echo $_SESSION['usua_codigo']; ?>')" class="btn btn-outline-danger">Eliminar comanda <img width="20" height="20" src="https://cdn-icons-png.flaticon.com/512/812/812853.png" alt=""></button>

							<?php
							}
							?>



						</div>
					</div>

					<div style="overflow-y:scroll;height:600px;">
						<table style="height: 300px;" class="total-table">



							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>ID</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Obs.</th>
									<th>Estado</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$contador = 0;
								$total = 0;
								while ($rows = odbc_fetch_array($filesL)) {
									$contador++;
									$total = $total + ((int)$rows["cocode_cantidad"] * $rows["cocode_precio_soles"]);
								?>
									<tr class="total-data total-data-1">
										<td style="width:1px"><strong><?php echo $contador; ?></strong></td>
										<td style="width:750px;"><strong><?php echo $rows["cocode_producto"]; ?></strong><br>S/ <?php echo utf8_encode(mainModel::moneyFormat($rows["cocode_precio_soles"], "USD")) ?></td>
										<td class="text-center">
											<form name="formCantidadProductos" action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="cantidad" class="cortesiaAjax" autocomplete="off" enctype="multipart/form-data">
												<input type="hidden" name="comcom_codigo" value="<?php echo $rows["comcom_codigo"]; ?>">
												<input type="hidden" name="cocode_item" value="<?php echo $rows["cocode_item"]; ?>">
												<input type="hidden" name="actualizar_cantidad">
												<input min="1" ng-click="enviarForm();" name="cantidad_productos" style="height:30px; width : 50px;" type="number" class="form-control" value="<?php echo (int)$rows["cocode_cantidad"] ?>">
												<input hidden type="submit" id="botonForm">
											</form>
										</td>

										<td><button type="button" onclick='llenarObser(<?php echo $rows["comcom_codigo"] ?>,<?php echo $rows["cocode_item"]; ?>);' class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">+</button></td>
										<td>
											<?php if ($rows["cocode_atendido"] == "SI") {
											?>
												<button type="button" class="btn btn-outline-success">A</button>
											<?php
											} else {
											?>
												<button type="button" class="btn btn-outline-danger">E</button>
											<?php
											} ?>

										</td>
										<td>
											<div class="row">

												<?php if ($rows["cocode_atendido"] == "SI" && $rows["cocode_enviado"] == "SI") {
												?>

													<button type="button" onclick="eliminarProductoAtendido('<?php echo $rows['comcom_codigo']; ?>','<?php echo $rows['cocode_item']; ?>','<?php echo $_SESSION['usua_codigo']; ?>');" class="btn btn-outline-danger">x</button>


												<?php
												} else {
												?>
													<form action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="delete" class="cortesiaAjax" autocomplete="off" enctype="multipart/form-data">
														<input type="hidden" name="comcom_codigo" value="<?php echo $rows["comcom_codigo"]; ?>">
														<input type="hidden" name="cocode_item" value="<?php echo $rows["cocode_item"]; ?>">
														<input type="hidden" name="usua_codigo" value="<?php echo $_SESSION['usua_codigo']; ?>">
														<input type="hidden" name="eliminarProducto">
														<button type="submit" class="btn btn-outline-danger">x</button>
													</form>
												<?php
												} ?>

												<form action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="save" class="cortesiaAjax" autocomplete="off" enctype="multipart/form-data">
													<input type="hidden" name="comcom_codigo" value="<?php echo $rows["comcom_codigo"]; ?>">
													<input type="hidden" name="cocode_item" value="<?php echo $rows["cocode_item"]; ?>">
													<input type="hidden" name="cocode_cortesia" value="<?php echo $rows["cocode_cortesia"]; ?>">
													<input type="hidden" name="cortesiaProducto">
													<button type="submit" class="btn btn-outline-success <?php if ($rows["cocode_cortesia"] == "SI") {
																												echo 'active';
																											} ?>">✓</button>
												</form>
											</div>
											<div class="RespuestaAjax" id="RespuestaAjax">
											</div>

										</td>
									</tr>

								<?php

								}
								if ($contador == 0) {
								?>

									<tr>

										<td colspan="6">
											<div class="alert alert-warning" role="alert">
												A la espera de nuevos productos.
											</div>
										</td>
									</tr>
								<?php
								} else {
								?>
									<tr class="total-data total-data-1">

										<td colspan="6" style="width:1px"><strong>TOTAL:</strong> S/ <?php echo mainModel::moneyFormat($total, "USD"); ?></td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<!--Código jQuery con la función borrarLibro-->
					<script>
						function borrar(id) {
							//Seleccionamos los elementos de la clase libro
							$(".total-data-" + id).remove();

						}
					</script>



				</div>
			</div>
			<br>
			<div class="row">
				<input type="submit" onclick="window.location='<?php echo SERVERURL ?>pedActivoList';" style="color: white; " class="black" value="Atrás">

				<form action="<?php echo SERVERURL ?>selProducto" method="post">
					<input hidden type="text" name="comcom_codigo" value="<?php echo $comcom_codigo ?>">
					<input type="submit" style="color: white;" class="boxed-btn black" value="Agregar">
				</form>
				<?php
				if ($contador > 0) {
				?>
					<form action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="save" class="FormularioPrecuentaAjax" autocomplete="off" enctype="multipart/form-data">

						<input hidden type="text" name="comcom_codigo_precuenta" value="<?php echo $comcom_codigo ?>">
						<input type="submit" style="color: white;" class="boxed-btn black" value="Precuenta">
					</form>
				<?php
				}
				?>

				<div id="RespuestaAjax" class="RespuestaAjax"></div>
			</div>
		</div>
	</div>
	</div>
	<br>




	</div>
	</div>
	</div>
	<!-- end check out section -->
	<br>
	<br>
	<br>

	<!-- Modal -->
	<div class="modal fade" id="modalObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registrar Observación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="loading" style="display: none;">
						<img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/loading.gif" alt="">
					</div>
					<div id="observacionTexto"></div>
				</div>
			</div>
		</div>
	</div>
<?php
} else {

	echo '<div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">

                                    <div class="form-group row showcase_row_area">
                                                    <div class="col-3 showcase_text_area">
                                                       <br>
                                                    </div>
                                                    <div class="col-6 showcase_content_area">
                                                    <h4>No existe Pedido</h4>

                                                    </div>
                                               

                                        
                                    </div>
                                </div>
                            </div>
                        </div>';
}
?>

<script>
	function eliminarProductoAtendido(comcom_codigo, cocode_item, usua_codigo) {
		swal({
			title: 'Producto Atendido',
			text: 'Necesitas permiso de administrador para cancelar producto',
			input: 'password',
			showCancelButton: true,
			confirmButtonText: 'Cancelar Producto',
			type: 'warning',
			showLoaderOnConfirm: true,
			preConfirm: function(email) {
				return new Promise(function(resolve, reject) {
					setTimeout(function() {
						if (email === 'taken@example.com') {
							reject('This email is already taken.')
						} else {
							resolve()
						}
					}, 2000)
				})
			},
			allowOutsideClick: false
		}).then(function(claveInput) {



			var url = "ajax/comandaAjax.php";
			$.ajax({
				type: 'POST',
				url: url,
				data: {
					eliminar_atendido: 'SI',
					clave: claveInput,
					comcom_codigo_atendido: comcom_codigo,
					cocode_item_atendido: cocode_item,
					usua_codigo_atendido: usua_codigo

				},
				error: function() {
					$("#RespuestaAjax").attr("disabled", false);
					$("#RespuestaAjax").html(respuesta);
				},
				success: function(respuesta) {
					$("#RespuestaAjax").attr("disabled", false);
					$("#RespuestaAjax").html(respuesta);
				}
			})


		})

	}

	function eliminarComanda(comcom_codigo, usua_codigo) {
		var comper_codigo = '';
		swal({
			title: 'Existen productos atendidos',
			text: 'Necesitas permiso de administrador.',
			input: 'password',
			showCancelButton: true,
			confirmButtonText: 'Cancelar Producto',
			type: 'warning',
			showLoaderOnConfirm: true,
			preConfirm: function(pass) {
				return new Promise(function(resolve, reject) {
					setTimeout(function() {

						var url = "ajax/comandaAjax.php";
						$.ajax({
							type: 'POST',
							url: url,
							data: {
								clave_verficar: pass

							},
							error: function() {
								$("#RespuestaAjax").attr("disabled", false);
								$("#RespuestaAjax").html(respuesta);
							},
							success: function(respuesta) {
								if (respuesta === "error") {
									swal(
										'Error',
										'Usuario no existente / No tiene permisos',
										'warning'
									)
								} else {

									comper_codigo=respuesta;
									resolve();

								}
							}
						})
					}, 2000)
				})
			},
			allowOutsideClick: false
		}).then(function(claveInput) {



			var url = "ajax/comandaAjax.php";
			$.ajax({
				type: 'POST',
				url: url,
				data: {
					comcom_codigo_eliminar_comanda: comcom_codigo,
					usua_codigo_eliminar_comanda: usua_codigo,
					admin_codigo_eliminar: comper_codigo,
					clave: claveInput

				},
				error: function() {
					$("#RespuestaAjax").attr("disabled", false);
					$("#RespuestaAjax").html(respuesta);
				},
				success: function(respuesta) {
					$("#RespuestaAjax").attr("disabled", false);
					$("#RespuestaAjax").html(respuesta);
				}
			})


		})

	}

	function enviarForm() {
		document.getElementById("botonForm").click();
	}

	function llenarObser(codigo, item) {
		$.ajax({
			url: "<?php echo SERVERURL; ?>ajax/comandaAjax.php",
			method: "POST",
			data: {
				"comandaObser": codigo,
				"item": item
			},
			beforeSend: function() {
				document.getElementById("loading").style.display = "block";
			},
			error: function(respuesta) {
				document.getElementById("loading").style.display = "none";
				$("#observacionTexto").attr("disabled", false);
				$("#observacionTexto").html(respuesta);
			},
			success: function(respuesta) {
				document.getElementById("loading").style.display = "none";
				$("#observacionTexto").attr("disabled", false);
				$("#observacionTexto").html(respuesta);
			}
		})
	}

	function guardarObservación(codigo, item) {


		var observacion = document.getElementsByName("obs_up")[0].value;


		$.ajax({
			url: "<?php echo SERVERURL; ?>ajax/comandaAjax.php",
			method: "POST",
			data: {
				"codigo_comanda": codigo,
				"item": item,
				"observacion": observacion,
				"actualizar_observacion": "si"
			},
			beforeSend: function() {
				document.getElementById("loading").style.display = "block";
			},
			error: function(respuesta) {
				$('#modalObservacion').modal('hide')
				document.getElementById("loading").style.display = "none";
				$("#observacionTexto").attr("disabled", false);
				$("#observacionTexto").html(respuesta);
			},
			success: function(respuesta) {
				$('#modalObservacion').modal('hide')
				document.getElementById("loading").style.display = "none";
				$("#observacionTexto").attr("disabled", false);
				$("#observacionTexto").html(respuesta);
			}
		})
	}
</script>