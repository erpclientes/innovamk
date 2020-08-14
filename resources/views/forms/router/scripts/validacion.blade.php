<script type="text/javascript">
  //---------JPaiva--28-12-2018---------VALIDAR INPUT-----------------------------------
        
  $('#idrouter').mask('AAA');
  $('#alias').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#ip').mask('099.099.099.099');
  $('#usuario').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#password').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#puerto').mask('09999');

  var focus = 0;

  $("#idrouter").focusout(function() {
    focus++;
    console.log(focus);

    var data = $(this).val();

          $.ajax({
              url: "{{ url('/router/verificarID') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/router/verificarID') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#idrouter').val('');
                  $('#idrouter').focus();

                  setTimeout(function() {
                    M.toast({ html: '<span>El código del Router ingresado ya existe. Ingrese un código distinto.</span>'});
                  }, 2000); 
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
  
</script>