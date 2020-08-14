<script type="text/javascript">
   //---------JPaiva--13-08-2019---------------GENERAR FICHAS-----------------------------------
    $("#addFichas").click(function(e){
        e.preventDefault();

        var data = $('#frmFichas').serializeArray();

        $.ajax({
            url: "{{ url('/fichas/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/fichas/grabar') }}",
           data:data,
           
           success:function(data){

              $('#pcq_error1').text('');
              
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