<div class="cart-section mt-80 mb-150">
	<div class="container">
		<div class="card">
			<div class="card-body">
				<strong>Bienvenido (a) : <a href="#"><?php echo $_SESSION['comper_apenom']; ?></a></strong>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="cart-table-wrap">
					<div class="row">

						<div onclick="redirigir('nuePedido');" style="cursor: pointer" class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Nuevos Pedidos</h5>
									<p class="card-text">Iniciar Nuevo Pedido</p>
									<a href="#" class="btn btn-primary">Acceder</a>
								</div>
							</div>
						</div>

						
						<div onclick="redirigir('pedActivoList');" style="cursor: pointer" class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Pedidos Activos</h5>
									<p class="card-text">Lista de pedidos activos</p>
									<a href="#" class="btn btn-primary">Acceder</a>
								</div>
							</div>
						</div>
						<div onclick="redirigir('mesaDispo');" style="cursor: pointer" class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Mesas Disponibles</h5>
									<p class="card-text">Listado de Mesas</p>
									<a href="#" class="btn btn-primary">Acceder</a>
								</div>
							</div>
						</div>
						<div onclick="redirigir('');" style="cursor: pointer" class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Cerrar Sesión</h5>
									<p class="card-text">Volver a loguearse</p>
									<a href="#" class="btn btn-primary">Acceder</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	function redirigir(pagina) {
		window.location.href = "<?php echo SERVERURL ?>" + pagina;
	}
</script>