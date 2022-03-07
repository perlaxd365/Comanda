
	

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						         Detalles de Pedido
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
						        	
								
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Nombre de Producto</th>
									<th>Cantidad</th>
									<th>Detalle</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data total-data-1">
									<td><strong>Ronda Marina </strong></td>
									<td><input type="number" class="form-control" value="2"></td>	
									<td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></td>
									<td><button type="button" onclick="borrar(1)" class="btn btn-outline-danger">x</button></td>

								</tr>
								<tr class="total-data total-data-2">
									<td><strong>Parrillada </strong></td>
									<td><input type="number" class="form-control" value="1"></td>
									<td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></td>
									
									<td><button type="button" onclick="borrar(2)" class="btn btn-outline-danger">x</button></td>

								</tr>
								<tr class="total-data total-data-3">
									<td><strong>Ceviche </strong></td>
									<td><input type="number" class="form-control" value="3"></td>
									<td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></td>
									
									<td><button type="button" onclick="borrar(3)" class="btn btn-outline-danger">x</button></td>
								</tr>
							</tbody>
						</table>
						<!--Código jQuery con la función borrarLibro-->
						<script>
							function borrar(id) {
								//Seleccionamos los elementos de la clase libro
								$(".total-data-" + id).remove();
								
							}
						</script>
								


						        </div>
						      </div>
						    </div>
						  </div>
						<a href="javascript:history.back()">Atras</a>
						</div>
						<div class="cart-buttons">
							<a href="<?php echo SERVERURL ?>selProductoPreCuenta" class="boxed-btn">Agregar</a>
							<a href="<?php echo SERVERURL ?>home" class="boxed-btn black">Cortesia</a>
							<a href="<?php echo SERVERURL ?>home" class="boxed-btn black">Precuenta</a>
						</div>

					</div>
				</div>

				
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
				<h5 class="modal-title" id="exampleModalLabel">Registrar Observacion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-inline">
					<div class="form-group col-12">
						<label for="inputPassword2" class="sr-only">Observaciones</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
						<button type="button" class="btn btn-primary">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>