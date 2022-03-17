<?php 



$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/comandaControlador.php';
$instancearComanda = new comandaControlador();

if(isset($_POST['producto'])) {
	

	echo $instancearComanda->agregar_comanda_controlador();


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}




?>