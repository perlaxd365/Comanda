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
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT * FROM  comand_comanda WHERE comcom_codigo = ? ;");
		$sql = odbc_execute($consulta, array($datos["comcom_codigo"]));
		return $consulta;
	}
    

	protected function data_comanda_detalle_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT * FROM  comand_comandadetalle de INNER JOIN comand_comanda co ON  de.comcom_codigo =co.comcom_codigo
				WHERE de.comcom_codigo = ? AND de.cocode_cancelado= 'NO'  ;");
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
    protected function get_nro_item_comanda_detalle($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT MAX(cocode_item) as ultimoId FROM comand_comandadetalle WHERE comcom_codigo=?");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"]));
		$sql = odbc_fetch_array($consulta);
        
        return $sql;
    }
	
    protected function update_cortesia_comanda_detalle_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comandadetalle SET cocode_cortesia=? WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["cortesia"],$datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }
	
    protected function delete_comanda_detalle_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comandadetalle SET cocode_cancelado='SI',usua_cancelado=?,fecha_cancelado=now() WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["usua_codigo"],$datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }
    protected function quitar_comanda_detalle_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "DELETE FROM comand_comandadetalle WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }	
    protected function observacion_comanda_detalle_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT cocode_observaciones FROM comand_comandadetalle WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["cocode_item"]));
        return $consulta;
    }
    protected function actualizar_observacion_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comandadetalle SET cocode_observaciones=?,cocode_conobservaciones='SI' WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["observacion"],$datos["comcom_codigo"],$datos["cocode_item"]));
        return $consulta;
    }

    protected function actualizar_cantidad_producto_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comandadetalle SET cocode_cantidad=? WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["cocode_cantidad"],$datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }	
    protected function get_lista_ticket_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "CALL pa_comanda_lista_ticketeras_x_comanda(?,?)");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["empr_codigo"]));
        
        return $consulta;
    }
    protected function get_lista_composicion_comanda_imprimir_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "CALL pa_comanda_lista_comanda_para_imprimir_en_areas(?,?,?,?)");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["comare_codigo"],$datos["empr_codigo"],$datos["local_codigo"]));
        
        return $consulta;
    }

	
    protected function actualizar_envio_print_producto_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comandadetalle SET cocode_enviado='SI' WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }	
	

    protected function get_precuenta_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "CALL pa_formato_impresion_precuenta(?,?,?)");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["empr_codigo"],$datos["local_codigo"]));
        
        return $consulta;
    }
    protected function verificar_atencion_comanda_detalle_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT cocode_atendido,cocode_enviado FROM comand_comandadetalle WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_fetch_array($consulta);
        
        return $sql;
    }
	
    protected function update_estado_comanda_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comanda SET comcom_estado=?  WHERE comcom_codigo=?;");
        $sql = odbc_execute($consulta, array($datos["comcom_estado"],$datos["comcom_codigo"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }
	
    protected function verificar_producto_atendido_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT cocode_atendido FROM comand_comandadetalle WHERE comcom_codigo=? AND cocode_atendido='NO';");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }

    protected function come_parametro_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT come_valor FROM come_parametro WHERE empr_codigo=? AND come_codigo = 'AUTOATENC';");
        $sql = odbc_execute($consulta, array($datos["empr_codigo"]));
        $sql = odbc_fetch_array($consulta);

        return $sql;
    }

    protected function detalle_comanda_id_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT cocode_item,cocode_atendido,cocode_enviado,cocode_cancelado,cocode_producto FROM comand_comandadetalle  WHERE comcom_codigo=?");
        $sql = odbc_execute($consulta, array($datos["comcom_codigo"]));
        
        return $consulta;
    }
	protected function nombre_comanda_detalle_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT cocode_producto FROM  comand_comandadetalle  WHERE comcom_codigo=? AND  cocode_item=?;");
		$sql = odbc_execute($consulta, array($datos["comcom_codigo"],$datos["cocode_item"]));
        $sql = odbc_fetch_array($consulta);
		return $sql;
	}

	
	protected function validar_admin_modelo($datos)
	{
		$consulta = odbc_prepare(mainModel::conectar(), "SELECT u.comper_codigo
		FROM segu_usuario u 
		join comand_personal p on u.comper_codigo = p.comper_codigo
		and p.empr_codigo = '01'
		where u.usua_bloqueo = '0'
		and u.usua_vigencia = 'SI'
		and u.usua_agente = 'SI'
		and u.usua_clave = ?
		and p.comper_agente_admin = 'SI'");
		$sql = odbc_execute($consulta, array($datos["clave"]));
		return $consulta;
	}
    protected function delete_comanda_detalle_autorizacion_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "UPDATE comand_comandadetalle SET cocode_cancelado='SI',usua_cancelado=?,usua_autoriza_cancelado=?,fecha_cancelado=now() WHERE comcom_codigo=? AND cocode_item=?; ");
        $sql = odbc_execute($consulta, array($datos["usua_codigo"],$datos["usua_autoriza_cancelado"],$datos["comcom_codigo"],$datos["cocode_item"]));
		$sql = odbc_num_rows($consulta);
        
        return $sql;
    }
}
