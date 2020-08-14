<script type="text/javascript">
      //---JPaiva-05-10-2018----------------ACEPTAR-----------------------------
    $('#aceptar').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();

      $.ajax({
            url: "{{ url('/pago/aceptar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pago/aceptar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.observacion != "undefined" )? $('#error1').text(data.observacion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Registro de pago aceptado</span>'});
                }, 2000); 
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>
