<script type="text/javascript">
  //----JPaiva--03-03-2019---------------------------------GENERAR LICENCIA-----------------------------------------------
  $(document).on('click','#genLicencia', function(){
  
    $('#empresa').val($('#idempresa').val());
    $('#tipo').val($('#idtipo').val());
    
    var data = $('#myForm').serializeArray();

          $.ajax({
              url: "{{ url('/licencia/generador') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/licencia/generador') }}",
             data:data,

             success:function(data){              
                
                $('#codigo').val(data);
                $('#codigo2').val(data);
                   
             },

             error:function(){ 
                alert("error!!!!");
          }
          });        
  });
</script>