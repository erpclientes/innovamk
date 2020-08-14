<script type="text/javascript">
      //---JPaiva-28-08-2019----------------ACTUALIZAR-----------------------------
    $('#updPool').click(function(e){
      e.preventDefault();

      var data = $('#frmUpdPool').serializeArray();

      $.ajax({
            url: "{{ url('/pool/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pool/actualizar') }}",
           data:data,

        success:function(data){    
                        
              if ( data[0] == "error") {
                ( typeof data.u_pcq_idrouter != "undefined" )? $('#u_error1').text(data.u_pcq_idrouter) : null;
                ( typeof data.u_pcq_name != "undefined" )? $('#u_pcq_error2').text(data.u_pcq_name) : null;
                ( typeof data.u_pcq_precio != "undefined" )? $('#u_pcq_error3').text(data.u_pcq_precio) : null;
                
              } else {   
                setTimeout(function() {
                  M.toast({html: '<span>Registro actualizado</span>'});
                }, 2000); 

                setTimeout("redireccionarPagina()",4000); 
              }          
          
        },
        error:function(){ 
              alert("error!!!!");
        }
      });

    });  

    function redireccionarPagina() {
      window.location = "{{ url('/pool') }}";
    }  
    

    @foreach ($pool as $val)
      $(document).on('click','#updPool{{$val->codigo}}', function(){
        $("#u_codigo").val($(this).data('codigo'));
        $("#u_descripcion").val($(this).data('descripcion'));
        $("#u_ip_inicial").val($(this).data('ip_inicial'));
        $("#u_ip_final").val($(this).data('ip_final'));        
        $("#u_glosa").val($(this).data('glosa'));

        var idrouter = $(this).data('idrouter');

        $("#u_idrouter option[value="+idrouter+"]").attr("selected",true);        
       
      });      
    @endforeach


</script>