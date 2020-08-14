<script type="text/javascript">
  //----JPaiva--08-03-2019---------------------------------VALIDAR LICENCIA-----------------------------------------------
  $(document).on('click','#add', function(){
  
    var data = $('#myForm').serializeArray();

          $.ajax({
              url: "{{ env('APP_LIC').'/licencia/validar' }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ env('APP_LIC').'/licencia/validar' }}",
             data:data,

             success:function(data){    
             
              if ( data[0] == "error") {
                ( typeof data.empresa != "undefined" )? $('#error1').text(data.empresa) : null;
                ( typeof data.ip_server != "undefined" )? $('#error2').text(data.ip_server) : null;
                ( typeof data.codigo != "undefined" )? $('#error3').text(data.codigo) : null;
                
              }else if (data == 'NO_LICENCIA'){
                setTimeout(function() {
                  Materialize.toast('<span>La licencia ingresada es Inválida!</span>', 1500);
                }, 100);  

              }else if (data == 'LICENCIA_ASIGNADA'){
                setTimeout(function() {
                  Materialize.toast('<span>La licencia ingresada ya está asignada!</span>', 1500);
                }, 100);  

              }else  {  
                
                $('#idcliente').val(data.idcliente);
                $('#fecha_inicio').val(data.fecha_inicio);
                $('#fecha_fin').val(data.fecha_fin);   
                $('#idlicencia').val(data.idlicencia);   
                $('#meses').val(data.meses);          
                
                setLicencia();
              }
                   
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });

  function setLicencia(){ 
    var data = $('#myForm').serializeArray();

          $.ajax({
              url: "{{ url('/setLicencia') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/setLicencia') }}",
             data:data,

             success:function(data){    
                     
              if(data == 'CORRECTO'){  
                                
                setTimeout(function() {
                  M.toast({ html: '<span>La licencia registrada</span>'});
                }, 2000);  

                setTimeout("location.href='{{url('/')}}'", 2000);
                
              }
                   
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  };
</script>