<script type="text/javascript">
  //---------JPaiva--03-01-2019---------VALIDAR INPUT-----------------------------------
        
  //$('#nro_documento').mask('09999999999');
  $('#cargo').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  
  //$('#telefono').mask('09999999999999999999');
  $('#usuario').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  //$('#email').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
 


  //---------------------------------VALIDA ID QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#nro_documento").focusout(function() {

    var data = $(this).val();

    if (data.length > 0) {
      $.ajax({
              url: "{{ url('/usuario/verificarID') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/usuario/verificarID') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#nro_documento').val('');
                  $('#nro_documento').focus();

                  setTimeout(function() {
                    M.toast({ html: '<span>El Nro. de Documento ingresado ya existe. Ingrese un dato distinto.</span>'});
                  }, 2000); 
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
    }


          
        
  });
  

  //---------------------------------VALIDA ID USUARIO QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#usuario").focusout(function() {

    var data = $(this).val();

          $.ajax({
              url: "{{ url('/usuario/verificarUsuario') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/usuario/verificarUsuario') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#usuario').val('');
                  $('#usuario').focus();

                  setTimeout(function() {
                    M.toast({ html: '<span>El Usuario ingresado ya existe. Ingrese un usuario distinto.</span>'});
                  }, 2000); 
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
  
</script>