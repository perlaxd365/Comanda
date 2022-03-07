
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/cotizacionControlador.php';
$instancearCliente = new cotizacionControlador();

if(isset($_POST['select_cliente'])) {
	

	echo $instancearCliente->agregar_cotizacion_controlador();


}elseif(isset($_POST["busqueda"])){

	
	echo $instancearCliente->paginador_cotizaciones_controlador(1, 10,$_POST["busqueda"]);

}elseif(isset($_POST["id_eliminar_cot"])){

	
	echo $instancearCliente->eliminar_cotizacion_controlador($_POST["id_eliminar_cot"]);

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
