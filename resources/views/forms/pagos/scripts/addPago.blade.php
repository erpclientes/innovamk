<script type="text/javascript">
    //------JPaiva--18-01-2019-------------GRABAR-----------------------------------
    $("#add").click(function(e){
        e.preventDefault();

        var data = $('#frmPago').serializeArray();

        $.ajax({
            url: "{{ url('/pagos/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pagos/grabar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.nro_documento != "undefined" )? $('#error1').text(data.nro_documento) : null;
                ( typeof data.nombre != "undefined" )? $('#error3').text(data.nombre) : null;
                ( typeof data.apellidos != "undefined" )? $('#error4').text(data.apellidos) : null;
                ( typeof data.usuario != "undefined" )? $('#error5').text(data.usuario) : null;
                ( typeof data.email != "undefined" )? $('#error6').text(data.email) : null;
                ( typeof data.password != "undefined" )? $('#error7').text(data.password) : null;
              } else {   

                //alert(data.success);
                //window.location="{{ url('/pagos') }}";
                location.reload();

              }
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });

    
</script>

