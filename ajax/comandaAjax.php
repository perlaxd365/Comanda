<?php 



$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/comandaControlador.php';
$instancearComanda = new comandaControlador();

if(isset($_POST['producto'])) {
	

	echo $instancearComanda->agregar_comanda_controlador();


}elseif(isset($_POST['comcom_codigo']) && isset($_POST['cocode_item'])) {
	

	echo $instancearComanda->update_cortesia_comanda_detalle_controlador();


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}




?>