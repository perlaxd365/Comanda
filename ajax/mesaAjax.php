
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/mesaControlador.php';
$instancearMesa = new mesaControlador();

if(isset($_POST['idMesa']) && isset($_POST['opcion'])) {
	

	echo $instancearMesa->listar_mesa_controlador($_POST['idMesa'],$_POST['opcion']);


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
