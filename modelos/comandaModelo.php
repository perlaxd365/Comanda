<?php 
if ($peticionAjax) {
	require_once '../core/mainModel.php';
}else{
	require_once './core/mainModel.php';
}

class comandaModelo extends mainModel
{
	
	protected function agregar_comanda_modelo($datos){
        
		$consulta=odbc_prepare(mainModel::conectar(),"INSERT INTO comand_comanda 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
        $sql = odbc_execute($consulta, 
		array($datos["comcom_codigo"]),
		array($datos["empr_codigo"]),
		array($datos["apertu_fecha"]),
		array($datos["apertu_hora"]),
		array($datos["apertu_turno"]),
		array($datos["clie_codigo"]),
		array($datos["comcom_agente"]),
		array($datos["comcom_cant_femenino"]),
		array($datos["comcom_cant_masculino"]),
		array($datos["comcom_cant_nino"]),
		array($datos["comcom_cliente_apenom"]),
		array($datos["comcom_estado"]),
		array($datos["comcom_fact_ant"]),
		array($datos["comcom_fecha"]),
		array($datos["comcom_hora"]),
		array($datos["comcom_impresion"]),
		array($datos["comcom_mesas"]),
		array($datos["comcom_montobase_dolares"]),
		array($datos["comcom_montobase_soles"]),
		array($datos["comcom_montoigv_dolares"]),
		array($datos["comcom_montoigv_soles"]),
		array($datos["comcom_montototal_dolares"]),
		array($datos["comcom_montototal_soles"]),
		array($datos["comcom_numero"]),
		array($datos["comcom_porcigv"]),
		array($datos["comcom_tipocambio"]),
		array($datos["comcom_vigencia"]),
		array($datos["commes_codigo"]),
		array($datos["comper_codigo"]),
		array($datos["empr_codigo_factura"]),
		array($datos["fecha_creacion"]),
		array($datos["fecha_eliminacion"]),
		array($datos["fecha_modificacion"]),
		array($datos["locale_codigo"]),
		array($datos["usua_autoriza_eliminacion"]),
		array($datos["usua_creacion"]),
		array($datos["usua_eliminacion"]),
		array($datos["usua_modificacion"])
		);
		$sql = odbc_num_rows($consulta);
		return $sql;
	}
	protected function fecha_hora_sistema(){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT MAX(getdate()) AS fecha from come_moneda;");
        $sql = odbc_execute($consulta);
		$respuesta=odbc_fetch_array($consulta);
		return $respuesta;
    }
	protected function get_correlativo_modelo($datos){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT MAX(CAST(RIGHT(comcom_numero,6) as decimal)) as numeromax from comand_comanda
		where year(comcom_fecha)=? and empr_codigo=? and locale_codigo = ?");
        $sql = odbc_execute($consulta, array($datos["anio"], $datos["empr_codigo"], $datos["locale_codigo"]));
		$sql=odbc_fetch_array($consulta);
		return $sql;
    }
	protected function get_caja_apertura_modelo($datos){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT apertu_fecha,apertu_turno,apertu_hora
		FROM comand_caja c 
		JOIN comand_apertura a 
		ON a.caja_codigo = c.caja_codigo and c.empr_codigo = a.empr_codigo
		where c.empr_codigo = ? and c.locale_codigo = ? 
		and c.caja_vigencia = 'SI' and a.apertu_vigencia = 'Si' and a.apertu_estado = 'A' ;
		");
        $sql = odbc_execute($consulta, array($datos["empr_codigo"], $datos["locale_codigo"]));
		$sql=odbc_fetch_array($consulta);
		return $sql;
    }
	protected function get_num_caja_apertura_modelo($datos){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT apertu_fecha,apertu_turno,apertu_hora
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

	protected function get_agente_comanda_modelo($datos){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT comper_apenom FROM comand_personal
		WHERE comper_vigencia = 'SI'
		AND comper_codigo = ?
		AND empr_codigo = ?
		AND locale_codigo = ?
		");
        $sql = odbc_execute($consulta, array($datos["comper_codigo"],$datos["empr_codigo"], $datos["locale_codigo"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
    }
	protected function get_codigo_comanda_modelo(){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT MAX(comcom_codigo)+1 AS codigo from comand_comanda;");
        $sql = odbc_execute($consulta);
		$respuesta=odbc_fetch_array($consulta);
		return $respuesta;
    }

	protected function get_id_mesa_modelo($datos){
		$consulta=odbc_prepare(mainModel::conectar(),"SELECT commes_codigo FROM comand_mesas
		WHERE commes_nromesa = ? ;");
        $sql = odbc_execute($consulta, array($datos["mesa"]));
		$sql = odbc_fetch_array($consulta);
		return $sql;
    }
}
