<?php
if ($peticionAjax) {
    require_once "../modelos/cotizacionModelo.php";
} else {
    require_once "./modelos/cotizacionModelo.php";
}

class cotizacionControlador extends cotizacionModelo
{

    public static function agregar_cotizacion_controlador()
    {

        $id_usuario = mainModel::limpiar_cadena($_POST['id_usuario']);
        $id_cliente = mainModel::limpiar_cadena($_POST['select_cliente']);
        $fecha_emision = mainModel::limpiar_cadena($_POST['fecha_emision']);
        $fecha_limite = mainModel::limpiar_cadena($_POST['fecha_limite']);
        $direccion_servicio_cliente = mainModel::limpiar_cadena($_POST['direccion_servicio_cliente']);
        $cantidadInputs = mainModel::limpiar_cadena($_POST['cantidadInputs']);

        $descripcion_detalle = mainModel::limpiar_cadena($_POST['descripcion_detalle']);
        $cantidad_detalle = mainModel::limpiar_cadena($_POST['cantidad_detalle']);
        $unidad_detalle = mainModel::limpiar_cadena($_POST['unidad_detalle']);
        $precio_detalle = mainModel::limpiar_cadena($_POST['precio_detalle']);
        $piso_detalle = mainModel::limpiar_cadena($_POST['piso_detalle']);


        $consulta = mainModel::ejecutar_consulta_simple("SELECT id_cotizacion FROM Cotizacion");
        //numero para guardar el total de registros que hay en la bd,  que lo contamos en la consulta 4
        $numero = ($consulta->rowCount()) + 1;

        //generar codigo para cada cuenta
        $codigo = mainModel::generar_codigo_aleatorio("COT", 7, $numero);

        $dataCotCliente = [

            "id_cotizacion" => $codigo,
            "id_usuario" => $id_usuario,
            "id_cliente" => $id_cliente,
            "direccion_servicio_cotizacion" => $direccion_servicio_cliente,
            "fecha_emision_cot" => $fecha_emision,
            "fecha_limite_cot" => $fecha_limite

        ];
        $guardarCot = cotizacionModelo::agregar_cotizacion_modelo($dataCotCliente);
        if ($guardarCot->rowCount() >= 1) {


            for ($i = 0; $i < $cantidadInputs; $i++) {

                $datosDetalleCot = [

                    "id_cotizacion" => $codigo,
                    "descripcion_detalle" => $descripcion_detalle[$i],
                    "cantidad_detalle" => $cantidad_detalle[$i],
                    "unidad_detalle" => $unidad_detalle[$i],
                    "precio_detalle" => $precio_detalle[$i],
                    "piso_detalle" => $piso_detalle[$i]

                ];

                $guardarDetalleCotizacion = cotizacionModelo::agregar_detalle_cotizacion_modelo($datosDetalleCot);
            }

            if ($guardarDetalleCotizacion->rowCount() >= 1) {
              
                
                $alerta = [

                    "Alerta" => "redireccionar",
                    "Titulo" => "Cotizacion registrada",
                    "Texto" => "La cotización fue correctamente registrada ",
                    "Tipo" => "success",
                    "Contenido" => "vistas/pdf/cotizacionPrint-view.php?id=$codigo",
                    "Variable" => ""
                ];


            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "No se pudo registrar la cotización",
                    "Tipo" => "error"
                ];
            }

            return mainModel::sweet_alert($alerta);
        }
    }
    public function eliminar_cotizacion_controlador($id)
    {
        $eliminar=cotizacionModelo::eliminar_cotizacion_modelo($id);
        
        
        if ($eliminar->rowCount()>=1) { 
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al registrar Pago",
                "Tipo" => "success"
            ];
        }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo agregar pago. ¡Ups! 2",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);

    }

    public function paginador_cotizaciones_controlador($pagina, $registros,$busqueda)
    {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);

        $tabla = '';
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;


        if (isset($busqueda) && $busqueda != "" ) {
        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM Cotizacion co
                 INNER JOIN Cliente cli ON co.id_cliente=cli.id_cliente
                     INNER JOIN DetalleServicio det ON co.id_cotizacion=det.id_cotizacion 
                         INNER JOIN Usuario us ON co.id_usuario=us.id_usuario
                        WHERE (cli.nombres_cliente LIKE '%$busqueda%' 
                                                                        OR cli.apellido_paterno_cliente like '%$busqueda%' 
                                                                         OR cli.apellido_materno_cliente LIKE '%$busqueda%' 
                                                                         OR cli.dni_cliente LIKE '%$busqueda%'
                                                                         OR co.id_cotizacion LIKE '%$busqueda%'
                                                                         OR co.fecha_emision_cot LIKE '%$busqueda%'
                                                                         OR co.direccion_servicio_cotizacion LIKE '%$busqueda%'
                                                                         OR det.descripcion_detalle LIKE '%$busqueda%'
                                                                         ) and estado_cot='Pendiente'  GROUP BY co.id_cotizacion ASC LIMIT $inicio,$registros";
        $paginaurl = "cotizacionList";
        }else{
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM Cotizacion co
                         INNER JOIN Cliente cli ON co.id_cliente=cli.id_cliente
                         INNER JOIN DetalleServicio det ON co.id_cotizacion=det.id_cotizacion
                         INNER JOIN Usuario us ON co.id_usuario=us.id_usuario WHERE estado_cot='Pendiente'  GROUP BY co.id_cotizacion ASC LIMIT $inicio,$registros";
            $paginaurl = "cotizacionList";

        }



        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);

        $tabla .= '
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                Usuario
              </th>
              <th>
                Nro. Cotización
              </th>
              <th>
                Atencion
              </th>
              <th>
                 Cliente
              </th>
              <th>
                Descripcion 
              </th>
              <th>
              Direccion para Servicio
              </th>
              <th>
                Fecha de emision 
              </th>
              <th>
                Ver Pdf
              </th>
              <th>
                Eliminar
              </th>
            </tr>
          </thead>
          <tbody>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio;
            foreach ($datos as $rows) {
                $contador++;

                $tabla .= '
                
                <tr>
                <td class="py-1">
                    <img src="' . SERVERURL . 'vistas/images/cotizacion.png" alt="image" />
                </td>
                <td class="py-1">
                    ' . $rows["id_cotizacion"] . '
                </td>
                <td>
                ' . $rows["nombre_usuario"] . '
                </td>
                <td>
                ' . $rows["nombres_cliente"] . ' ' . $rows["apellido_paterno_cliente"] . '
                </td>
                <td>
                ';



                $tabla .= '  <span> 
                <select  style="width:160px; text-color:black;"  class="form-control">';

                $id_cotizacion = $rows['id_cotizacion'];
                $result = mainModel::ejecutar_consulta_simple("SELECT  * FROM DetalleServicio  WHERE id_cotizacion='$id_cotizacion'");


                foreach ($result as $key => $rows2) {


                    $tabla .= '<option class="text-black">' . $rows2["descripcion_detalle"] . '</option>
                    ';
                }
                $tabla .= ' </select>
                </span>
                </td>
                <td>
                    ' . $rows["direccion_servicio_cotizacion"] . '
                </td>
                <td>
                    ' . $rows["fecha_emision_cot"] . '
                </td>
                <td>';
                $path = "././vistas/pdf/cotizacionesClientes/";
                $i = 0;
                if (file_exists($path)) {
                    $directorio = opendir($path);
                    while ($archivo = readdir($directorio)) {
                        if (!is_dir($archivo) && $i++ == 0) {


                            $tabla .= '
							<a href="' . SERVERURL . 'vistas/pdf/cotizacionesClientes/' . $rows['id_cotizacion'] . '.pdf" ><img width="30" src="' . SERVERURL . 'vistas/images/pdf/logo.png" alt="Los Tejos" /></a>';
                        }
                    }
                } else {
                    $path = ".././vistas/pdf/cotizacionesClientes/";
                    $i = 0; $directorio = opendir($path);
                    while ($archivo = readdir($directorio)) {
                        if (!is_dir($archivo) && $i++ == 0) {


                            $tabla .= '
							<a href="' . SERVERURL . 'vistas/pdf/cotizacionesClientes/' . $rows['id_cotizacion'] . '.pdf" ><img width="30" src="' . SERVERURL . 'vistas/images/pdf/logo.png" alt="Los Tejos" /></a>';
                        }
                    }
                }

                    $tabla .= '
                </td>
                    
                <td>
                <form action="' . SERVERURL . 'ajax/cotizacion.php" method="POST" data-form="delete" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                           <input type="text" name="id_eliminar_cot" hidden value="' . $rows["id_cotizacion"] . '">
                        
                        <button type="submit" class="badge badge-danger">Eliminar</button>
                    </form>
                    
                    <div class="RespuestaAjax" id="RespuestaAjax">
                    </div>
                </td>
            </tr>
            ';
            }
            $tabla .= '</tbody>
                </table>';
            $contador++;
        } else {



            if ($total >= 1) {

                $tabla .= '
				<tr>
					<td colspan="5">
						<a href="' . SERVERURL . '/adminlist/" class="btn btn-sm btn-info btn-raised"> 
							Haga click para recargar el listado
						</a>
					</td>
				</tr>
			';
            } else {
                $tabla .= '
				<tr>
					<td colspan="5">No hay registros</td>
				</tr>
			';
            }
        }

        $tabla .= '</tbody></table></div>';


        if ($total >= 1 && $pagina <= $Npaginas  && $busqueda=='') {
            $tabla .= '<div class="d-flex justify-content-center">
            <nav aria-label="...">
      <ul class="pagination">';
            if ($pagina == 1) {
                $tabla .= '<li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>';
            } else {
                $tabla .= '<li class="page-item">
                <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($pagina - 1) . '" tabindex="-1">Previous</a></li>';
            }


            for ($i = 1; $i < $Npaginas; $i++) {
                if ($pagina == $i) {
                    $tabla .= '<li class="page-item active">
                        <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($i) . '">' . $i . '<span class="sr-only"></span></a>
                      </li>';
                } else {

                    $tabla .= ' <li class="page-item"><a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($i) . '">' . $i . '</a></li>';
                }
            }


            if ($pagina == $Npaginas) {
                $tabla .= '<li class="page-item disabled">
                <a class="page-link" href="#">Siguiente</a>
              </li>';
            } else {
                $tabla .= '
                <li class="page-item">
                    <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($pagina + 1) . '">Siguiente</a>
                 </li>';
            }


            $tabla .= '</ul></nav>';
        } else {
            echo '';
        }

        return $tabla;
    }
}
