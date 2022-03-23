<?php
if ($peticionAjax) {
	require_once '../core/mainModel.php';
} else {
	require_once './core/mainModel.php';
}

class comandaModelo extends mainModel
{

	protected function agregar_comanda_modelo($datos)
	{

		$consulta = odbc_prepare(mainModel::conectar(), "INSERT INTO comand_comanda 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
		$sql = odbc_execute(
			$consulta,
			array(
				$datos["comcom_codigo"], 
				$datos["empr_codigo"],
				$datos["apertu_fecha"],
				$datos["apertu_turno"],
				$datos["apertu_hora"],
				$datos["commes_codigo"],
				$datos["comper_codigo"],
				$datos["clie_codigo"],
				$datos["locale_codigo"],
				$datos["comcom_cliente_apenom"],
				$datos["comcom_numero"],
				$datos["comcom_fecha"],
				$datos["comcom_hora"],
				$datos["comcom_estado"],
				$datos["comcom_montobase_soles"],
				$datos["comcom_montobase_dolares"],
				$datos["comcom_montoigv_soles"],
				$datos["comcom_montoigv_dolares"],
				$datos["comcom_montototal_soles"],
				$datos["comcom_montototal_dolares"],
				$datos["comcom_tipocambio"],
				$datos["comcom_porcigv"],
				$datos["comcom_mesas"],
				$datos["comcom_vigencia"],
				$datos["comcom_cant_masculino"],
				$datos["comcom_cant_femenino"],
				$datos["comcom_cant_nino"],
				$datos["comcom_impresion"],
				$datos["comcom_fact_ant"],
				$datos["empr_codigo_factura"],
				$datos["comcom_agente"],
				$datos["usua_eliminacion"],
				$datos["fecha_eliminacion"],
				$datos["usua_creacion"],
				$datos["fecha_creacion"],
				$datos["usua_modificacion"],
				$datos["fecha_modificacion"],
				$datos["usua_autoriza_eliminacion"]
			)
		);
		$sql = odbc_num_rows($consulta);
		return $sql;
	}
	protected function agregar_comanda_detalle_modelo($datos)
	{

		$consulta = odbc_prepare(mainModel::conectar(), "INSERT INTO comand_comandadetalle 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
		$sql = odbc_execute(
			$consulta,
			array(
				$datos["comcom_codigo"], 
				$datos["empr_codigo"],
				$datos["cocode_item"],
				$datos["alma_codigo"],
				$datos["prod_codigo"],
				$datos["comoca_codigo"],
				$datos["comoca_abreviatura"],
				$datos["cocode_producto"],
				$datos["cocode_precio_soles"],
				$datos["cocode_precio_dolares"],
				$datos["cocode_cantidad"],
				$datos["cocode_subtotal_soles"],
				$datos["cocode_subtotal_dolares"],
				$datos["cocode_cortesia"],
				$datos["cocode_cancelado"],
				$datos["cocode_enviado"],
				$datos["cocode_conpropiedades"],
				$datos["cocode_conobservaciones"],
				$datos["cocode_observaciones"],
				$datos["cocode_orden"],
				$datos["cocode_grupo"],
				$datos["prpr_codigo"],
				$datos["prpr_descripcion"],
				$datos["cocode_fact_atend"],
				$datos["cocode_fact_saldo"],
				$datos["cocode_producto_codint"],
				$datos["usua_creacion"],
				$datos["fecha_creacion"],
				$datos["usua_modificacion"],
				$datos["fecha_modificacion"],
				$datos["usua_cancelado"],
				$datos["fecha_cancelado"],
				$datos["cocode_costo_producto"],
				$datos["cocode_atendido"],
				$datos["cocode_atendido_fechahora"],
				$datos["usua_autoriza_cancelado"],
				$datos["cocode_pedido_hora"]
			)
		);
		$sql = odbc_num_rows($consulta);
		return $sql;
	}
	protected function fecha_hora_sistema()
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT MAX(getdate()) AS fecha from come_moneda;");
		$sql = odbc_execute($consulta);
		$respuesta = odbc_fetch_array($consulta);
		return $respuesta;
	}
	protected function get_correlativo_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT MAX(CAST(RIGHT(comcom_numero,6) as decimal)) as numeromax from comand_comanda
		where year(comcom_fecha)=? and empr_codigo=? and locale_codigo = ?");
		$sql = odbc_execute($consulta, array($datos["anio"], $datos["empr_codigo"], $datos["locale_codigo"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
	}
	protected function get_caja_apertura_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT apertu_fecha,apertu_turno,apertu_hora
		FROM comand_caja c 
		JOIN comand_apertura a 
		ON a.caja_codigo = c.caja_codigo and c.empr_codigo = a.empr_codigo
		where c.empr_codigo = ? and c.locale_codigo = ? 
		and c.caja_vigencia = 'SI' and a.apertu_vigencia = 'Si' and a.apertu_estado = 'A' ;
		");
		$sql = odbc_execute($consulta, array($datos["empr_codigo"], $datos["locale_codigo"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
	}
	protected function get_num_caja_apertura_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT apertu_fecha,apertu_turno,apertu_hora
		FROM comand_caja c 
		JOIN comand_apertura a 
		ON a.caja_codigo = c.caja_codigo and c.empr_codigo = a.empr_codigo
		where c.empr_codigo = ? and c.locale_codigo = ? 
		and c.caja_vigencia = 'SI' and a.apertu_vigencia = 'Si' and a.apertu_estado = 'A' ;
		");
		$sql = odbc_execute($consulta, array($datos["empr_codigo"], $datos["locale_codigo"]));
		$sql = odbc_num_rows($consulta);
		return $sql;
	}

	protected function get_agente_comanda_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT comper_apenom FROM comand_personal
		WHERE comper_vigencia = 'SI'
		AND comper_codigo = ?
		AND empr_codigo = ?
		AND locale_codigo = ?
		");
		$sql = odbc_execute($consulta, array($datos["comper_codigo"], $datos["empr_codigo"], $datos["locale_codigo"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
	}
	protected function get_codigo_comanda_modelo()
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT MAX(comcom_codigo)+1 AS codigo from comand_comanda;");
		$sql = odbc_execute($consulta);
		$respuesta = odbc_fetch_array($consulta);
		return $respuesta;
	}

	protected function get_id_mesa_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT commes_codigo FROM comand_mesas
		WHERE commes_nromesa = ? ;");
		$sql = odbc_execute($consulta, array($datos["mesa"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
	}
	protected function get_cod_interno_producto_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT prod_codigo_interno FROM alma_producto
		WHERE prod_codigo = ? ;");
		$sql = odbc_execute($consulta, array($datos["prod_codigo"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
	}

	protected function data_comanda_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT * FROM  comand_comandadetalle de INNER JOIN comand_comanda co ON  de.comcom_codigo =co.comcom_codigo
		WHERE de.comcom_codigo = ? ;");
		$sql = odbc_execute($consulta, array($datos["comcom_codigo"]));
		return $consulta;
	}
    
    protected function get_piso_mesa_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT ambien_piso FROM comand_ambiente am INNER JOIN comand_mesas me ON am.ambien_codigo=me.ambien_codigo
        WHERE commes_codigo=?;");
        $sql = odbc_execute($consulta, array($datos["commes_codigo"]));
		$sql = odbc_fetch_array($consulta);
        
        return $sql;
    }
}
