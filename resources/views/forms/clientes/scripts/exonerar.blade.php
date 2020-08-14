<script type="text/javascript">
  //----JPaiva-24-09-2019------------------------------------EXONERAR PAGO CLIENTE--------------------------------------------
    @foreach ($clientes as $val)
        $('#exonerar{{$val->idcliente}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idcliente');

          $.ajax({
                url: "{{ url('/cliente/exonerar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/cliente/exonerar') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>El cliente fue exonerado de pagos.</span>'});
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
      window.location = "{{ url('/clientes') }}";
    }

   
</script>