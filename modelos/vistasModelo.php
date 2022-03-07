<?php 
	class vistasModelo{
		protected function obtener_vistas_modelo($vistas){
			$listaBlanca=["home","nuePedido","selProducto","finPedido","pedActivoList","preCuenta","selProductoPreCuenta","mesaDispo","verPedido"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenido/".$vistas."-view.php")){
					$contenido="./vistas/contenido/".$vistas."-view.php";
				}else{
					$contenido="login";
				}
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}