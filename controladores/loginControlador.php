<?php 
if ($peticionAjax) {
	require_once '../modelos/loginModelo.php';
}else{
	require_once './modelos/loginModelo.php';
}

class loginControlador extends loginModelo
{
	
	public function iniciar_sesion_controlador(){

		$usuario=mainModel::limpiar_cadena($_POST["Usuario"]);
		$clave=mainModel::limpiar_cadena($_POST["Clave"]);

		$datosLogin=[

			"Usuario"=>$usuario,
			"Clave"=>$clave
		];

		$datosCuenta=loginModelo::iniciar_sesion_modelo($datosLogin);
		if ($datosCuenta->rowCount()==1) {


			session_start(['name'=>'LEDMEN']);

				$UserData=$datosCuenta->fetch();

				$_SESSION['id_usuario_ledmen']=$UserData['id_usuario'];
				$_SESSION['tipo_usuario_ledmen']=$UserData['tipo_usuario'];
				$_SESSION['nombre_usuario_ledmen']=$UserData['nombre_usuario'];
				$_SESSION['token_ledmen']=md5(uniqid(mt_rand(),true));
				$url=SERVERURL."home/";
				return $urlLocation='<script>window.location="'.$url.'"</script>';
			
		}
		else{

			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Algo salió mal",
				"Texto"=>"El usuario y contraseña no son correctos / Cuenta inactiva. ¡Ups!",
				"Tipo"=>"error"
			];	
		}
		return mainModel::sweet_alert($alerta);	

	}

	public function cerrar_sesion_controlador(){

		session_start(['name'=>'LEDMEN']);
		$token=mainModel::decryption($_GET['Token']);
		$datos=[
			"Token_S"=>$_SESSION['token_ledmen'],
			"Token"=>$token
		];
		return loginModelo::cerrar_sesion_modelo($datos);

	}

	public function forzar_cierre_sesion_controlador(){
		
		session_start(['name'=>'LEDMEN']);
		session_destroy(); 
		return header("location:".SERVERURL."login/");
	}
}