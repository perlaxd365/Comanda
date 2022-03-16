<?php
if (isset($pdf)) {

	require_once "configAPP.php";
} else {
	if ($peticionAjax) {
		require_once "../core/configAPP.php";
	} else {
		require_once "./core/configAPP.php";
	}
}

class mainModel
{
	public static function conectar()
	{

		$conexion = odbc_connect($GLOBALS['DNS'], $GLOBALS['USUARIO'], $GLOBALS['CLAVE']);
		return $conexion;
	}

	public static function desconectar()
	{

		$conexion = odbc_close(self::conectar());
		return $conexion;
		
	}

	public static function reconectar($dns,$usuario,$clave)
	{

		$conexion = self::desconectar();
		$conexion = odbc_connect($dns, $usuario, $clave);
		return $conexion;
	}
	
	public static function moneyFormat($price, $curr)
	{
		$currencies['EUR'] = array(2, ',', '.');        // Euro
		$currencies['ESP'] = array(2, ',', '.');        // Euro
		$currencies['USD'] = array(2, '.', ',');        // US Dollar
		$currencies['COP'] = array(2, ',', '.');        // Colombian Peso
		$currencies['CLP'] = array(0,  '', '.');        // Chilean Peso

		return number_format($price, ...$currencies[$curr]);
	}

	public static function encriptar_power_builder($clave)
	{
		$ls_letra = '';
		$ls_cadena = '';
		$j = 0;

		$completarCadena = '$A';

		$ls_cad2 = "NE[\G-BRP.U}tL!HpY@s)e'Jzbl+`Q^$completarCadena/ S82y]gwoM_,|(anf;%Vd5Z9*#=<>Oc:X71qD6jvTr?0FkCWIu4ih{mx3K";
		$ls_cad1 = "ABCDEFGHIJKLMNO !#$%'()*+,-./01234;<=>?@PQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}56789:";

		for ($i = 0; $i < strlen((trim($clave))); $i++) {
			$ls_letra = substr($clave, $i, 1);
			$j = 1;
			while ($ls_letra != substr($ls_cad2, $j, 1) && $j <= strlen($ls_cad2)) {
				$j++;
			}
			$ls_cadena .= substr($ls_cad1, $j, 1);
		}
		return $ls_cadena;
	}

	public static function desencriptar_power_builder($clave)
	{

		
		$ls_letra = '';
		$ls_cadena = '';
		$j = 0;

		$completarCadena = '$A';

		$ls_cad1 = "NE[\G-BRP.U}tL!HpY@s)e'Jzbl+`Q^$completarCadena/ S82y]gwoM_,|(anf;%Vd5Z9*#=<>Oc:X71qD6jvTr?0FkCWIu4ih{mx3K";
		$ls_cad2 = "ABCDEFGHIJKLMNO !#$%'()*+,-./01234;<=>?@PQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}56789:";

		for ($i = 0; $i < strlen((trim($clave))); $i++) {
			$ls_letra = substr($clave, $i, 1);
			$j = 1;
			while ($ls_letra != substr($ls_cad2, $j, 1) && $j <= strlen($ls_cad2)) {
				$j++;
			}
			$ls_cadena .= substr($ls_cad1, $j, 1);
		}
		return $ls_cadena;

		
	}


	public static function ejecutar_consulta_simple($consulta)
	{
		$respuesta = odbc_exec(self::conectar(), $consulta);
		return $respuesta;
	}




	public static function encryption($string)
	{
		$output = FALSE;
		$key = hash('sha256', SECRET_KEY);
		$iv = substr(hash('sha256', SECRET_IV), 0, 16);
		$output = openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output = base64_encode($output);
		return $output;
	}

	public static function decryption($string)
	{
		$key = hash('sha256', SECRET_KEY);
		$iv = substr(hash('sha256', SECRET_IV), 0, 16);
		$output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}

	public function generar_codigo_aleatorio($letra, $longitud, $num)
	{
		for ($i = 1; $i <= $longitud; $i++) {
			$numero = rand(0, 9);
			$letra .= $numero;
		}
		return $letra . $num;
	}

	public static function enviar_array($array)
	{
		$array = serialize($array);
		$array = urlencode($array);
		return $array;
	}

	public static function array_recibe($array)
	{

		$array = urldecode($array);
		$array = unserialize($array);
		return $array;
	}

	protected static function limpiar_cadena($cadena)
	{

		$cadena = str_ireplace("<script>", "", $cadena);
		$cadena = str_ireplace("</script>", "", $cadena);
		$cadena = str_ireplace("<script src", "", $cadena);
		$cadena = str_ireplace("<script type=", "", $cadena);
		$cadena = str_ireplace("SELECT * FROM", "", $cadena);
		$cadena = str_ireplace("DELETE FROM", "", $cadena);
		$cadena = str_ireplace("INSERT INTO", "", $cadena);
		$cadena = str_ireplace("[", "", $cadena);
		$cadena = str_ireplace("]", "", $cadena);
		$cadena = str_ireplace("==", "", $cadena);
		$cadena = str_ireplace(";", "", $cadena);
		return $cadena;
	}

	protected function sweet_alert($datos)
	{
		//valor 'alerta' para saber q tipo de alerta mostrar
		if ($datos['Alerta'] == "simple") {
			$alerta = "
			<script>
			swal(
			'" . $datos['Titulo'] . "' ,
			'" . $datos['Texto'] . "' ,
			'" . $datos['Tipo'] . "' 
			);
			</script>
			";
			// para recargar la pagina
		} elseif ($datos['Alerta'] == "recargar") {
			$alerta = "
			<script>
			swal({
				title: '" . $datos['Titulo'] . "',
				text: '" . $datos['Texto'] . "',
				type:'" . $datos['Tipo'] . "',
				confirmButtonText:'Aceptar'
				}).then(function(){
					location.reload();
					});
					</script>
					";
		}
		//CONDICION PARA LIMPIAR
		elseif ($datos['Alerta'] == "limpiar") {
			$alerta = "
					<script>
					swal({
						title: '" . $datos['Titulo'] . "',
						text: '" . $datos['Texto'] . "',
						type:'" . $datos['Tipo'] . "',
						confirmButtonText: 'Aceptar'
						}).then(function(){
							$('.FormularioAjax')[0].reset();
							});
							</script>
							";
		}
		//CONDICION PARA redireccionar
		elseif ($datos['Alerta'] == "redireccionar") {

			$url = SERVERURL;
			$contenido = $datos['Contenido'];
			$variable = $datos['Variable'];
			$redireccionar = $url . $contenido . '' . $variable;
			$alerta = "
							<script>
							swal({
								title: '" . $datos['Titulo'] . "',
								text: '" . $datos['Texto'] . "',
								type:'" . $datos['Tipo'] . "',
								confirmButtonText: 'Aceptar'
								}).then(function(){

									window.open('$redireccionar', 'Diseño Web', 'width=800, height=600')
									
									});
									</script>
									";
		}
		return $alerta;
	}
}
