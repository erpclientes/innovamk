<script type="text/javascript">
    //---JPaiva-26-07-2018----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();
      
      
        var data = $('#myForm').serializeArray();
        console.log(data);
        $.ajax({
            url: "{{ url('/parametros/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/parametros/actualizar') }}",
           data:data,

           success:function(data){
              console.log('entro');

           },
           error:function(){ 
              alert("error!!!!");
        }
        });
  
    

      setTimeout(function() {
        M.toast({ html: '<span>Registro actualizado</span>'});
      }, 2000);  

    });

    //---JPaiva-04-06-2019----------------ACTUALIZAR-----------------------------
    $('#updCliente').click(function(e){
      e.preventDefault();
      
      
        var data = $('#myForm').serializeArray();
        console.log(data);
        $.ajax({
            url: "{{ url('/parametros/updCliente') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/parametros/updCliente') }}",
           data:data,

           success:function(data){

           },
           error:function(){ 
              alert("error!!!!");
        }
        });
  
    

      setTimeout(function() {
        M.toast({ html: '<span>Registro actualizado</span>'});
      }, 2000);  

    });

    //---JPaiva-04-06-2019----------------ACTUALIZAR-----------------------------
    $('#updFacturacion').click(function(e){
      e.preventDefault();
      
      
        var data = $('#myForm').serializeArray();
        console.log(data);
        $.ajax({
            url: "{{ url('/parametros/updFacturacion') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/parametros/updFacturacion') }}",
           data:data,

           success:function(data){
              console.log('entro');

           },
           error:function(){ 
              alert("error!!!!");
        }
        });
  
    

      setTimeout(function() {
        M.toast({ html: '<span>Registro actualizado</span>'});
      }, 2000);  

    });


</script>