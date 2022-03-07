<style>
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }

  .h-custom {
    height: calc(100% - 73px);
  }

  @media (max-width: 450px) {
    .h-custom {
      height: 100%;
    }
  }
</style>


<script></script>

	<!-- jquery -->
	<script src="<?php echo SERVERURL?>vistas/contenido/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="<?php echo SERVERURL?>vistas/contenido/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="">
        <img width="200" src="<?php echo SERVERURL?>vistas/images/gallo.png" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="<?php echo SERVERURL?>home">

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Iniciar Sesión</p>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Ingresar contraseña" />
      
          </div>


          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Ingresar">
            
          </div>

        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    
    <!-- Right -->
  </div>
</section>
