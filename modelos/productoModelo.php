<?php
if ($peticionAjax) {
    require_once '../core/mainModel.php';
} else {
    require_once './core/mainModel.php';
}

class productoModelo extends mainModel
{

    protected function lista_linea($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT distinct suli_codigo,suli_abreviatura FROM alma_sublinea s INNER JOIN alma_linea l 
        ON s.line_codigo=l.line_codigo
         WHERE  s.empr_codigo=?
          AND suli_vigencia='SI'
           AND line_paraatencion='SI'
            AND l.line_codigo='02';");
        $sql = odbc_execute($consulta, array($datos["empr_codigo"]));
        return $consulta;
    }


    protected function lista_sublinea($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT ssli_codigo,ssli_descripcion
                                                             FROM alma_subsublinea 
                                                                    WHERE  suli_codigo=?
                                                                        AND empr_codigo=?
                                                                        AND ssli_vigencia='SI';");
        $sql = odbc_execute($consulta, array($datos["suli_codigo"], $datos["empr_codigo"]));
        return $consulta;
    }

    protected function lista_producto_linea($datos)
    {

        $consulta = odbc_prepare(mainModel::conectar(), "SELECT  DISTINCT a.prod_codigo,a.prod_abreviatura, pvpd_importe 
        FROM alma_producto a 
        INNER JOIN come_precio_venta p
        ON a.prod_codigo=p.prod_codigo
        WHERE  prod_vigencia='SI'
         AND empr_codigo=?
         AND suli_codigo=?
         AND ssli_codigo=?
         AND line_codigo=?
         AND a.prod_abreviatura LIKE '%BLEND%';");
        $sql = odbc_execute($consulta, array($datos["suli_codigo"], $datos["empr_codigo"]));
        return $consulta;
    }
}
