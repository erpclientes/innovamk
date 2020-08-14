<script type="text/javascript">
   //----------------------GRABAR HOTSPOT-----------------------------------
    $("#add_PCQ").click(function(e){
        e.preventDefault();

        var data = $('#formPCQ').serializeArray();

        $.ajax({
            url: "{{ url('/pcq/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pcq/grabar') }}",
           data:data,
           
           success:function(data){

              $('#pcq_error1').text('');
                $('#pcq_error2').text('');
                $('#pcq_error3').text('');
                $('#pcq_error4').text('');
                $('#pcq_error6').text('');
                $('#pcq_error6').text('');
                $('#pcq_error7').text('');
                $('#pcq_error8').text('');
                $('#pcq_error9').text('');
              
              if ( data[0] == "error") {
                ( typeof data.pcq_idrouter != "undefined" )? $('#pcq_error1').text(data.pcq_idrouter) : null;
                ( typeof data.pcq_name != "undefined" )? $('#pcq_error2').text(data.pcq_name) : null;
                ( typeof data.pcq_precio != "undefined" )? $('#pcq_error3').text(data.pcq_precio) : null;
                ( typeof data.pcq_vsubida != "undefined" )? $('#pcq_error4').text(data.pcq_vsubida) : null;
                ( typeof data.pcq_vbajada != "undefined" )? $('#pcq_error5').text(data.pcq_vbajada) : null;
                ( typeof data.pcq_parent1 != "undefined" )? $('#pcq_error6').text(data.pcq_parent1) : null;
                ( typeof data.pcq_parent2 != "undefined" )? $('#pcq_error7').text(data.pcq_parent2) : null;                
                ( typeof data.pcq_limite != "undefined" )? $('#pcq_error8').text(data.pcq_limite) : null;
                ( typeof data.pcq_prioridad != "undefined" )? $('#pcq_error9').text(data.pcq_prioridad) : null;
                
              } else {   

               
                setTimeout(function() {
                  M.toast({ html: '<span>Registro exitoso</span>'});
                }, 2000); 

                window.location="{{ url('/perfiles') }}";
              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>