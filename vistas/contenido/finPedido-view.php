<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
if (isset($_POST["comcom_codigo"])) {



	require_once "./controladores/comandaControlador.php";
	$classDoc = new comandaControlador();
	$est = $classDoc->data_comanda_controlador($_POST["comcom_codigo"]);
	$filesL = $classDoc->data_comanda_controlador($_POST["comcom_codigo"]);

	while ($estatico = odbc_fetch_array($est)) {
		$comcom_codigo = $estatico["comcom_codigo"];
		$comcom_apenom = $estatico["comcom_cliente_apenom"];
		$mesa = $estatico["comcom_mesas"];
	}


?>


	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">

					<div class="card-header">
						<h6 class="font-weight-bold">Detalle Pedido de : <a href="#"><?php echo $comcom_apenom; ?></a> - Mesa : <a href="#"><?php echo $mesa; ?></a> </h6>
						Eliminar <TEXT style="color: red;">(x)</TEXT> , Cortesía <TEXT style="color: green;"> (✓)</TEXT><br>
						Espera <TEXT style="color: red;">(E)</TEXT> , Atendido <TEXT style="color: green;"> (A)</TEXT>
					</div>

					<div style="overflow-y:scroll;height:400px;">
						<table style="height: 200px;" class="total-table">


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
								while ($rows = odbc_fetch_array($filesL)) {
									$contador++;
								?>
									<tr class="total-data total-data-1">
										<td style="width:1px"><strong><?php echo $contador; ?></strong></td>
										<td style="width:750px;"><strong><?php echo $rows["cocode_producto"]; ?></strong></td>
										<td class="text-center">
											<input min="1" style="height:40px; width : 50px;" type="number" class="form-control" value="<?php echo (int)$rows["cocode_cantidad"] ?>">
										</td>

										<td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">+</button></td>
										<td><button type="button" class="btn btn-outline-success">A</button></td>
										<td>
											<div class="row">
												<form action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="delete" class="cortesiaAjax" autocomplete="off" enctype="multipart/form-data">

													<button type="submit" name="comcom_codigo" value="<?php echo $rows["comcom_codigo"]; ?>" class="btn btn-outline-danger">x</button>
												</form>
												<form action="<?php echo SERVERURL; ?>ajax/comandaAjax.php" method="POST" data-form="save" class="cortesiaAjax" autocomplete="off" enctype="multipart/form-data">
													<input type="hidden" name="comcom_codigo" value="<?php echo $rows["comcom_codigo"]; ?>">
													<input type="hidden" name="cocode_item" value="<?php echo $rows["cocode_item"]; ?>">
													<button type="submit" class="btn btn-outline-success <?php if($rows["cocode_cortesia"]=="SI"){echo'active';} ?>">✓</button>
												</form>
											</div>
											<div class="RespuestaAjax" id="RespuestaAjax">
											</div>

										</td>
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
			<br>
			<div class="row">
				<a href="javascript:history.back()" class="boxed-btn black">Volver</a>
				<form action="<?php echo SERVERURL ?>selProducto" method="post">
					<input hidden type="text" name="comcom_codigo" value="<?php echo $comcom_codigo ?>">
					<input type="submit" class="boxed-btn black" value="Agregar">
				</form>
				<a href="<?php echo SERVERURL ?>home" class="boxed-btn black">Precuenta</a>
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
					<form class="form-inline">
						<div class="form-group col-12">
							<label for="inputPassword2" class="sr-only">Observaciones</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="100"></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-primary">Guardar</button>
					</form>
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