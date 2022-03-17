<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class mesaControlador extends mainModel
{

    public static function listar_mesa_controlador($id, $opcion)
    {
        $result = mainModel::ejecutar_consulta_simple("call pa_mesas_disponibles('01', 1,'$id')");

        $tabla = '

        <div style="overflow-y:scroll;height:500px;">
        <table  class="table" style="height: 200px;';
        if ($opcion == "seleccionar") {
            $tabla .= 'width:440px';
        }
        $tabla.='">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Ambiente</th>
                <th scope="col" class="text-center">Mesa</th>
                <th scope="col" class="text-center">Estado</th>
                ';
                if ($opcion == "seleccionar") {
                    $tabla .= '<th></th>';
                }

                
            if ($opcion == "listar") {
                $tabla .= '<th scope="col" class="text-center">Acción</th>';
            }
                $tabla .= '</tr>
        </thead>
        <tbody>';
        $contador = 0;
        while ($filas = odbc_fetch_array($result)) {
            $contador++;
            $ocupado = $filas["ocupado"];
            $piso=$id;
            $mesa=$filas["commes_nromesa"];
            $tabla .= '
           <tr ';
           if ($ocupado == 0) {
           $tabla .= 'onclick="enviarDatos('.$piso.','.$mesa.'); seleccionMesa();"';
           }


           $tabla .= '><th scope="row">' . $contador . '</th>
                       <td id="nroPiso">' . $filas["ambien_descripcion"] . '</td>
                       <td>Mesa ' . $filas["commes_nromesa"] . '</td>';
            if ($ocupado == 0) {
                $tabla .= ' <td><button type="button" class="btn btn-outline-success">Disponible</button></td>';
            } else {

                $tabla .= '<td><button type="button" class="btn btn-outline-danger">Ocupado</button></td>';
            }


            if ($opcion == "listar") {

                if ($ocupado == 0) {
                    $tabla .= '<td>
                    <form action="' . SERVERURL . 'nuePedido" method="POST">
                    <input type="hidden" name="piso" value="'.$piso.'">
                    <input type="hidden" name="mesa" value="'.$mesa.'">
                    <button type="submit" class="btn btn-outline-info">Iniciar Pedido</button>
                    </form>';
                } else {
    
                    $tabla .= ' <td><button type="button" class="btn btn-outline-success">Ver Pedido</button></td>';
                }

            }
            $tabla .= ' </tr>
               ';
        }
        $tabla .= '</tbody>
        </table>
        </div>';


        return $tabla;
    }
}
