<script type="text/javascript">
      //---JPaiva-28-09-2018----------------RECHAZAR-----------------------------
    $('#rechazar').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();

      $.ajax({
            url: "{{ url('/pago/rechazar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pago/rechazar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.observacion != "undefined" )? $('#error1').text(data.observacion) : null;
              } else {  
                var obj = $.parseJSON(data); 
                
                setTimeout(function() {
                  M.toast({ html: '<span>El estado se cambio a Pendiente de Pago</span>'});
                }, 2000); 
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>