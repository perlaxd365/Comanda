
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/productoControlador.php';
$instancearProducto = new productoControlador();

if(isset($_POST['id_linea'])) {
	

	echo $instancearProducto->listar_prod_sublinea_controlador($_POST['id_linea']);


}elseif(isset($_POST['buscar_linea']) && isset($_POST['buscar_sublinea']) && isset($_POST['busqueda'])  ) {
	

	echo $instancearProducto->listar_productos_controlador($_POST['buscar_linea'],$_POST['buscar_sublinea'],$_POST['busqueda']);


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
