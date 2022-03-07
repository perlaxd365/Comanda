

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
						        	
				<h6 class="font-weight-bold">Detalle Pedido</h6>
						<label><TEXT>Espera(E), Atendido (A)</TEXT></label>
								
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th >ID</th>
									<th >Producto</th>
									<th>Cantidad</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data total-data-1">
									<td  style="width:1px"><strong>1</strong></td>
									<td style="width:750px;"><strong>Perrier Water (botella pequeña 0,33l)</strong><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></td>
									<td class="text-center"><input   style="height:40px; width : 50px;" type="number" class="form-control" value="1"></td>	
									
									<td><button type="button" class="btn btn-outline-success" >A</button></td>
							
								</tr>
								<tr class="total-data total-data-2">
									<td><strong>2</strong></td>
									<td><strong>Pechugas de pollo (sin piel y sin espinas) - (1 kg) </strong><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></td>
									<td class="text-center"><input   style="height:40px; width : 50px;" type="number" class="form-control" value="2"></td>	
										
									<td><button type="button" class="btn btn-outline-danger" >E</button></td>
							
								</tr>
								<tr class="total-data total-data-3">
									<td><strong>3</strong></td>
									<td><strong>Botella de vino (gama media) </strong><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></td>
									<td class="text-center"><input   style="height:40px; width : 50px;" type="number" class="form-control" value="6"></td>	
											
									<td><button type="button" class="btn btn-outline-success" >A</button></td>
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
							  <br>
							  <br>
						<div class="">
							<a href="<?php echo SERVERURL?>home" class="boxed-btn black">Volver</a>
							<a href="<?php echo SERVERURL?>home" class="boxed-btn black">Enviar</a>
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