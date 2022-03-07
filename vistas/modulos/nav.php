
<style></style>
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo"style="padding-left: 0.5rem; padding-right: 2.5rem; bottom: -5.2rem;" >
							<a href="<?php echo SERVERURL ?>home" >
								<img src="<?php SERVERURL?>vistas/images/ss.png"  alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<?php 
								
								$pagina = explode("/", $_GET['views']);

								?>
								<li <?php if($pagina[0]=="home"||""){echo' class="current-list-item"';} ?>><a href="<?php echo SERVERURL ?>home">Inicio</a>
								<li <?php if($pagina[0]=="nuePedido"||$pagina[0]=="selProducto"||$pagina[0]=="finPedido"){echo' class="current-list-item"';} ?>><a href="<?php echo SERVERURL ?>nuePedido">Nuevos Pedidos</a>
								<li <?php if($pagina[0]=="pedActivoList"||$pagina[0]=="preCuenta"){echo' class="current-list-item"';} ?>><a href="<?php echo SERVERURL ?>pedActivoList">Pedidos Activos</a>
								<li <?php if($pagina[0]=="mesaDispo"){echo' class="current-list-item"';} ?>><a href="<?php echo SERVERURL ?>mesaDispo">Mesas Disponibles</a>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="index.php"><i class="fas fa-door-closed"></i>   Salir</a>
									</div>
								</li>
							</ul>
						</nav>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>