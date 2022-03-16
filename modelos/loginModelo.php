<?php 
if ($peticionAjax) {
	require_once '../core/mainModel.php';
}else{
	require_once './core/mainModel.php';
}

class loginModelo extends mainModel
{
	
	protected function iniciar_sesion_modelo($datos){

		$consulta=odbc_prepare(mainModel::conectar(),"SELECT * FROM segu_usuario WHERE  usua_clave=? AND usua_agente='SI';");
		$sql = odbc_execute($consulta, array($datos["clave"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
	}
	protected function contar_filas_modelo($datos){

		$consulta=odbc_prepare(mainModel::conectar(),"SELECT * FROM segu_usuario WHERE  usua_clave=? AND usua_agente='SI';");
		$sql = odbc_execute($consulta, array($datos["clave"]));
		$sql = odbc_num_rows($consulta);
		return $sql;
	}

	protected function cerrar_sesion_modelo($datos){
		if ( $datos['Token_S']==$datos['Token']) {
			
			session_unset();
			session_destroy();
			$respuesta="true";
		}else{
			$respuesta="false";
			
			
		}
		return $respuesta;
	}
}