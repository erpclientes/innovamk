<script type="text/javascript">
//----------------------vARIOS DATATABLE--------------------
  
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  var val = null;

  

  $(document).on('click','#verEquipos', function(){
  @if(count($servicio) == 0)
      setTimeout(function() {
        M.toast({ html: '<span>No existe registro de servicio</span>'});
      }, 2000); 
    @else
        $('#vwEquipo').modal('open');     
    @endif
  });    
  
  $(document).on('click','#addEquipo', function(){
    guardarEquipo();
  });   

  function guardarEquipo(){
    cont = parseInt($('#cont').val());
    idservicio = $("select[name=s_idservicio]").val();
    idaccion = $("select[name=s_idaccion]").val();

    $("#idservicio").val(idservicio);
    $("#idaccion").val(idaccion);
    
      var data = $('#FormEquipo').serializeArray();
      console.log(data);
        
        $.ajax({
            url: "{{ url('/guardarDEquipo') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarDEquipo') }}",
           data:data,

           success:function(data){
            console.log(data);
            $('#de_error1').text(""); 
            $('#de_error2').text(""); 
            if ( data[0] == "error") {
                ( typeof data.idservicio != "undefined" )? $('#de_error1').text("El campo servicio es obligatorio.") : null;
                ( typeof data.idaccion != "undefined" )? $('#de_error2').text("El campo agregar comprobante es obligatorio.") : null;                
            }else if(data.valor == "SIN_SELECCION"){
              setTimeout(function() {
                M.toast({ html: '<span>Seleccione un item.</span>'});
              },2000); 
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
