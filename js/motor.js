$(document).ready(init);

function init(){
  $("#registro").click(registroUsers);
  $("#listar").click(envioListar);
  $("#enviar").click(envioUsers);
  $("#crear").click(mostrarInsertar);
  $("#buscar").click(cuadroBuscar);
  $("#enviar_buscar").click(envioBuscar);
  $("#enviar1").click(envioInsertar);
  $("#quitar").click(ocultarInsertar);
  $("#quitar1").click(ocultarBorrar);
  $("#quitar2").click(ocultarBuscar);
  $("#quitar3").click(ocultarEditar);
  $("#eliminar").click(cuadroEliminar);
  $("#eliminar1").click(envioEliminar);
  $("#ordasc").click(envioOrdenarasc);
  $("#ordesc").click(envioOrdenardesc);
  $("#editar").click(mostrarEditar);
  $("#enviar_editar").click(envioEditar);
  $("#salir").click(envioSalir);

}

function envioSalir(){
  //var adios=<?php echo $session_value; ?>
// var miVar = '<?php echo $_SESSION['nombre']; ?>' alert(miVar);
  // var miVar='<?php echo $_SESSION['nombre']; ?>';
  // console.log("ADIOS USER"+window.sLevel=adios);
  // console.log("LLEGA"+miVar);
  $.ajax({

                  url:   './php/salir.php',
                  type:  'post',
                  beforeSend: function () {
                          alert("Se esta procesando su salida");
                  },
                  success:  function (response) {
                                   if(response){
                                     window.location.href="index3.html";
                                      $("#cuadro_adios").html("<h1>Hasta pronto Sr/a: "+adios+"</h1>");
                            }else{
                                  alert("No se ha podido salir");
                          }
                  }
          });
}

function envioOrdenardesc(){
  console.log("ENVIO ordenar DESC");

        $.ajax({
               
                url:   './php/ordenardesc.php',
                type:  'post',
                beforeSend: function () {
                        $("#tabla").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#tabla").html(response);
                }
        });

}

function envioOrdenarasc(){
  console.log("ENVIO ordenar ASC");

        $.ajax({
               
                url:   './php/ordenarasc.php',
                type:  'post',
                beforeSend: function () {
                        $("#tabla").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#tabla").html(response);
                }
        });

}


function envioListar(){
  console.log("ENVIO lista");

        $.ajax({
               
                url:   './php/listar.php',
                type:  'post',
                beforeSend: function () {
                        $("#tabla").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#tabla").html(response);
                }
        });
}


function registroUsers(){
  // console.log("VANLIDADNO");
  var form= $("#formulario_registro").serialize();
  // console.log(form['usuario']);
  // if((form.usuario != "")&&(form.contrasena!="")){
      $.post("php/registrar.php",form).done(function(data){registrorecibirDatos(data)});
  // }else{
  //     alert("Introduzca el nombre de usuario o el password");
  // }
  // console.log("MOSTRAMOS FORM"+form);

}

function registrorecibirDatos(data){
console.log("LLEGO A REGISTRO");
   // console.log("Valor de data: "+ data);
  if(data==true){
    //Acceder
     console.log("Valor de data: "+ data);
    window.location.href='index2.html';
  }else{
    //Error
    console.log("No accedo");
    $("#login").effect("shake");//Efecto de que la informacion intriducida no es correcta
  }
}



function envioUsers(){
  // console.log("VANLIDADNO");
  var form= $("#formulario").serialize();
  // console.log("MOSTRAMOS FORM"+form);
  $.post("php/acceder.php",form).done(function(data){recibirDatos(data)});
}

function recibirDatos(data){
   // console.log("Valor de data: "+ data);
  if(data){
    //Acceder
    // console.log("Valor de data: "+ data);
    window.location.href='index2.html';
  }else{
    //Error
    console.log("No accedo");
    $("#login").effect("shake");//Efecto de que la informacion intriducida no es correcta
  }
}

function cuadroEliminar(){
  $("#cuadro_borrar").css("display","block");
}

function mostrarEditar(){
  $("#cuadro_editar").css("display","block");
}

function ocultarEditar(){
  $("#cuadro_editar").css("display","none");
}

function ocultarBorrar(){
    $("#cuadro_borrar").css("display","none");
}


function ocultarBuscar(){
    $("#cuadro_buscar").css("display","none");
}
function cuadroBuscar(){
  $("#cuadro_buscar").css("display","block");
}


