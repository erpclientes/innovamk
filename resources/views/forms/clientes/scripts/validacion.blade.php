<script type="text/javascript">
  //---------JPaiva--06-02-2019---------VALIDAR INPUTs-----------------------------------
  @foreach($parametros as $val)
    if('{{$val->parametro}}' == 'NRO_DOC_ALFANUM'){
      if('{{$val->valor}}' == 'SI'){
        $('#nro_documento').mask('AAAAAAAAAAAAAAAAAAAA', {'translation': {
            A: {pattern: /[A-Za-z0-9--]/}
          }
        });
      }else{
        $('#nro_documento').mask('09999999999999999999)');
      }
    }
  @endforeach
  
  $('#apaterno').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
    A: {pattern: /[A-Za-zñòóÑ\s]/}
    }
  });
  $('#amaterno').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-zñòóÑ\s]/}
       
    }
  }); 
  $('#nombres').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
    A: {pattern: /[A-Za-zñòóÑ\s]/}
    }
  });

  //--------JPaiva--06-02-2019--------VALIDA ID QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#nro_documento").focusout(function() {
    focus++;
    console.log(focus);

    var data = $(this).val();

          $.ajax({
              url: "{{ url('/cliente/verificarID') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/cliente/verificarID') }}",
             data:{
              codigo:data,
              parametro:$('#parametro').val()
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#nro_documento').val('');
                  $('#nro_documento').focus();

                  setTimeout(function() {
                    M.toast({ html: '<span>El Nro. Documento ingresado ya existe. Ingrese uno distinto.</span>'});
                  }, 1000); 
                }
                //--------JMAZUELOS 04-08-2020--------AGREGAR DATOS DEL CLIENTE AL FORMULARIO-----------------------------------------

                if(data.errors == 'ESTADO_5'){ //
                  $('#validarIdCliente').modal('open');  
                    $("#aceptarVerificacion").click(function(g){ 
                      $('#DatosIdCliente').modal('open');  
                        //mandamos los datos al modal
                        $('#nro_documentoD').val(data.nro_documento); 
                        $('#nombresD').val(data.nombres);  
                        $('#amaternoD').val(data.amaterno);
                        $('#apaternoD').val(data.apaterno);
                        $('#latitudD').val(data.latitud); 
                        $('#longitudD').val(data.longitud);
                        $('#direccionD').val(data.direccion); 
                        $('#correoD').val(data.correo); 
                        $('#telefono1D').val(data.telefono1);
                        //clic en pintar datos en formulario  
                        $("#aceptarDatos").click(function(h){    
                          $('#nombres').val(data.nombres); 
                          $('#amaterno').val(data.amaterno);
                          $('#apaterno').val(data.apaterno);
                          $('#latitud').val(data.latitud); 
                          $('#longitud').val(data.longitud);
                          $('#direccion').val(data.direccion); 
                          $('#correo').val(data.correo);
                          $('#DatosIdCliente').modal('close') 
                        });  
                      //cancelar 
                      $("#cancelarDatos").click(function(){
                        $('#nro_documento').val('');
                        $('#nro_documento').focus();
                      });
                    });   
                    $("#cancelarVerificacion").click(function(){
                      $('#nro_documento').val('');
                      $('#nro_documento').focus();
                    }); 
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });

 
  
</script>