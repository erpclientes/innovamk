<script type="text/javascript">
  //----JPaiva-11-04-2019------------------------------------HABILITAR--------------------------------------------
    @foreach ($servicio as $val)
        $('#ha_servicio{{$val->idservicio}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idservicio');

          $.ajax({
                url: "{{ url('/servicio/habilitar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/servicio/habilitar') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Servicio habilitado</span>'});
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