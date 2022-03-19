<?php 
if ($peticionAjax) {
	require_once '../core/mainModel.php';
}else{
	require_once './core/mainModel.php';
}

class comandaModelo extends mainModel
{
	
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
}
