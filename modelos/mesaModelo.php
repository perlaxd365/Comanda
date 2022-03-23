<?php
if ($peticionAjax) {
    require_once '../core/mainModel.php';
} else {
    require_once './core/mainModel.php';
}
class mesaModelo extends mainModel
{

    protected function pedidos_activos_modelo($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT  co.comcom_codigo,   
            co.commes_codigo,   
            co.comcom_mesas,   
            co.comcom_vigencia,   
            co.comcom_numero,   
            co.comper_codigo,   
            co.comcom_hora,   
            me.commes_nromesa
            FROM  comand_comanda co
            INNER JOIN  comand_mesas me ON 
                co.commes_codigo  =  me.commes_codigo   and  co.empr_codigo  =  me.empr_codigo 
            INNER JOIN comand_ambiente am ON 
                me.ambien_codigo=am.ambien_codigo
            WHERE  co.comcom_vigencia  = 'SI'
            AND (  co.comper_codigo  =? )
            AND  am.ambien_piso  = ?
            AND  co.empr_codigo  = ?
            AND  co.locale_codigo  = ?
            AND  co.comcom_estado  = '01'
            AND  co.comcom_fact_ant  IS NULL");
        $sql = odbc_execute($consulta, array($datos["comper_codigo"],$datos["ambien_piso"],$datos["empr_codigo"],$datos["locale_codigo"]));
        
        return $consulta;
    }

}
