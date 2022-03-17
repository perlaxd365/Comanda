<?php
if ($peticionAjax) {
	require_once "../modelos/productoModelo.php";
} else {
	require_once "./modelos/productoModelo.php";
}

class productoControlador extends productoModelo
{

	public static function listar_prod_linea_controlador()
	{
		$data = [
			"empr_codigo" => '01'
		];
		$lista = productoModelo::lista_linea($data);
		while ($rows = odbc_fetch_array($lista)) {
			echo '<option value="' . $rows["suli_codigo"] . '">' . utf8_encode($rows["suli_abreviatura"]) . '</option>';
		}
	}

	public static function listar_prod_sublinea_controlador($id_linea)
	{
		$data = [
			"suli_codigo" => $id_linea,
			"empr_codigo" => '01'
		];
		$lista = productoModelo::lista_sublinea($data);
		$contador = 0;
		while ($rows = odbc_fetch_array($lista)) {
			$contador++;
			echo '<option value="' . $rows["ssli_codigo"] . '">' . utf8_encode($rows["ssli_descripcion"]) . '</option>';
		}
		if ($contador == 0) {
			echo ' <option >Línea no contiene Sublínea</option>';
		}
	}
	public static function listar_productos_controlador($linea_busqueda, $sublinea_busqueda, $busqueda)
	{
		$linea_busqueda=trim($linea_busqueda);
		$sublinea_busqueda=trim($sublinea_busqueda);
		$busqueda=trim($busqueda);
		$tabla = '';

		$consulta = "SELECT  DISTINCT a.prod_codigo,a.prod_abreviatura, pvpd_importe,*
		FROM alma_producto a INNER JOIN come_precio_venta p
	   	ON a.prod_codigo=p.prod_codigo
	   	WHERE a.empr_codigo = '01'
	   	AND line_codigo = '02'
	   	AND prod_vigencia = 'SI'
";

		if (isset($linea_busqueda) && $linea_busqueda != "") {
			$consulta .= " AND suli_codigo = '$linea_busqueda'";
		}
		if (isset($sublinea_busqueda) && $sublinea_busqueda != "") {
			$consulta .= " AND ssli_codigo = '$sublinea_busqueda'";
		}
		if (isset($busqueda) && $busqueda != "") {

			$consulta .= " AND prod_abreviatura LIKE '%$busqueda%'";
		}

		$tabla .= '<div style="overflow-y:scroll;height:500px;">
		<table style="height: 200px;" class="table tabla-productos" id="tabla-productos">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">Item</th>
					<th scope="col" class="text-left">Producto</th>
					<th scope="col" class="text-right">Precio S/</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>';

		$result = mainModel::ejecutar_consulta_simple($consulta);
		$contador = 0;
		while ($rows = odbc_fetch_array($result)) {
			$contador++;
			$tabla .= '<tr>
			<td colspan="1" hidden id="id_producto">' . $rows["prod_codigo"] . '</td>
			<td colspan="1" id="nrotabla">' . $contador . '</td>
			<td class="text-left" id="nombre">' . utf8_encode($rows["prod_abreviatura"]) . '</td>
			<td class="text-right" id="precio">' . utf8_encode(mainModel::moneyFormat($rows["pvpd_importe"], "USD")) . '</td>
			<td class="boton"><button type="button" onclick="vistaprevia(' . $contador . ');" class="btn btn-outline-dark">Agregar</button></td>

		</tr>';
		}




		
		$tabla .= '
							</tbody></table>';if ($contador==0) {
								$tabla.='<h6 style="padding-right:30px">No se encontraron resultados</h6>';
							}
						$tabla.='
					</div>
';

		return $tabla;
	}
}
