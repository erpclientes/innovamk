<script type="text/javascript">
  //---------JPaiva--23-08-2019---------VALIDAR INPUT-----------------------------------
        
  $('#ip_inicial').mask('099.099.099.099');
  $('#ip_final').mask('099.099.099.099');


  //---------------------------------VALIDA ID QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#nro_documento").focusout(function() {

    var data = $(this).val();

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
        
  });
  
  
</script>