
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/clienteControlador.php';
$instancearCliente = new clienteControlador();

if(isset($_POST['registro_cliente'])) {
	

	echo $instancearCliente->agregar_cliente_controlador();


}elseif(isset($_POST["id_cliente"])){
	echo $instancearCliente->mostrar_direccion_cliente_controlador($_POST["id_cliente"]);

}elseif(isset($_POST["actualizacion_cliente"])){

	echo $instancearCliente->actualizar_cliente_controlador($_POST["actualizacion_cliente"]);

}elseif(isset($_POST["eliminar_cliente"])){

	echo $instancearCliente->eliminar_cliente_controlador($_POST["eliminar_cliente"]);

}elseif(isset($_POST["busqueda"])){

	
	echo $instancearCliente->paginador_cliente_controlador(1, 10,$_POST["busqueda"]);

}elseif(isset($_POST["dni_cliente"])){

	
	echo $instancearCliente->consultar_dni($_POST["dni_cliente"]);

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
