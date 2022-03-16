$("boton").click(function () {

  var valores = "";
  var a=0;
  var arregloFila = new Array();
  // Obtenemos todos los valores contenidos en los <td> de la fila
  // seleccionada
  $(this).parents("tr").find("#id").each(function () {
    arregloFila.push($(this).html() + "\n");
  });
  $(this).parents("tr").find("#nombre").each(function () {
    arregloFila.push($(this).html() + "\n");
  });
  $(this).parents("tr").find("#precio").each(function () {
    arregloFila.push($(this).html() + "\n");
  });
  $(this).parents("tr").find("#algo").each(function () {
    arregloFila.push($(this).html() + "\n");
  });

  $("table tr").each(function() {
    a++;
})

  var div = document.createElement('tr');
  div.className= "total-data";
  div.setAttribute("id",a);
  div.innerHTML = '<td><label></label>'+a+'</td><td><strong>'+arregloFila[1]+'<button type="button" onclick="" class="btn btn-outline-success" data-toggle="modal" data-target="#modalObservacion">Obs.</button></strong></td><td><input style="height:40px; width : 50px;"   type="number" class="form-control" value="1"></td><td><div class="row"><button type="button"  onclick="eliminar('+a+')" class="btn btn-outline-danger">x</button>  <button type="button"  class="btn btn-outline-success">✓</button></div></td>';
  document.getElementById('nuevoform').appendChild(div);
  document.getElementById("alerta").style.display = "block";


  $('#alerta').fadeIn();     
  setTimeout(function() {
       $("#alerta").fadeOut();           
  },1000);
  
});

function  eliminar (n) {
  jQuery("tr").remove(`#${n}`);
  a = a - 1;
  if (a <= 0) {
    a = 0;
  }
  
  document.getElementById("hola").style.display = "block";


  $('#hola').fadeIn();     
  setTimeout(function() {
       $("#hola").fadeOut();           
  },1000);
  
}
