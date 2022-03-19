<?php
if ($peticionAjax) {
	require_once '../modelos/loginModelo.php';
} else {
	require_once './modelos/loginModelo.php';
}

class loginControlador extends loginModelo
{

	public function iniciar_sesion_controlador()
	{

		$clave = mainModel::encriptar_power_builder($_POST["clave"]);
		$datosLogin = [

			"clave" => $clave
		];

		$filas = loginModelo::contar_filas_modelo($datosLogin);

		if ($filas >= 1) {


			$seguUsuario = loginModelo::iniciar_sesion_modelo($datosLogin);
			
			$comper_codigo=$seguUsuario["comper_codigo"];
			$usua_clave=$seguUsuario["usua_clave"];


			$consulta = mainModel::ejecutar_consulta_simple("SELECT s.usua_codigo,s.comper_codigo,p.comper_apenom 
															 FROM segu_usuario s INNER JOIN comand_personal p 
															 ON s.comper_codigo=p.comper_codigo 
															 WHERE p.comper_codigo='$comper_codigo'
															 		AND s.usua_clave='$usua_clave'
																	 AND s.usua_agente='SI';");
			$filas = odbc_fetch_array($consulta);

			unset($GLOBALS['USUARIO']);
			unset($GLOBALS['CLAVE']);
			$usua_codigo=$filas["filas"];


			$GLOBALS['DNS'] = "Sigerest_PG_Local";
			$GLOBALS['USUARIO'] = $usua_codigo;
			$GLOBALS['CLAVE'] = $clave;
			$UserData = loginModelo::reconectar($GLOBALS['DNS'], $GLOBALS['USUARIO'], $GLOBALS['CLAVE']);


			if (!$UserData) {
				echo 'No se pudo conectar';
			} else {
				
				echo 'Conectado';
			session_start(['name' => 'COMANDA']);	


			$_SESSION['comper_codigo'] = $seguUsuario["comper_codigo"];
			$_SESSION['codigo_usuario_comanda'] = $GLOBALS;
			$_SESSION['token_comanda'] = md5(uniqid(mt_rand(), true));
			$url = SERVERURL . "home";
			return $urlLocation = '<script>window.location="' . $url . '"</script>';
			}
		} else {

			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Algo salió mal",
				"Texto" => "El usuario y contraseña no son correctos / Cuenta inactiva. ¡Ups!",
				"Tipo" => "error"
			];
		}
		return mainModel::sweet_alert($alerta);
	}

	public function cerrar_sesion_controlador()
	{

		session_start(['name' => 'COMANDA']);
		$token = mainModel::decryption($_GET['Token']);
		$datos = [
			"Token_S" => $_SESSION['token_comanda'],
			"Token" => $token
		];
		return loginModelo::cerrar_sesion_modelo($datos);
	}

	public function forzar_cierre_sesion_controlador()
	{

		session_start(['name' => 'COMANDA']);
		session_destroy();
		return header("location:" . SERVERURL . "login/");
	}
}
