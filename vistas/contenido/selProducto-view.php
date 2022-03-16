<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="cart-section mt-100 mb-150">
	<div class="container">

		<div class="card">
			<div class="card-header">
				Registro de Nuevo Pedido
			</div>
			<div class="card-body">
				<blockquote class="blockquote mb-0">
					<p>Seleccionar pedido para la Mesa (4) del Piso (1)</p>
					<!-- 
					<footer class="blockquote-footer"> <cite title="Source Title"> </cite></footer> -->
				</blockquote>
			</div>
		</div>
		<br>

		<script>
			$(function() {
				$('#datosBusqueda').submit(function(ev) {

					ev.preventDefault();
					$.ajax({
						type: $('#datosBusqueda').attr('method'),
						url: $('#datosBusqueda').attr('action'),
						data: $('#datosBusqueda').serialize(),
						beforeSend: function() {
							document.getElementById("loading").style.display = "block";
						},
						success: function(data) {
							document.getElementById("loading").style.display = "none";
							$("#RespuestaAjax").attr("disabled", false);
							$("#RespuestaAjax").html(data);
						}
					});
				});



			});
		</script>
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap">

					<form id="datosBusqueda" name="datosBusqueda" method="POST" action="<?php echo SERVERURL ?>ajax/productoAjax.php" enctype="multipart/form-data">

						<nav class="navbar navbar-light bg-light">

							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="validationTooltipUsernamePrepend">Línea</span>
									</div>
									<select onchange="listar_sublinea(this);" name="buscar_linea" class="custom-select">
										<option selected>Seleccionar Línea</option>


										<?php require_once './controladores/productoControlador.php';
										$producto = new productoControlador();

										echo $producto->listar_prod_linea_controlador();

										?>
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="validationTooltipUsernamePrepend">Sub Línea</span>
									</div>
									<select id="datos_sublinea" name="buscar_sublinea" class="custom-select">
										<option selected>Seleccionar Sublínea</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="validationTooltipUsernamePrepend">Buscar</span>
									</div>

									<input class="form-control btn-mg" name="busqueda" type="search" placeholder="Buscar" aria-label="Search">
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="input-group">
									<button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
								</div>
							</div>
						</nav>
					</form>

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

					<div id="loading" style="display: none;">
						<img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/loading.gif" alt="">
					</div>

					<div class="RespuestaAjax" id="RespuestaAjax"></div>


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
					<table class="table total-table" id="tablaDetalle">
						<thead class="total-table-head thead-dark">
							<tr class="table-total-row">
								<th>ID</th>
								<th>Producto</th>
								<th>Obs</th>
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
						<a href="javascript:history.back()" class="boxed-btn black">Cancelar</a>
						<a href="<?php echo SERVERURL ?>verPedido" class="boxed-btn black">Ver Pedido</a>
						<a href="<?php echo SERVERURL ?>home" class="boxed-btn">Enviar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- search area -->

<br>

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

<script>
	function listar_sublinea(id) {

		var id_linea = id.value;
		$.ajax({
			url: "<?php echo SERVERURL; ?>ajax/productoAjax.php",
			method: "POST",
			data: {
				"id_linea": id_linea
			},
			success: function(respuesta) {
				$("#datos_sublinea").attr("disabled", false);
				$("#datos_sublinea").html(respuesta);
			}
		})
	}



	function vistaprevia(nrotabla) {

		//variables
		var valores = "";
		var a = 0;
		var contador = 0;
		var id_producto = new Array();
		var nombreDetalle = new Array();
		var precioDetalle = new Array();

		// capturamos la fila que seleccionamos y llenamos el arreglo que creamos con push

		$('#tabla-productos tr').each(function() {
			id_producto.push($(this).find("#id_producto").html());
			nombreDetalle.push($(this).find("#nombre").html());
			precioDetalle.push($(this).find("#precio").html());
		});

		//Contador para mostrar
		$('#tablaDetalle tr').each(function() {
			contador++;
		});

		//
		$("table tr").each(function() {
			a++;
		})


		var div = document.createElement('tr');
		div.className = "total-data";
		div.setAttribute("id", contador);
		div.innerHTML = '<td hidden id="id_pro">' + id_producto[nrotabla] + '</td><td>' + contador + '</td><td><strong>' + nombreDetalle[nrotabla] + ' <br> (S/ ' + precioDetalle[nrotabla] + ')</td><td><button type="button" onclick="" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">+</button></strong></td><td><input style="height:40px; width : 50px;"   type="number" class="form-control" value="1"></td><td><div class="row"><button type="button"  onclick="eliminar(' + contador + ')" class="btn btn-outline-danger">x</button>  <button type="button"  class="btn btn-outline-success">✓</button></div></td>';
		document.getElementById('nuevoform').appendChild(div);
		document.getElementById("alerta").style.display = "block";


		$('#alerta').fadeIn();
		setTimeout(function() {
			$("#alerta").fadeOut();
		}, 1000);

	};

	function eliminar(n) {
		jQuery("tr").remove(`#${n}`);
		contador = contador - 1;
		if (contador <= 0) {
			contador = 0;
		}

		document.getElementById("hola").style.display = "block";


		$('#hola').fadeIn();
		setTimeout(function() {
			$("#hola").fadeOut();
		}, 1000);

	}
</script>