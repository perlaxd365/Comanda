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


}elseif(isset($_POST['actualizar_cantidad'])) {
	

	echo $instancearComanda->actualizar_cantidad_detalle_controlador();


}elseif(isset($_POST['comcom_codigo_precuenta'])) {
	

	echo $instancearComanda->precuenta_comanda_controlador();


}elseif(isset($_POST['comcom_codigo_eliminar_comanda'])) {
	

	echo $instancearComanda->eliminar_comanda_controlador();


}elseif(isset($_POST['eliminar_atendido'])) {
	

	echo $instancearComanda->eliminar_detalle_admin_controlador();


}elseif(isset($_POST['clave_verficar'])) {
	

	echo $instancearComanda->validar_admin_controlador();


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}




?>