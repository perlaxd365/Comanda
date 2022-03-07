<div class="cart-section mt-100 mb-150">
	<div class="container">

		<div class="card">
			<div class="card-header">
				Registro de Nuevo Pedido
			</div>
			<div class="card-body">
				<blockquote class="blockquote mb-0">
					<p>Seleccionar pedido para la Mesa (4) del Piso (1)</p><!-- 
					<footer class="blockquote-footer"> <cite title="Source Title"> </cite></footer> -->
				</blockquote>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap">

					<nav class="navbar navbar-light bg-light">

						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Línea</span>
								</div><select class="custom-select">
									<option selected>Seleccionar</option>
									<option value="1">Uno</option>
									<option value="2">Dos</option>
									<option value="3">trees</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Sub Línea</span>
								</div><select class="custom-select">
									<option selected>Seleccionar</option>
									<option value="1">Uno</option>
									<option value="2">Dos</option>
									<option value="3">trees</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">Buscar</span>
								</div>

								<input class="form-control btn-mg" type="search" placeholder="Buscar" aria-label="Search">
							</div>
						</div>
					</nav>

					<br>
					<style>
						tr {
							cursor: pointer
						}

						thead tr th {
							position: sticky;
							top: 0;
							z-index: 10;
							background-color: #ffffff;
						}

					</style>
					<div style="overflow-y:scroll;height:300px;">
						<table style="height: 200px;" class="table tabla-productos" id="tabla-productos">
							<thead class="thead-dark">
								<tr>
									<th scope="col" class="text-center">ID</th>
									<th scope="col" class="text-center">Producto</th>
									<th scope="col" class="text-center">Precio S/</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="1" id="id">1</td>
									<td id="nombre">POLLO A LA BRASA CON TODAS SUS CREMAS</td>
									<td id="precio">60.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">2</td>
									<td id="nombre">1 INKACOLA DE 1L (SIN AZUCAR)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">3</td>
									<td id="nombre">Menú de McDonalds, Burger King o similar</td>
									<td id="precio">30.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">4</td>
									<td id="nombre">Agua (botella de 33 cl)</td>
									<td id="precio">2.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">5</td>
									<td id="nombre">Café Cappuccino</td>
									<td id="precio">15.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">6</td>
									<td id="nombre">Comida para 2 personas</td>
									<td id="precio">44.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">7</td>
									<td id="nombre">Perrier Water (botella pequeña 0,33l)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">8</td>
									<td id="nombre">Bollo de pan blanco fresco (500g)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">9</td>
									<td id="nombre">Queso (1kg)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">10</td>
									<td id="nombre">Redondo de ternera (1kg)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">11</td>
									<td id="nombre">Salchichas (1kg)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">12</td>
									<td id="nombre">Requesón (1 kg)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">13</td>
									<td id="nombre">Arroz (blanco) (1kg)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">14</td>
									<td id="nombre">Pechugas de pollo (sin piel y sin espinas) - (1 kg)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
								<tr>
									<td id="id">15</td>
									<td id="nombre">Botella de vino (gama media)</td>
									<td id="precio">10.00</td>
									<td class="boton"><button type="button" class="btn btn-outline-dark">Agregar</button></td>

								</tr>
							</tbody>
						</table>
					</div>


					<div class="row">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="pagination-wrap">
								<ul>
									<li><a href="#">Anterior</a></li>
									<li><a href="#">1</a></li>
									<li><a class="active" href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">Siguiente</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="total-section">

				<h6 class="font-weight-bold">Detalle Pedido</h6>
						<label><TEXT>Eliminar(x), Cortesía (✓)</TEXT></label>
					<div id="alerta" style="display: none;">
						<div class="alert alert-success" role="alert">Se agregó pedido correctamente</div>
					</div>
					<div id="hola" style="display: none;">
						<div class="alert alert-danger" role="alert">Se eliminó correctamente</div>
					</div>
					<table class="table total-table">
						<thead class="total-table-head thead-dark">
							<tr class="table-total-row">
								<th>ID</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody id="nuevoform">
						</tbody>
					</table>
					<!--Código jQuery con la función borrarLibro-->
					<script>
						function borrar(id) {
							//Seleccionamos los elementos de la clase libro
							$(".total-data-" + id).remove();
						}
					</script>
					<br>
					<div class="">
						<a  href="javascript:history.back()" class="boxed-btn black">Cancelar</a>
						<a href="<?php echo SERVERURL ?>home"  class="boxed-btn">Enviar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- search area -->



</body>

</html>


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