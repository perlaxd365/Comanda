<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class mesaControlador extends mainModel
{

    public static function listar_mesa_controlador($id)
    {
        $result = mainModel::ejecutar_consulta_simple("call pa_mesas_disponibles('01', 1,'$id')");

        $tabla='

        <div style="overflow-y:scroll;height:500px;">
        <table  class="table" style="height: 200px;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Ambiente</th>
                <th scope="col" class="text-center">Mesa</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>';
        $contador=0;
        while ($filas = odbc_fetch_array($result)) {
            $contador++;
            $ocupado=$filas["ocupado"];
           $tabla.='
           
                   <tr>
                       <th scope="row">'.$contador.'</th>
                       <td>'.$filas["ambien_descripcion"].'</td>
                       <td>Mesa '.$filas["commes_nromesa"].'</td>';
                if ($ocupado==0) {
                    $tabla.=' <td><button type="button" class="btn btn-outline-success">Disponible</button></td>';
                }else{

                    $tabla.='<td><button type="button" class="btn btn-outline-danger">Ocupado</button></td>';
                }
                      

                       
                $tabla.='<td><a href="'. SERVERURL.'nuePedido" class="btn btn-outline-info">Iniciar Pedido</a></td>
                   </tr>
               ';
        }
        $tabla.='</tbody>
        </table>
        </div>';


        return $tabla;
    
    }
}