<script type="text/javascript">
  //---------JPaiva--03-01-2019---------REINICIAR ROUTER-----------------------------------
  $("#reiniciar").click(function() {
    
    var data = '';
    @foreach($router as $rou)
      data = '{{$rou->idrouter}}';
    @endforeach
    console.log(data);

          $.ajax({
              url: "{{ url('/router/reiniciar') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/router/reiniciar') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }else {

                  setTimeout(function() {
                    M.toast({ html: '<span>El Router se esta reiniciando</span>'});
                  }, 2000); 
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
</script>