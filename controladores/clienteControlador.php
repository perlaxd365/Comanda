<?php
if ($peticionAjax) {
    require_once "../modelos/clienteModelo.php";
} else {
    require_once "./modelos/clienteModelo.php";
}

class clienteControlador extends clienteModelo
{

    public static function agregar_cliente_controlador()
    {

        $dni_cliente = mainModel::limpiar_cadena($_POST['dni_cliente']);
        $nombre_cliente = mainModel::limpiar_cadena($_POST['nombre_cliente']);
        $apellido_paterno_cliente = mainModel::limpiar_cadena($_POST['apellido_paterno_cliente']);
        $apellido_materno = mainModel::limpiar_cadena($_POST['apellido_materno']);
        $numero_cliente = mainModel::limpiar_cadena($_POST['numero_cliente']);
        $correo_cliente = mainModel::limpiar_cadena($_POST['correo_cliente']);
        $direccion_cliente = mainModel::limpiar_cadena($_POST['direccion_cliente']);
        $direccion_servicio_cliente = mainModel::limpiar_cadena($_POST['direccion_servicio_cliente']);



        $dataCliente = [

            "dni_cliente" => $dni_cliente,
            "nombres_cliente" => $nombre_cliente,
            "apellido_paterno_cliente" => $apellido_paterno_cliente,
            "apellido_materno_cliente" => $apellido_materno,
            "numero_cliente" => $numero_cliente,
            "correo_cliente" => $correo_cliente,
            "direccion_cliente" => $direccion_cliente,
            "direccion_trabajo_cliente" => $direccion_servicio_cliente

        ];

        $guardarCliente = clienteModelo::agregar_cliente_modelo($dataCliente);
        if ($guardarCliente->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al registrar Cliente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo registrar cliente. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }

    public static function actualizar_cliente_controlador()
    {

        $id_cliente = mainModel::limpiar_cadena($_POST['actualizacion_cliente']);
        $dni_cliente = mainModel::limpiar_cadena($_POST['dni_cliente']);
        $nombre_cliente = mainModel::limpiar_cadena($_POST['nombre_cliente']);
        $apellido_paterno_cliente = mainModel::limpiar_cadena($_POST['apellido_paterno_cliente']);
        $apellido_materno = mainModel::limpiar_cadena($_POST['apellido_materno']);
        $numero_cliente = mainModel::limpiar_cadena($_POST['numero_cliente']);
        $correo_cliente = mainModel::limpiar_cadena($_POST['correo_cliente']);
        $direccion_cliente = mainModel::limpiar_cadena($_POST['direccion_cliente']);
        $direccion_servicio_cliente = mainModel::limpiar_cadena($_POST['direccion_servicio_cliente']);



        $dataCliente = [

            "id_cliente" => $id_cliente,
            "dni_cliente" => $dni_cliente,
            "nombres_cliente" => $nombre_cliente,
            "apellido_paterno_cliente" => $apellido_paterno_cliente,
            "apellido_materno_cliente" => $apellido_materno,
            "numero_cliente" => $numero_cliente,
            "correo_cliente" => $correo_cliente,
            "direccion_cliente" => $direccion_cliente,
            "direccion_trabajo_cliente" => $direccion_servicio_cliente

        ];

        $guardarCliente = clienteModelo::actualizar_cliente_modelo($dataCliente);
        if ($guardarCliente->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al actualizar Cliente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo actualizar cliente. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }



    public static function data_cliente_controlador($id)
    {
        return clienteModelo::data_cliente_modelo($id);
    }

    public static function eliminar_cliente_controlador($id)
    {
        $eliminar = clienteModelo::eliminar_cliente_modelo($id);

        if ($eliminar->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al eliminar Cliente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo eliminar cliente. ¡Ups!",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }


    public function paginador_cliente_controlador($pagina, $registros, $busqueda)
    {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);

        $tabla = '';
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {

            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM Cliente WHERE (nombres_cliente LIKE '%$busqueda%' 
                                                                        OR apellido_paterno_cliente like '%$busqueda%' 
                                                                         OR apellido_materno_cliente LIKE '%$busqueda%' 
                                                                         OR dni_cliente LIKE '%$busqueda%' ) AND estado_cliente='Activo' ORDER BY id_cliente ASC LIMIT $inicio,$registros";
            $paginaurl = "clienteList";
        } else {

            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM Cliente WHERE estado_cliente='Activo' ORDER BY id_cliente ASC LIMIT $inicio,$registros";
            $paginaurl = "clienteList";
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
                #
              </th>
              <th>
                Usuario
              </th>
              <th>
                Nombres
              </th>
              <th>
                Correo
              </th>
              <th>
                Direccion para Servicio
              </th>
              <th>
                Actualizar
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
                    ' . $contador . '
                </td>
                <td class="py-1">
                    <img src="' . SERVERURL . 'vistas/images/cliente.png" alt="image" />
                </td>
                <td>
                ' . $rows["nombres_cliente"] . ' ' . $rows["apellido_paterno_cliente"] . '
                </td>
                <td>
                    ' . $rows["correo_cliente"] . '
                </td>
                <td>
                    ' . $rows["direccion_trabajo_cliente"] . '
                </td>
                <td>
                    <a href="' . SERVERURL . 'clienteUP/' . $rows["id_cliente"] . '" class="badge badge-success">Actualizar</a>
                </td>
                <td>
                <form action="' . SERVERURL . 'ajax/cliente.php" method="POST" data-form="delete" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                           <input type="text" name="eliminar_cliente" hidden value="' . $rows["id_cliente"] . '">
                        
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


        if ($total >= 1 && $pagina <= $Npaginas && $busqueda=='') {
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

    public function mostrar_direccion_cliente_controlador($id)
    {

        $direccion = '';
        $result = mainModel::ejecutar_consulta_simple("SELECT direccion_trabajo_cliente FROM Cliente WHERE id_cliente='$id'");

        foreach ($result as $key => $row) {
            $direccion = $row["direccion_trabajo_cliente"];
        }

        echo '<div class="form-group">
        <label for="exampleInputUsername1">Direccion para Servicio</label>
        <input value="' . $direccion . '" name="direccion_servicio_cliente" type="text" class="form-control" id="exampleInputUsername1" placeholder="Ingresar la descripcion">
        </div>';
    }

    public function consultar_dni($dni)
    {

        $token = 'b2dc3c11c3cfafb54e29a54b4f9335d06864a4b916b20935bd12a673ff23add2';
        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar dni
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: https://apis.net.pe/consulta-dni-api',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // Datos listos para usar
        $persona = json_decode($response);

        echo $persona->nombres;
    }
}
