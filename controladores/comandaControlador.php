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

        print_r($_POST);
    }
}
