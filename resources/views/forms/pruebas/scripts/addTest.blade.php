<script type="text/javascript">
  //----JPaiva--03-03-2019---------------------------------GUARDAR LICENCIA-----------------------------------------------
  $(document).on('click','#add', function(){
  
    var data = $('#myForm').serializeArray();

          $.ajax({
              url: "{{ url('/test/grabar') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/test/grabar') }}",
             data:data,

             success:function(data){              
                if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.idtipo != "undefined" )? $('#error2').text(data.idtipo) : null;
                
              } else {  
                
                //setTimeout("location.href='{{url('/test/lista')}}'", 0000);
                
              }
                   
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
</script>