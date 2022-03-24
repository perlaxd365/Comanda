<?php 



$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/comandaControlador.php';
$instancearComanda = new comandaControlador();

if(isset($_POST['producto'])) {
	

	echo $instancearComanda->agregar_comanda_controlador();


}elseif(isset($_POST['cortesiaProducto'])) {
	

	echo $instancearComanda->update_cortesia_comanda_detalle_controlador();


}elseif(isset($_POST['eliminarProducto'])) {
	

	echo $instancearComanda->delete_comanda_deltalle_controlador();


}elseif(isset($_POST['comandaObser'])) {
	

	echo $instancearComanda->recuperar_observacion_controlador();


}elseif(isset($_POST['actualizar_observacion'])) {
	

	echo $instancearComanda->actualizar_obser_controlador();


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}




?>