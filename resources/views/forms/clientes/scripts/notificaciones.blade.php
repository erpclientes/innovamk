<script type="text/javascript">
  //----JPaiva-26-09-2019------------------------------------GESTION DE NOTIFICACIONES--------------------------------------------
    @foreach ($notificaciones as $val)
        $('#corte{{$val->idservicio}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idservicio');

          if (id == '{{$val->idservicio}}') {
          $.ajax({
                url: "{{ url('/cliente/setCorte') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/cliente/setCorte') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                //var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Corte exitoso.</span>'});
                }, 2000); 

                setTimeout(location.reload(),4000);
              }

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
          }
        });    

        $('#aviso{{$val->idservicio}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idservicio');

          if (id == '{{$val->idservicio}}') {
          $.ajax({
                url: "{{ url('/cliente/setAviso') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/cliente/setAviso') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                //var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Aviso exitoso.</span>'});
                }, 2000); 

                setTimeout(location.reload(),4000);
                //location.reload();
              }

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
          }
        });    

        $('#restablecer{{$val->idservicio}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idservicio');

          if (id == '{{$val->idservicio}}') {
          $.ajax({
                url: "{{ url('/cliente/restablecer') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/cliente/restablecer') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                //var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Aviso exitoso.</span>'});
                }, 2000); 

                setTimeout(location.reload(),4000);
                //location.reload();
              }

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
          }
        });    
          
          
    @endforeach
  
   
</script>