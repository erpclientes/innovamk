<script type="text/javascript">
  @foreach ($dequipos as $val)
      $(document).on('click','#addComprobante{{$val->idequipo}}', function(){
        $("#comp_precio").val($(this).data('precio'));
        $("#comp_idequipo").val($(this).data('idequipo'));
        $("#comp_idservicio").val($(this).data('idservicio'));

      });      
    @endforeach

    
    $(document).on('click','#addEquipoComp', function(){
	    guardarEquipoComp();
  	});   


    function guardarEquipoComp(){
        
      var data = $('#FormAddComprobante').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarEquipoComprobante') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarEquipoComprobante') }}",
           data:data,

           success:function(data){
            console.log(data);
            $('#comp_error1').text(""); 
            $('#comp_error2').text(""); 
            if ( data[0] == "error") {
                ( typeof data.idcomprobante != "undefined" )? $('#comp_error1').text("El campo comprobante es obligatorio.") : null;
                ( typeof data.precio != "undefined" )? $('#comp_error2').text("El campo precio es obligatorio.") : null;
            
            }else if(data.valor == "CONFORME"){
              setTimeout(function() {
                M.toast({ html: '<span>Registro exitoso.</span>'});
              }, 2000); 

              window.location="{{ url('/cliente') }}/{{$idcliente}}";  
            }            

           },
           error:function(){ 
              alert("error!!!!");
        }

        });

  	};

</script>