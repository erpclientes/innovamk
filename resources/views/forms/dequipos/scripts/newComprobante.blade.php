<script type="text/javascript">
  @foreach ($dequipos as $val)
      $(document).on('click','#newComprobante{{$val->idequipo}}', function(){
        $("#new_precio").val($(this).data('precio'));
        $("#new_idequipo").val($(this).data('idequipo'));
        $("#new_idservicio").val($(this).data('idservicio'));
        $("#new_descripcion").val($(this).data('descripcion'));

      });      
    @endforeach

    
    $(document).on('click','#addNewComp', function(){
	    guardarNewEquipoComp();
  	});   


    function guardarNewEquipoComp(){
        
      var data = $('#FormNewComprobante').serializeArray();
        
        $.ajax({
            url: "{{ url('/newComprobante') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/newComprobante') }}",
           data:data,

           success:function(data){
            console.log(data);
            $('#new_error1').text(""); 
            $('#new_error2').text(""); 
            $('#new_error3').text(""); 
            $('#new_error4').text(""); 
            if ( data[0] == "error") {
                ( typeof data.idcomprobante != "undefined" )? $('#new_error1').text("El campo comprobante es obligatorio.") : null;
                ( typeof data.fecha_emision != "undefined" )? $('#new_error2').text("El campo fecha emisión es obligatorio.") : null;
                ( typeof data.fecha_vencimiento != "undefined" )? $('#new_error3').text("El campo fecha vencimiento es obligatorio.") : null;
                ( typeof data.precio != "undefined" )? $('#new_error4').text("El campo precio es obligatorio.") : null;
            
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