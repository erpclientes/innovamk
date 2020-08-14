<script type="text/javascript">
  //----JPaiva-23-07-2019------------------------------------HABILITAR NOTIFICACION--------------------------------------------
    @foreach ($servicio as $val)
        $('#ha_notificacion{{$val->idservicio}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idservicio');

          $.ajax({
                url: "{{ url('/notificacion/activar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/notificacion/activar') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Aviso en pantalla activado</span>'});
                }, 2000); 

                setTimeout("redireccionarPagina()",4000);
              }
                

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach

    function redireccionarPagina() {
      window.location = "{{ url('/cliente') }}/{{$idcliente}}";
    }

   
</script>