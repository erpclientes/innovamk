<script type="text/javascript">
   //---------JPaiva--13-08-2019---------------AGREGAR IP POOL-----------------------------------
    $("#addPool").click(function(e){
        e.preventDefault();

        var data = $('#frmAddPool').serializeArray();

        $.ajax({
            url: "{{ url('/pool/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pool/grabar') }}",
           data:data,
           
           success:function(data){

              $('#pcq_error1').text('');
              
              if ( data[0] == "error") {
                ( typeof data.pcq_idrouter != "undefined" )? $('#pcq_error1').text(data.pcq_idrouter) : null;
                
              } else {   

               
                setTimeout(function() {
                  M.toast({ html: '<span>Creación de Ip Pool exitosa.</span>'});
                }, 2000); 

                window.location="{{ url('/pool') }}";
              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>