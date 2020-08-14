<script type="text/javascript">
  //----JPaiva-10-04-2019------------------------------------DESABILITAR--------------------------------------------
    @foreach ($servicio as $val)
        $('#dservicio{{$val->idservicio}}').click(function(e){
          e.preventDefault();

          id = $(this).data('iddesabilitar');

          $.ajax({
                url: "{{ url('/servicio/desabilitar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/servicio/desabilitar') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Servicio desabilidado</span>'});
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