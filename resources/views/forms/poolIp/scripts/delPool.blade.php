<script type="text/javascript">
  //----JPaiva-12-04-2019------------------ELIMINAR---------------------------
    @foreach ($pool as $val)
        $('#del{{$val->codigo}}').click(function(e){
          e.preventDefault();

          id = $(this).data('ideliminar');

          $.ajax({
                url: "{{ url('/pool/eliminar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/pool/eliminar') }}",
               data:{
                  codigo:id
               },

               success: function(data){

                
                setTimeout(function() {
                  M.toast({ html: '<span>Registro eliminado</span>'});
                }, 2000);  

                setTimeout("redireccionarPagina()",4000);

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach

    function redireccionarPagina() {
      window.location = "{{ url('/pool') }}";
    }
   
</script>