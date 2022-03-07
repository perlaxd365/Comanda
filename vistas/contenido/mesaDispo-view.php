
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">

					<h3 class="font-weight-bold text-center">Disponibilidad de Mesa</h3><br>

						<select class="custom-select">
							<option selected>Abrir para seleccionar Piso</option>
							<option value="1">Piso 1</option>
							<option value="2">Piso 2</option>
							<option value="3">Piso 3</option>
						</select>
						<br>
						<br>
						<br>


						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th scope="col">ID</th>
									<th scope="col" class="text-center">Mesa</th>
									<th scope="col" class="text-center">Estado</th>
									<th scope="col" class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Mesa 2</td>
									<td><button type="button" class="btn btn-outline-success">Disponible</button></td>
									<td><a href="<?php echo SERVERURL ?>nuePedido" class="btn btn-outline-info">Iniciar Pedido</a></td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Mesa 8</td>
									<td><button type="button" class="btn btn-outline-danger">Ocupada</button></td>
									<td><a href="<?php echo SERVERURL ?>nuePedido" class="btn btn-outline-info">ver Pedido</a></td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td>Mesa 15</td>
									<td><button type="button" class="btn btn-outline-success">Disponible</button></td>
									<td><a href="<?php echo SERVERURL ?>nuePedido" class="btn btn-outline-info">Iniciar Pedido</a></td>
								</tr>
							</tbody>
						</table>

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
	// Funciones
	function agregarCurso(e) {
		e.preventDefault();


		if (e.target.classList.contains('agregar-carrito')) {
			const cursoSeleccionado = e.target.parentElement.parentElement;
			leerDatosCurso(cursoSeleccionado);
		}

	}


	function leerDatosCurso(curso) {
		// console.log(curso);

		// Crear un objeto con el contenido del curso actual
		const infoCurso = {
			imagen: curso.querySelector('img').src,
			titulo: curso.querySelector('h4').textContent,
			precio: curso.querySelector('.precio span').textContent,
			id: curso.querySelector('a').getAttribute('data-id'),
			cantidad: 1
		}

		// Revisa si un elemento ya existe en el carrito
		const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);
		if (existe) {
			// Actualizamos la cantidad
			const cursos = articulosCarrito.map(curso => {
				if (curso.id === infoCurso.id) {
					curso.cantidad++;
					return curso; // retorna el objeto actualizado
				} else {
					return curso; // retorna los objetos que no son los duplicados
				}
			});
			articulosCarrito = [...cursos];
		} else {
			// Agrega elementos al arreglo de carrito
			articulosCarrito = [...articulosCarrito, infoCurso];
		}




		console.log(articulosCarrito);

		carritoHTML();
	}
</script>