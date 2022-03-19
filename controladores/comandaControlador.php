<?php
if ($peticionAjax) {
    require_once "../modelos/comandaModelo.php";
} else {
    require_once "./modelos/comandaModelo.php";
}

class comandaControlador extends comandaModelo
{

    public static function agregar_comanda_controlador()
    {   
        //Dos de comanda
        
        //Arreglos de producto
        $id_producto=$_POST["producto"];
        $cantidad=$_POST["cantidad"];
        $observacion=$_POST["observacion"];
        $cortesia=$_POST["cortesia"];

        //piso,mesa y personas
        $piso=$_POST["piso"];
        $mesa=$_POST["mesa"];
        $nroHombres=$_POST["nroHombres"];
        $nroMujeres=$_POST["nroMujeres"];
        $nroNinios=$_POST["nroNinios"];
        echo'<br><h6>datos de producto <br></h6>';
        print_r($_POST);
        echo'<br><h6>Datos de Empresa<br></h6>';
        echo " Empresa => ".EMPRESA;
        echo " Local => ".LOCAL;

        //Datos de Apertura
        $data_apertura=[
            
            "empr_codigo"=> EMPRESA,
            "locale_codigo"=> LOCAL
        ];
        //Consulta si existe caja aperturada # y datos
        $apertura_caja_nro=comandaModelo::get_num_caja_apertura_modelo($data_apertura);
        $apertura_caja_data=comandaModelo::get_caja_apertura_modelo($data_apertura);
        if ($apertura_caja_nro == 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Acceso denegado",
                "Texto" => "No existe caja aperturada para el registro de comandas. Comuníquese con el encargado.",
                "Tipo" => "error"
            ];
        } elseif($apertura_caja_nro > 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Acceso denegado",
                "Texto" => "Acceso denegado!!!', 'Existe más de una caja aperturada para el registro de comandas. Comuníquese con el encargado.",
                "Tipo" => "error"
            ];
        }else{
            echo'<br><h6>datos de apertura de caja <br></h6>';
            print_r($apertura_caja_data);


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Completado",
                "Texto" => "Todos los datos estan preparados",
                "Tipo" => "success"
            ];
        }

        
        //Get correlativo
        $ls_numero='';
        //get año
        $fecha=comandaModelo::fecha_hora_sistema();
        $anio = date("Y", strtotime($fecha["fecha"]));
        //get correlativo
        $datos=[
            "anio"=> $anio,
            "empr_codigo"=> EMPRESA,
            "locale_codigo"=> LOCAL
        ];
        $correlativo=comandaModelo::get_correlativo_modelo($datos);
        if (is_null($correlativo["numeromax"])) {
            $correlativo["numeromax"]=0;
        }else{
            $correlativo["numeromax"]++;
        }
        //crear cadena
        $ls_numero=$anio.substr(("000000".$correlativo["numeromax"]),-6);
        
        echo'<br><h6>Correlativo de este año <br></h6>';
        echo "Correlativo : ".$ls_numero;


        //datos de usuario
        echo'<br><h6>Datos de usuario<br></h6>';
        echo "ID : ".$_POST["comper_codigo"]."<br>";
        

        //recuperar agente
        $id_comper=$_POST["comper_codigo"];
        $data_agente=[
            "comper_codigo" => $id_comper,
            "empr_codigo"=> EMPRESA,
            "locale_codigo"=> LOCAL
        ];
        $agente=comandaModelo::get_agente_comanda_modelo($data_agente);
        echo "  ".$agente["comper_apenom"];


        
        return mainModel::sweet_alert($alerta);
    }
}
