<?php 
if ($peticionAjax) {
	require_once '../core/mainModel.php';
}else{
	require_once './core/mainModel.php';
}

class comandaModelo extends mainModel
{
	
	protected function iniciar_sesion_modelo($datos){

    }
}
