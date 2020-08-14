<script type="text/javascript">
      //---JPaiva-22-07-2019----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();
      
      var data = $('#myForm').serializeArray();
      //data.push({name: 'tienn2t', value: 'love'});
      //var formData = new FormData();
      //formData.append('url_imagen', $('#avatarInput')[0].files[0]);
      
      $.ajax({
            url: "{{ url('/corte/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/corte/actualizar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.titulo != "undefined" )? $('#u_error1').text(data.titulo) : null;
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                
                setTimeout(function() {
                  M.toast({ html: '<span>Registro actualizado</span>'});
                }, 2000); 
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
        });

    

    });    

</script>