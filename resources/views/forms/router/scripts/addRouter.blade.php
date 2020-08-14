<script type="text/javascript">
      //---JPaiva-28-12-2018----------------GUARDAR-----------------------------
    $('#add').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();
      //console.log(data);

      $.ajax({
            url: "{{ url('/router/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/router/grabar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.alias != "undefined" )? $('#error2').text(data.alias) : null;
                ( typeof data.ip != "undefined" )? $('#error3').text(data.ip) : null;
                ( typeof data.usuario != "undefined" )? $('#error4').text(data.usuario) : null;
                ( typeof data.password != "undefined" )? $('#error5').text(data.password) : null;
              } else {  
                //var obj = $.parseJSON(data);                
                setTimeout("location.href='{{url('/router')}}'", 0000);
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>