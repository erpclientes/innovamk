<script type="text/javascript">
  //----JPaiva-12-04-2019------------------DESABILITAR---------------------------
    @foreach ($pcq as $val)
        $('#h_pcq{{$val->idperfil}}').click(function(e){
          e.preventDefault();

          id = $(this).data('iddesabilitar');

          $.ajax({
                url: "{{ url('/perfil/habilitar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/perfil/habilitar') }}",
               data:{
                  idperfil:id
               },

               success: function(data){

                
                setTimeout(function() {
                  M.toast({ html: '<span>Registro desabilidado</span>'});
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
      window.location = "{{ url('/perfiles') }}";
    }
   
</script>