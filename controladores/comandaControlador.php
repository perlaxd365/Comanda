<?php
if ($peticionAjax) {
    require_once "../modelos/comandaModelo.php";
} else {
    require_once "./modelos/comandaModelo.php";
}
/* incluir libreria printer*/
require '/../vendor/mike42/escpos-php/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class comandaControlador extends comandaModelo
{

    public static function agregar_comanda_controlador()
    {
        //codigo de comanda codigo_comanda
        $codigo_comanda_existente = $_POST["codigo_comanda"];

        //Arreglos de producto
        $id_producto = $_POST["producto"];
        $cantidad = $_POST["cantidad"];
        $observacion = $_POST["observacion"];
        $descpro = $_POST["descpro"];
        $preciopro = $_POST["preciopro"];
        $cortesia = $_POST["cortesia"];

        //piso,mesa y personas
        $totalInputs = $_POST["totalInputs"];
        $piso = $_POST["piso"];
        $mesa = $_POST["mesa"];
        $nroHombres = $_POST["nroHombres"];
        $nroMujeres = $_POST["nroMujeres"];
        $nroNinios = $_POST["nroNinios"];
        $cliente = $_POST["cliente"];
        $usua_codigo = $_POST["usua_codigo"];
        $preciototal = $_POST["preciototal"];


        echo '<br><h6>Datos de producto <br></h6>';
        print_r($_POST);
        echo '<br><h6>Datos de Empresa<br></h6>';
        echo " Empresa => " . EMPRESA;
        echo " Local => " . LOCAL;

        //Datos de Apertura
        $data_apertura = [

            "empr_codigo" => EMPRESA,
            "locale_codigo" => LOCAL
        ];
        //Consulta si existe caja aperturada # y datos
        $apertura_caja_nro = comandaModelo::get_num_caja_apertura_modelo($data_apertura);
        $apertura_caja_data = comandaModelo::get_caja_apertura_modelo($data_apertura);
        echo '<br><h6>datos de apertura de caja </h6><br>';
        $apertu_fecha = $apertura_caja_data["apertu_fecha"];
        $apertu_turno = $apertura_caja_data["apertu_turno"];
        $apertu_hora = $apertura_caja_data["apertu_hora"];
        print_r($apertura_caja_data);

        if ($apertura_caja_nro == 0) {
            echo 'Caja no se encuentra aperturada';
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Acceso denegado",
                "Texto" => "No existe caja aperturada para el registro de comandas. Comuníquese con el encargado.",
                "Tipo" => "error"
            ];
        } elseif ($apertura_caja_nro > 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Acceso denegado",
                "Texto" => "Acceso denegado!!!', 'Existe más de una caja aperturada para el registro de comandas. Comuníquese con el encargado.",
                "Tipo" => "error"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Completado",
                "Texto" => "Todos los datos estan preparados",
                "Tipo" => "success"
            ];
        }


        //Get correlativo
        $ls_numero = '';
        //get año
        $fecha = comandaModelo::fecha_hora_sistema();
        //get año
        echo $fecha["fecha"];
        $anio = date("Y", strtotime($fecha["fecha"]));
        //data parámetros
        $datos = [
            "anio" => $anio,
            "empr_codigo" => EMPRESA,
            "locale_codigo" => LOCAL
        ];
        $correlativo = comandaModelo::get_correlativo_modelo($datos);
        if (is_null($correlativo["numeromax"])) {
            $correlativo["numeromax"] = 0;
        } else {
            $correlativo["numeromax"]++;
        }
        //crear cadena
        $ls_numero = $anio . substr(("000000" . $correlativo["numeromax"]), -6);

        echo '<br><h6>Correlativo de este año </h6><br>';
        echo "Correlativo : " . $ls_numero;


        //datos de usuario
        echo '<br><h6>Datos de usuario</h6><br>';
        echo "ID : " . $_POST["comper_codigo"] . "<br>";
        echo "CODIGO : " . $_POST["usua_codigo"] . "";
        $usua_codigo = $_POST["usua_codigo"];


        //recuperar agente
        $id_comper = $_POST["comper_codigo"];
        $data_agente = [
            "comper_codigo" => $id_comper,
            "empr_codigo" => EMPRESA,
            "locale_codigo" => LOCAL
        ];
        $agente = comandaModelo::get_agente_comanda_modelo($data_agente);
        echo '<br><h6>Nombre Apellido Comper</h6><br>';
        $agente = $agente["comper_apenom"];
        echo "  " . $agente;

        //codigo de comanda
        $codigo = comandaModelo::get_codigo_comanda_modelo();
        echo '<br><h6>Codigo de comanda</h6><br>';
        $codigo = $codigo["codigo"];
        echo "  " . $codigo;

        //Get fecha y hora actual
        echo "<br>";
        $fecha = comandaModelo::fecha_hora_sistema();
        $fechaactual = date("Y-m-d", strtotime($fecha["fecha"]));
        $horaactual = date("H:i", strtotime($fecha["fecha"]));
        echo '<br><h6>Fecha y Hora</h6><br>';
        echo $fechaactual . " - " . $horaactual;


        //SUBTOTAL , IGV Y TOTAL
        echo '<br><h6>SUBTOTAL , IGV Y TOTAL<br></h6>';
        $monto = $preciototal;
        echo " <br>Monto " . $monto . " <br>";
        $igv = $monto / 1.18;
        echo "<br> igv = " . $igv . "<br>";
        $montoSinIgv = $monto - $igv;
        echo "<br> monto sin igv = " . $montoSinIgv . "<br>";
        $total = $monto - $igv;
        echo "<br> monto total= " . $total . "<br>";

        //ID DE MESA
        $dataMesa = ["mesa" => $mesa];
        $getid = comandaModelo::get_id_mesa_modelo($dataMesa);
        echo '<br><h6>ID Mesa</h6><br>';
        $id_mesa = $getid["commes_codigo"];
        echo "<br> id_mesa = " . $id_mesa . "<br>";



        $dataComanda = [
            "comcom_codigo" => $codigo,
            "empr_codigo" => EMPRESA,
            "apertu_fecha" => $apertu_fecha,
            "apertu_turno" => $apertu_turno,
            "apertu_hora" => $apertu_hora,
            "commes_codigo" => $id_mesa,
            "comper_codigo" => $id_comper,
            "clie_codigo" => NULL,
            "locale_codigo" => LOCAL,
            "comcom_cliente_apenom" => $cliente,
            "comcom_numero" => $ls_numero,
            "comcom_fecha" => $fechaactual,
            "comcom_hora" => $horaactual,
            "comcom_estado" => '01',
            "comcom_montobase_soles" => $montoSinIgv, "USD",
            "comcom_montobase_dolares" => NULL,
            "comcom_montoigv_soles" => $igv, "USD",
            "comcom_montoigv_dolares" => NULL,
            "comcom_montototal_soles" => $preciototal, "USD",
            "comcom_montototal_dolares" => null,
            "comcom_tipocambio" => NULL,
            "comcom_porcigv" => 18,
            "comcom_mesas" => $mesa,
            "comcom_vigencia" => "SI",
            "comcom_cant_masculino" => $nroHombres,
            "comcom_cant_femenino" => $nroMujeres,
            "comcom_cant_nino" => $nroNinios,
            "comcom_impresion" => 0,
            "comcom_fact_ant" => NULL,
            "empr_codigo_factura" => EMPRESA,
            "comcom_agente" => $agente,
            "usua_eliminacion" => NULL,
            "fecha_eliminacion" => NULL,
            "usua_creacion" => $usua_codigo,
            "fecha_creacion" => $fecha["fecha"],
            "usua_modificacion" => NULL,
            "fecha_modificacion" => NULL,
            "usua_autoriza_eliminacion" => NULL

        ];

        //validamos que este entrando nuevo pedido, de lo contrario no agregamos y nos pasamos a agregar detalle
        if ($codigo_comanda_existente == '' ||  $codigo_comanda_existente == null) {
            $insertComanda = comandaModelo::agregar_comanda_modelo($dataComanda);
        } else {
            $insertComanda = 2;
        }


        if ($insertComanda >= 1 || (isset($codigo_comanda_existente) && $codigo_comanda_existente != '')) {

            for ($i = 0; $i < $totalInputs; $i++) {

                //arrays
                $id_producto = json_decode($id_producto);
                $cantidad = json_decode($cantidad);
                $observacion = json_decode($observacion);
                $descpro = json_decode($descpro);
                $preciopro = json_decode($preciopro);
                $cortesia = json_decode($cortesia);

                $corte = '';
                $obs = '';
                //obtener ultimo codigo de comanda detalle para evitar duplicidad
                if (isset($codigo_comanda_existente) && $codigo_comanda_existente != '') {
                    $dataCodigo = ["comcom_codigo" => $codigo_comanda_existente];

                    $ultimoId = comandaModelo::get_nro_item_comanda_detalle($dataCodigo);
                    $segundoContador = $ultimoId["ultimoId"] + 1;
                } else {

                    $segundoContador = 1;
                }
                $ordenContador = 0;
                for ($i = 0; $i < $totalInputs; $i++) {

                    $ordenContador++;
                    $codigoPro = ["prod_codigo" => $id_producto[$i]];
                    //CODIGO INTERNO DE PRODUCTO get_cod_interno_producto_modelo
                    $geCodigoPro = comandaModelo::get_cod_interno_producto_modelo($codigoPro);

                    $cod_int_pro = $geCodigoPro["prod_codigo_interno"];

                    if ($cortesia[$i] == "") {
                        $corte = "NO";
                    } elseif ($cortesia[$i] == 1) {
                        $corte = "SI";
                    }
                    if ($observacion[$i] == "") {
                        $obs = "NO";
                        $observacion[$i] = NULL;
                    } else {
                        $obs = "SI";
                    }
                    $id_pro = $id_producto[$i];
                    //validamos si el codigo es nuevo o existente

                    if (isset($codigo_comanda_existente) && $codigo_comanda_existente != '') {
                        $codigo = $codigo_comanda_existente;
                    }
                    //quitar coma
                    $dataComandaDetalle = [

                        "comcom_codigo" => $codigo,
                        "empr_codigo" => EMPRESA,
                        "cocode_item" => $segundoContador++,
                        "alma_codigo" => '01',
                        "prod_codigo" => $id_pro,
                        "comoca_codigo" => NULL,
                        "comoca_abreviatura" => NULL,
                        "cocode_producto" => $descpro[$i],
                        "cocode_precio_soles" =>  $preciopro[$i],
                        "cocode_precio_dolares" => NULL,
                        "cocode_cantidad" => $cantidad[$i],
                        "cocode_subtotal_soles" =>  $preciopro[$i] * $cantidad[$i],
                        "cocode_subtotal_dolares" => NULL,
                        "cocode_cortesia" => $corte,
                        "cocode_cancelado" => "NO",
                        "cocode_enviado" => "NO",
                        "cocode_conpropiedades" => "NO",
                        "cocode_conobservaciones" => $obs,
                        "cocode_observaciones" => $observacion[$i],
                        "cocode_orden" => $ordenContador,
                        "cocode_grupo" => $ordenContador,
                        "prpr_codigo" => NULL,
                        "prpr_descripcion" => NULL,
                        "cocode_fact_atend" => 0,
                        "cocode_fact_saldo" => 1,
                        "cocode_producto_codint" => $cod_int_pro,
                        "usua_creacion" => $usua_codigo,
                        "fecha_creacion" => $fecha["fecha"],
                        "usua_modificacion" => NULL,
                        "fecha_modificacion" => NULL,
                        "usua_cancelado" => NULL,
                        "fecha_cancelado" => NULL,
                        "cocode_costo_producto" => 0.00,
                        "cocode_atendido" => NULL,
                        "cocode_atendido_fechahora" => NULL,
                        "usua_autoriza_cancelado" => NULL,
                        "cocode_pedido_hora" => NULL,


                    ];
                    $insertComandaDetalle = comandaModelo::agregar_comanda_detalle_modelo($dataComandaDetalle);
                }
            }
            if ($insertComandaDetalle >= 1) {
                $cod_comanda = '';
                if (isset($codigo_comanda_existente) && $codigo_comanda_existente != '') {
                    $cod_comanda = $codigo_comanda_existente;
                } else {
                    $cod_comanda = $codigo;
                }
                $dataCodigo = [
                    "comcom_codigo" => $cod_comanda,
                    "empr_codigo" => EMPRESA
                ];
                $listarTicketeras = comandaModelo::get_lista_ticket_modelo($dataCodigo);

                $textoPrint = '';
                while ($filas = odbc_fetch_array($listarTicketeras)) {
                    $comare_codigo = $filas["comare_codigo"];
                    $comare_ticketera = $filas["comare_ticketera"];
                    $comare_nroimpresion = $filas["comare_nroimpresion"];
                    $dataComposicion = [
                        "comcom_codigo" => $cod_comanda,
                        "comare_codigo" => $comare_codigo,
                        "empr_codigo" => EMPRESA,
                        "local_codigo" => LOCAL
                    ];

                    $DetalleComanda = comandaModelo::get_lista_composicion_comanda_imprimir_modelo($dataComposicion);
                    $ticketeras = comandaModelo::get_lista_composicion_comanda_imprimir_modelo($dataComposicion);
                    if (odbc_num_rows($DetalleComanda) > 0) {

                        $campos = odbc_fetch_array($DetalleComanda);


                        $OpcionPrint = true;
                        $textoPrintDetalle = '';
                        while ($filasComposicion = odbc_fetch_array($ticketeras)) {
                            $enviado = $filasComposicion["cocode_enviado"];
                            if ($enviado == "NO") {

                                $textoPrintDetalle .= mainModel::moneyFormat($filasComposicion["cocode_cantidad"], "USD")  . " " . $filasComposicion["cocode_producto"];
                                $textoPrintDetalle .= "<br>";
                                $dataUpPrint = [

                                    "comcom_codigo" => $cod_comanda,
                                    "cocode_item" => $filasComposicion["cocode_item"]

                                ];
                                comandaModelo::actualizar_envio_print_producto_modelo($dataUpPrint);
                            } elseif ($filasComposicion["cocode_enviado"] == "SI") {
                            }
                        }

                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Completado",
                            "Texto" => "Se envio correctamente la comanda.",
                            "Tipo" => "success"
                        ];


                        if ($textoPrintDetalle != '') {
                            $textoPrint .= "<br>";
                            $textoPrint .= "--------------------------------------";
                            $textoPrint .= "<br>";
                            $textoPrint .= "IMPRE.     : " . $comare_ticketera;
                            $textoPrint .= "<br>";
                            $textoPrint .= "MESA     : " . $campos["comcom_mesas"];
                            $textoPrint .= "<br>";
                            $textoPrint .= "PEDIDO   : " . $campos["comcom_numero"];
                            $textoPrint .= "<br>";
                            $textoPrint .= "ENVÍO    : " . $campos["fecha_modificacion"] . " " . $campos["hora_modificacion"];
                            $textoPrint .= "<br>";
                            $textoPrint .= "AGENTE   : " . $campos["comper_apenom"];
                            $textoPrint .= "<br>";
                            $textoPrint .= "CLIENTE  : " . $campos["comcom_cliente_apenom"];
                            $textoPrint .= "<br>";


                            $textoPrint .= "PRODUCTOS";
                            $textoPrint .= "<br>";
                            $textoPrint .= $textoPrintDetalle;
                            //APLICAR IMPRESION
                            try {
                                // Enter the share name for your USB printer here
                                $connector = new WindowsPrintConnector($comare_ticketera);

                                /* Print a "Hello world" receipt" */
                                $printer = new Printer($connector);
                                $printer->text($textoPrint);
                                $printer->cut();

                                /* Close printer */
                                $printer->close();
                            } catch (Exception $e) {
                                echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
                            }


                            //FIN DE IMPRESION
                        } else {
                        }
                    }
                }
                /* $alerta = [

                        "Alerta" => "pagina",
                        "Titulo" => "Completado",
                        "Texto" => "Exito al registrar comanda",
                        "Tipo" => "success",
                        "Contenido" => "home"
                    ]; */
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "No se pudo registrar el detalle de la comanda. ¡Ups!",
                    "Tipo" => "error"
                ];
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo registrar comanda. ¡Ups!",
                "Tipo" => "error"
            ];
        }
        echo $textoPrint;
        return mainModel::sweet_alert($alerta);
    }

    public function data_comanda_controlador($codigo_comanda)
    {
        $data = ["comcom_codigo" => $codigo_comanda];
        return comandaModelo::data_comanda_modelo($data);
    }

    public function get_piso_mesa_controlador($codigo_mesa)
    {
        $data = ["commes_codigo" => $codigo_mesa];
        return comandaModelo::get_piso_mesa_modelo($data);
    }

    public function update_cortesia_comanda_detalle_controlador()
    {
        $cortesia = $_POST["cocode_cortesia"];
        if ($cortesia == "SI") {
            $cortesia = "NO";
        } else {

            $cortesia = "SI";
        }
        $data = [
            "comcom_codigo" => $_POST["comcom_codigo"],
            "cocode_item" => $_POST["cocode_item"],
            "cortesia" => $cortesia
        ];
        $guardar = comandaModelo::update_cortesia_comanda_detalle_modelo($data);
        if ($guardar >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se añadió cortesía correctamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se agregar cortesía",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }


    public function delete_comanda_deltalle_controlador()
    {

        $data = [
            "comcom_codigo" => $_POST["comcom_codigo"],
            "cocode_item" => $_POST["cocode_item"]
        ];
        $guardar = comandaModelo::delete_comanda_detalle_modelo($data);
        if ($guardar >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se retiró producto correctamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se agregar cortesía",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }


    public static function recuperar_observacion_controlador()
    {
        $comcom_codigo = mainModel::limpiar_cadena($_POST['comandaObser']);
        $cocode_item = mainModel::limpiar_cadena($_POST['item']);
        $dataObs = [

            "comcom_codigo" => $comcom_codigo,
            "cocode_item" => $cocode_item

        ];


        $result = comandaModelo::observacion_comanda_detalle_modelo($dataObs);
        $filas = odbc_fetch_array($result);
        $tabla = '
        				
                    <div class="form-group col-12">
                        <label for="inputPassword2" class="sr-only">Observaciones</label>
                            <textarea class="form-control" name="obs_up" id="exampleFormControlTextarea1" rows="3" cols="55">' . $filas["cocode_observaciones"] . '</textarea>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" onclick="guardarObservación(' . $comcom_codigo . ',' . $cocode_item . ');" class="btn btn-primary">Guardar</button>
                
                <div class="RespuestaAjax" id="RespuestaAjax">
                </div>';


        return $tabla;
    }

    public function actualizar_obser_controlador()
    {

        $data = [
            "comcom_codigo" => $_POST["codigo_comanda"],
            "cocode_item" => $_POST["item"],
            "observacion" => $_POST["observacion"]

        ];
        $guardar = comandaModelo::actualizar_observacion_modelo($data);
        if ($guardar >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Completado",
                "Texto" => "Se actualizó la observación correctamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se actualizó la observación",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }


    public function actualizar_cantidad_detalle_controlador()
    {

        $data = [
            "comcom_codigo" => $_POST["comcom_codigo"],
            "cocode_item" => $_POST["cocode_item"],
            "cocode_cantidad" => $_POST["cantidad_productos"]

        ];
        $guardar = comandaModelo::actualizar_cantidad_producto_modelo($data);
        if ($guardar >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se actualizó la cantidad correctamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se actualizó la cantidad",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }
}
