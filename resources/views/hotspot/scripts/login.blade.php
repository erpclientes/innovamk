<script type="text/javascript">
      //---JPaiva-11-12-2018----------------GUARDAR-----------------------------
    $('#login').click(function(e){
      e.preventDefault();

      var mac = {{ $mac }};
      console.log(mac);


      $.ajax({
            url: "{{ url('/login/comprobar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/login/comprobar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.ruc != "undefined" )? $('#error1').text(data.ruc) : null;
                ( typeof data.razon_social != "undefined" )? $('#error2').text(data.razon_social) : null;
                
              } else {  
                var obj = $.parseJSON(data); 

               
                setTimeout("location.href='{{url('/compra-finalizada')}}'", 0000);
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>