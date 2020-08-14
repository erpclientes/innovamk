<script type="text/javascript">
      //---JPaiva-06-02-2019----------------GUARDAR-----------------------------
    $('#add').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();

      $.ajax({
            url: "{{ url('/clientes/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/clientes/grabar') }}",
           data:data,

           success:function(data){
              console.log(data);
              if ( data[0] == "error") {
                ( typeof data.iddocumento != "undefined" )? $('#error1').text(data.iddocumento) : null;
                ( typeof data.nro_documento != "undefined" )? $('#error2').text(data.nro_documento) : null;
                ( typeof data.apaterno != "undefined" )? $('#error3').text(data.apaterno) : null;
                ( typeof data.amaterno != "undefined" )? $('#error4').text(data.amaterno) : null;
                ( typeof data.nombres != "undefined" )? $('#error5').text(data.nombres) : null;
                ( typeof data.direccion != "undefined" )? $('#error6').text(data.direccion) : null;
                ( typeof data.forma_pago != "undefined" )? $('#error7').text(data.forma_pago) : null;
                ( typeof data.doc_venta != "undefined" )? $('#error8').text(data.doc_venta) : null;
                ( typeof data.moneda != "undefined" )? $('#error9').text(data.moneda) : null;
                ( typeof data.idempresa != "undefined" )? $('#error10').text(data.idempresa) : null;
              } else {  
                //var obj = $.parseJSON(data);  
                window.location="{{ url('/clientes') }}";              
               
                // setTimeout("location.href='{{url('/clientes')}}'", 0000);
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>