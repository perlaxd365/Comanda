<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="cart-section mt-100 mb-150">
	<div class="container">
		<?php

		if (isset($_POST["piso"]) && isset($_POST["mesa"]) && isset($_POST["nroHombres"]) && isset($_POST["nroMujeres"]) && isset($_POST["nroNinios"])) {

			$piso = $_POST["piso"];
			$mesa = $_POST["mesa"];
			$nroHombres = $_POST["nroHombres"];
			$nroMujeres = $_POST["nroMujeres"];
			$nroNinios = $_POST["nroNinios"];
			$cliente = $_POST["cliente"];
		} elseif (isset($_POST["comcom_codigo"])) {

			$codigo_comanda=$_POST["comcom_codigo"];
			require_once "./controladores/comandaControlador.php";
			$claseComanda = new comandaControlador();
			$est = $claseComanda->data_comanda_controlador($codigo_comanda);

			while ($estatico = odbc_fetch_array($est)) {
				$mesa = $estatico["comcom_mesas"];
				$nroHombres = $estatico["comcom_cant_masculino"];
				$nroMujeres = $estatico["comcom_cant_femenino"];
				$nroNinios = $estatico["comcom_cant_nino"];
				$cliente = $estatico["comcom_cliente_apenom"];
				$commes_codigo = $estatico["commes_codigo"];
			}
			//OBTENER EL PISO POR EL CODIGO DE MESA
			$comanda_mesa = $claseComanda->get_piso_mesa_controlador($commes_codigo);
			$piso = $comanda_mesa["ambien_piso"];
		}
		?>
		<input hidden name="piso" value="<?php echo $piso ?>">
		<input hidden name="mesa" value="<?php echo $mesa ?>">
		<input hidden name="nroHombres" value="<?php echo $nroHombres ?>">
		<input hidden name="nroMujeres" value="<?php echo $nroMujeres ?>">
		<input hidden name="nroNinios" value="<?php echo $nroNinios ?>">
		<input hidden name="cliente" value="<?php echo $cliente ?>">
		<input hidden name="comper_codigo" value="<?php echo $_SESSION["comper_codigo"] ?>">
		<input hidden name="usua_codigo" value="<?php echo $_SESSION["usua_codigo"] ?>">
		<input hidden name="totalInputs" id="totalInputs">
		<input hidden name="codigoComanda" id="codigoComanda" value="<?php if(isset($codigo_comanda)){echo $codigo_comanda;}  ?>">

		<div class="card">
			<div class="card-header">
				<strong>Registro de Nuevo Pedido</strong>
			</div>
			<div class="card-body">
				<blockquote class="blockquote mb-0">
					<p>Seleccionar pedido para la Mesa (<?php echo $mesa ?>) del Piso (<?php echo $piso ?>)</p>
					<p>Cliente : <a href="#"><?php echo $cliente ?></a></p>
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
				<div class="card-header">
					<strong>Búsqueda de Producto</strong>
				</div>
				<div class="cart-table-wrap">

					<form id="datosBusqueda" name="datosBusqueda" method="POST" action="<?php echo SERVERURL ?>ajax/productoAjax.php" enctype="multipart/form-data">

						<nav class="navbar navbar-light bg-light">

							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="validationTooltipUsernamePrepend">Línea</span>
									</div>
									<select onchange="listar_sublinea(this); limpiarTabla();" name="buscar_linea" class="custom-select">
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
									<select id="datos_sublinea" onchange="limpiarTabla();" name="buscar_sublinea" class="custom-select">
										<option selected value="">Seleccionar Sublínea</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="validationTooltipUsernamePrepend">Buscar</span>
									</div>

									<input class="form-control btn-mg" onkeypress="limpiarTabla()" onkeydown="limpiarTabla()" onkeyup="limpiarTabla()" name="busqueda" type="search" placeholder="Buscar" aria-label="Search">
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


					<div class="card-header">
						<strong>Productos<div id="loading" style="display: none;">
								<img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/loading.gif" alt="">
							</div>
						</strong>
					</div>
					<div class="RespuestaAjax" id="RespuestaAjax"></div>


				</div>
			</div>

			<div class="col-lg-4">
				<div class="total-section">

					<div id="alerta" style="display: none;">
						<div class="alert alert-success" role="alert">Se agregó pedido correctamente</div>
					</div>
					<div id="hola" style="display: none;">
						<div class="alert alert-danger" role="alert">Se eliminó correctamente</div>
					</div>
					<div id="alertObservacion" style="display: none;">
						<div class="alert alert-success" role="alert">Se agregó observación</div>
					</div>
					<div id="cortesiaAlerta" style="display: none;">
						<div class="alert alert-success" role="alert">Se agregó como cortesía</div>
					</div>
					<div id="quitarcortesiaAlerta" style="display: none;">
						<div class="alert alert-danger" role="alert">Se eliminó cortesia</div>
					</div>
					<div class="card-header">
						<strong>Detalle de Pedido</strong> <br>
						Eliminar <TEXT style="color: red;">(x)</TEXT> , Cortesía <TEXT style="color: green;"> (✓)</TEXT>
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
					<table class="table total-table">
						<tbody>
							<tr>
								<td><strong>TOTAL:</strong></td>
								<td col="3">
									S/<input type="number" id="totalPrecio" name="preciototal" readonly class="border-0" id="staticEmail2" value="0">
								</td>
								<td></td>
								<td></td>
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
					<br>
					<div class="">
						<a href="javascript:window.location='<?php echo SERVERURL?>home';" class="boxed-btn black">Cancelar</a>
						<a href="<?php echo SERVERURL ?>verPedido" class="boxed-btn black">Ver Pedido</a>
						<a onclick="enviarDatos();" class="boxed-btn">Enviar</a>
						<div id="respuesta"></div>

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

						<div id="modal-body">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="button" id="observacionUP" onclick="actualizar(this.value);" class="btn btn-primary" data-toggle="modal" data-target="#modalObservacion">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	function calcularTotal() {

		var precio_pro = $("input[name='precio_pro\\[\\]']").map(function() {
			return $(this).val();
		}).get();

		var cantidad = $("input[name='cantidad\\[\\]']").map(function() {
			return $(this).val();
		}).get();

		var total = 0

		for (let index = 0; index < precio_pro.length; index++) {

			total = total + precio_pro[index] * cantidad[index];
		}
		document.getElementById('totalPrecio').value = total.toFixed(2);
	}






	function mostrar(id) {
		var x = $("#observacion" + id).val();

		var str = '<textarea class="form-control" id="UP' + id + '" rows="3" cols="50">' + x + '</textarea>';

		$("#observacionUP").val(id);
		$("#modal-body").html(str);

	}

	function actualizar(idUp) {
		var texto = $("#UP" + idUp).val();
		$("#observacion" + idUp).val(texto);


		document.getElementById("alertObservacion").style.display = "block";


		$('#alertObservacion').fadeIn();
		setTimeout(function() {
			$("#alertObservacion").fadeOut();
		}, 1000);
	}

	function limpiarTabla() {

		document.getElementById("RespuestaAjax").innerHTML = "";
	}

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
		let total = 0;

		// capturamos la fila que seleccionamos y llenamos el arreglo que creamos con push

		$('#tabla-productos tr').each(function() {
			id_producto.push($(this).find("#id_producto").html());
			nombreDetalle.push($(this).find("#nombre").html());
			precioDetalle.push($(this).find("#precio").html());
		});

		//Contador para mostrar
		$('#tablaDetalle tr').each(function() {
			contador++;

			total = total + parseFloat(precioDetalle[nrotabla]);
		});

		var div = document.createElement('tr');
		div.className = "total-data";
		div.setAttribute("id", contador);
		div.innerHTML += '<td hidden id="id_pro">' + id_producto[nrotabla] + '</td>';
		div.innerHTML += '<td>' + contador + '</td>';
		div.innerHTML += '<td><strong>' + nombreDetalle[nrotabla] + ' <br> (S/ ' + precioDetalle[nrotabla] + ')</td>';
		div.innerHTML += '<td><button type="button" onclick="mostrar(' + contador + ')" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">+</button></strong> <input type="text" hidden value="" name="observacion[]"  id="observacion' + contador + '"></td>';
		//aqui armo el formulario para enviar
		div.innerHTML += '<td><input id="cantidad" name="cantidad[]" style="height:40px; width : 50px;" type="number" min="1" required onchange="calcularTotal();" onkeydown="calcularTotal();" onkeypress="calcularTotal();" onkeyup="calcularTotal();"  class="form-control" value="1"></td>';
		div.innerHTML += '<input hidden name="id_producto[]" value="' + id_producto[nrotabla] + '">';
		div.innerHTML += '<input hidden name="desc_pro[]" value="' + nombreDetalle[nrotabla] + '">';
		div.innerHTML += '<input hidden name="precio_pro[]" value="' + precioDetalle[nrotabla] + '">';
		div.innerHTML += '<td><div class="row"><button type="button"  onclick=" eliminar(' + contador + ');calcularTotal();	" class="btn btn-outline-danger">x</button><button type="button" id="cortesia_btn' + contador + '" name="cortesia[]" class="btn btn-outline-success" onclick="cortesia(' + contador + ');">✓</button></div></td>';
		document.getElementById('nuevoform').appendChild(div);
		document.getElementById("alerta").style.display = "block";
		document.getElementById('totalInputs').value = contador;

		calcularTotal();

		//datos : id_producto[] , cantidad[], observacion[], cortesia[]


		$('#alerta').fadeIn();
		setTimeout(function() {
			$("#alerta").fadeOut();
		}, 1000);

	};

	function eliminar(n) {
		jQuery("tr").remove(`#${n}`);
		calcularTotal();
		
		var cant = $("#totalInputs").val();
		document.getElementById('totalInputs').value = cant-1;


	}

	function cortesia(contador) {


		var valor = $("#cortesia_btn" + contador).val();
		if (valor === "1") {

			document.getElementById("cortesia_btn" + contador).style.backgroundColor = "white";
			$("#cortesia_btn" + contador).val("");
			//aleerta
			document.getElementById("quitarcortesiaAlerta").style.display = "block";
			$('#quitarcortesiaAlerta').fadeIn();
			setTimeout(function() {
				$("#quitarcortesiaAlerta").fadeOut();
			}, 1000);
		} else {

			document.getElementById("cortesia_btn" + contador).style.backgroundColor = "green";
			$("#cortesia_btn" + contador).val(1);
			//aleerta
			document.getElementById("cortesiaAlerta").style.display = "block";
			$('#cortesiaAlerta').fadeIn();
			setTimeout(function() {
				$("#cortesiaAlerta").fadeOut();
			}, 1000);
		}


	}

	function alertaEliminar(monto) {
		calcularTotal();
		document.getElementById("hola").style.display = "block";
		$('#hola').fadeIn();
		setTimeout(function() {
			$("#hola").fadeOut();
		}, 1000);
	}

	function enviarDatos() {

		var precio_pro = $("input[name='precio_pro\\[\\]']").map(function() {
			return $(this).val();
		}).get();
		var cantidad = $("input[name='cantidad\\[\\]']").map(function() {
			return $(this).val();
		}).get();

		var error = false;
		var cont = 0;
		for (let index = 0; index < precio_pro.length; index++) {
			cont++;
			if (cantidad[index] == 0 || cantidad[index] == "") {

				error = true;
			}
		}
		if (cont == 0) {
			error = true;
		}
		if (error) {
			swal({
				title: 'Error',
				text: 'Debes llenar los campos correctamemte, gracias. ',
				type: 'error',
				confirmButtonText: 'Aceptar',
			})
		} else {
			swal({
				title: 'Confirmación',
				text: '¿Estás seguro que quieres enviar el pedido?',
				type: 'question',
				showCancelButton: true,
				confirmButtonText: 'Si',
				cancelButtonText: 'No'
			}).then(function() {



				//datos array : id_producto[] , cantidad[], observacion[], cortesia[] 
				// datos : piso, mesa, nroHombres, nroMujeres, nroNinios

				var piso = document.getElementsByName("piso")[0].value;
				var mesa = document.getElementsByName("mesa")[0].value;
				var nroHombres = document.getElementsByName("nroHombres")[0].value;
				var nroMujeres = document.getElementsByName("nroMujeres")[0].value;
				var nroNinios = document.getElementsByName("nroNinios")[0].value;
				var cliente = document.getElementsByName("cliente")[0].value;
				var comper_codigo = document.getElementsByName("comper_codigo")[0].value;
				var usua_codigo = document.getElementsByName("usua_codigo")[0].value;
				var preciototal = document.getElementsByName("preciototal")[0].value;
				var totalInputs = document.getElementsByName("totalInputs")[0].value;

				//Adicionar producto

				
				var codigo_comanda =  document.getElementsByName("codigoComanda")[0].value;


				//creamos array
				var arrayProducto = new Array();
				var arrayCantidad = new Array();
				var arrayObservacion = new Array();
				var arrayDescPro = new Array();
				var arrayPrecioPro = new Array();
				var arrayCortesia = new Array();
				//referenciamos los inputs
				var id_producto = $("input[name='id_producto\\[\\]']").map(function() {
					return $(this).val();
				}).get();
				var cantidad = $("input[name='cantidad\\[\\]']").map(function() {
					return $(this).val();
				}).get();
				var observacion = $("input[name='observacion\\[\\]']").map(function() {
					return $(this).val();
				}).get();
				var desc_pro = $("input[name='desc_pro\\[\\]']").map(function() {
					return $(this).val();
				}).get();
				var precio_pro = $("input[name='precio_pro\\[\\]']").map(function() {
					return $(this).val();
				}).get();
				var cortesia = $("button[name='cortesia\\[\\]']").map(function() {
					return $(this).val();
				}).get();

				for (let index = 0; index < id_producto.length; index++) {

					var itemId_producto = {};
					itemId_producto = id_producto[index];

					var itemCantidad = {};
					itemCantidad = cantidad[index];

					var itemObservacion = {};
					itemObservacion = observacion[index];

					var itemDescPro = {};
					itemDescPro = desc_pro[index];

					var itemPrecioPro = {};
					itemPrecioPro = precio_pro[index];

					var itemCortesia = {};
					itemCortesia = cortesia[index];

					arrayProducto.push(itemId_producto);
					arrayCantidad.push(itemCantidad);
					arrayObservacion.push(itemObservacion);
					arrayDescPro.push(itemDescPro);
					arrayPrecioPro.push(itemPrecioPro);
					arrayCortesia.push(itemCortesia);

				}

				var url = "ajax/comandaAjax.php";
				var productoJson = JSON.stringify(arrayProducto);
				var cantidadJson = JSON.stringify(arrayCantidad);
				var observacionJson = JSON.stringify(arrayObservacion);
				var descproJson = JSON.stringify(arrayDescPro);
				var precioporJson = JSON.stringify(arrayPrecioPro);
				var cortesiaJson = JSON.stringify(arrayCortesia);



				$.ajax({
					type: 'POST',
					url: url,
					data: {
						producto: productoJson,
						cantidad: cantidadJson,
						observacion: observacionJson,
						descpro: descproJson,
						preciopro: precioporJson,
						cortesia: cortesiaJson,
						piso: piso,
						mesa: mesa,
						nroHombres: nroHombres,
						nroMujeres: nroMujeres,
						nroNinios: nroNinios,
						cliente: cliente,
						comper_codigo: comper_codigo,
						usua_codigo: usua_codigo,
						preciototal: preciototal,
						totalInputs: totalInputs,
						codigo_comanda : codigo_comanda
					},
					error: function() {
						$("#respuesta").attr("disabled", false);
						$("#respuesta").html(respuesta);
					},
					success: function(respuesta) {
						$("#respuesta").attr("disabled", false);
						$("#respuesta").html(respuesta);
					}
				})

			});
		}




	}
</script>