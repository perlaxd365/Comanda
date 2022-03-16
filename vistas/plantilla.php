<!DOCTYPE html>
<html lang="en">



  

</html>
					<style type="text/css"> 
        thead tr th { 
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #ffffff;
        }
    
        .table-responsive { 
            height:200px;
            overflow:scroll;
        }
    </style>

<?php

session_start(['name' => 'COMANDA']);
$peticionAjax = false;
require_once "./controladores/vistasControlador.php";

$vt = new vistasControlador();
$vistasR = $vt->obtener_vistas_controlador();

if ($vistasR == "login" || $vistasR == "404") {
  if ($vistasR == "404") {

    require_once "./vistas/contenido/404-view.php";
  } else {include "modulos/header.php"; 
    include "modulos/script.php";
    require_once "./vistas/contenido/login-view.php";
  }
} else {



  include "./controladores/loginControlador.php";
  $lc = new loginControlador();
  if (!isset($_SESSION['token_comanda'])) {
    echo $lc->forzar_cierre_sesion_controlador();
    header("location:" . SERVERURL . "");
  }
?>

<?php include "modulos/nav.php";
?>
	<!-- end header --><!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg" style="margin-top: -330px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <p>Bienvenido</p>
            <h1>Inicio</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  




  <!-- search area -->

  <head>

<?php include "modulos/header.php"; ?>



  </body>
	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->
  <?php require_once $vistasR; ?>



  <?php include "modulos/script.php"; ?>
  <?php include "modulos/logoutScript.php"; ?>
<?php
}
?>