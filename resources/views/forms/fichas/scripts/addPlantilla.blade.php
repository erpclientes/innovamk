<script type="text/javascript">
   //---------JPaiva--20-08-2019---------------AGREGAR PLANTILLA-----------------------------------
    $("#addPlantilla").click(function(e){
        e.preventDefault();

        var data = $('#myForm').serializeArray();

        $.ajax({
            url: "{{ url('/fichas/plantillas/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/fichas/plantillas/grabar') }}",
           data:data,
           
           success:function(data){

              $('#error').text('');
              
              if ( data[0] == "error") {
                ( typeof data.pcq_idrouter != "undefined" )? $('#pcq_error1').text(data.pcq_idrouter) : null;
                
              } else {   

               
                setTimeout(function() {
                  M.toast({ html: '<span>Generación de fichas exitosa.</span>'});
                }, 2000); 

                //window.location="{{ url('/fichas') }}";
              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>