function envioEditar(){
  console.log("Editamos");
  $("#cuadro_editar").css("display","none");
  var nombre_articulo_viejo = document.getElementById("nombre_art_viejo");
  var url_articulo_viejo=document.getElementById("url_art_viejo");
  var precio_articulo_viejo =document.getElementById("precio_art_viejo");

  var nombre_articulo_nuevo = document.getElementById("nombre_art_nuevo");
  var url_articulo_nuevo=document.getElementById("url_art_nuevo");
  var precio_articulo_nuevo =document.getElementById("precio_art_nuevo");


  var str,str1,str2,str3,str4,str5;
  if ((nombre_articulo_viejo != null)||(url_articulo_viejo != null)||(precio_articulo_viejo != null)||(nombre_articulo_nuevo != null)||(url_articulo_nuevo != null)||(precio_articulo_nuevo != null)) {
     str = nombre_articulo_viejo.value;
     str1=url_articulo_viejo.value;
     str2=precio_articulo_viejo.value;
     str3 = nombre_articulo_nuevo.value;
     str4=url_articulo_nuevo.value;
     str5=precio_articulo_nuevo.value;
     console.log("AQUI"+str+str1+str2+str3+str4+str5);
 }
 else {
     str = null;
     str1=null;
     str2=null;
     str3=null;
     str4=null;
     str5=null;
 }

 console.log("NOMBRE VIEJO"+ nombre_articulo_viejo);
  console.log( "URL VIEJA"+ url_articulo_viejo);
  console.log( "precio VIEJO" + precio_articulo_viejo);
  console.log("NOMBRE NUEVO"+ nombre_articulo_nuevo);
   console.log( "URL NUEVA"+ url_articulo_nuevo);
   console.log( "precio NUEVA" + precio_articulo_nuevo);


 var parametros = {
                 "nombre_viejo" : str,
                 "url_viejo" : str1,
                 "precio_viejo": str2,
                 "nombre_nuevo" : str3,
                 "url_nuevo" : str4,
                 "precio_nuevo": str5
         };

          $.ajax({
                 data: parametros,
                  url:   './php/editar.php',
                  type:  'post',
                  beforeSend: function () {
                          $("#tabla").html("Procesando, espere por favor...");
                  },
                  success:  function (response) {
                          $("#tabla").html(response);
                  }
          });


}


function envioEliminar(){
  console.log("Eliminamos");
  $("#cuadro_borrar").css("display","none");
  var articulo_eliminar = document.getElementById("art_eliminar");

  var str,str1;
  if (articulo_eliminar != null) {
     str = articulo_eliminar.value;
     console.log(str);
  }
  else {
     str = null;

  }

  console.log("NOMBRE a eliminar"+ art_eliminar);
  var parametro= {
                  "nombre" : str     
          };

        $.ajax({
               data: parametro,
                url:   './php/borrar.php',
                type:  'post',
                beforeSend: function () {
                        $("#tabla").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#tabla").html(response);
                }
        });
}

function mostrarInsertar(){
  console.log("ENVIO insertar");
   $("#cuadro_anadir").css("display","block");
}

function ocultarInsertar(){
  console.log("ENVIO insertar");
   $("#cuadro_anadir").css("display","none");

}




function envioBuscar(){
  $("#cuadro_buscar").css("display","none");
  console.log("Buscamos");

  var articulo_buscar = document.getElementById("art_buscar");

  var str;
  if (articulo_buscar != null) {
     str = articulo_buscar.value;
     console.log("articulo buscar"+ str);
  }
  else {
     str = null;

  }

  console.log("NOMBRE a buscar"+ articulo_buscar.value);
  var parametro= {
                  "nombre" : str     
          };

        $.ajax({
               data: parametro,
                url:   './php/buscar.php',
                type:  'post',
                beforeSend: function () {
                        $("#tabla").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#tabla").html(response);
                }
        });



}


 function envioInsertar(){
// $.post("php/tabla.php").done(function(data){recibirDatos(data)});
$("#cuadro_anadir").css("display","none");
 var nombre_articulo = document.getElementById("nombre_art");
 var url_articulo=document.getElementById("url_art");
 var precio_articulo =document.getElementById("precio_art");
 var str,str1,str2;
 if ((nombre_articulo != null)||(url_articulo != null)||(precio_articulo != null)) {
    str = nombre_articulo.value;
    str1=url_articulo.value;
    str2=precio_articulo.value;
    console.log("AQUI"+str+str1+str2);
}
else {
    str = null;
    str1=null;
    str2=null;
}

console.log("NOMBRE"+ nombre_articulo);
 console.log( "URL"+ url_articulo);
 console.log( "precio" + precio_articulo);



var parametros = {
                "nombre" : str,
                "url" : str1,
                "precio": str2
        };
        $.ajax({
                data: parametros,
                url: './php/insertar.php',
                type:  'post',
                beforeSend: function () {
                        $("#tabla").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#tabla").html(response);
                }
        });
 }
