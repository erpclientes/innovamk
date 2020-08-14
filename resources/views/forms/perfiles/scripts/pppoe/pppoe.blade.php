<script type="text/javascript">
	 //-------------------------------------------------------PERFIL PPPoE-------------------------------------------------------------
    var datos;
     $('#p_idrouter').change(function(e){
      var val = $("select[name=p_idrouter]").val();

      $("#p_perfil option[value=0]").attr("selected", true);
      $("#p_perfil option[value=cero]").attr("selected",true);

      if ( val != '0') {
        $('#p_perfil').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/perfil/pppoe') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/pppoe') }}",
           data:{
              idrouter:$("select[name=p_idrouter]").val()
           },

           success:function(data){
              datos = data;
              //var obj = $.parseJSON(data); 
              $('#p_perfil').empty();  
              $('#p_perfil').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#p_perfil').append("<option value='n'>Elija un perfil</option>");
              $('#p_perfil').append("<option value='0'>Crear perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#p_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

     $('#p_agregar').click(function(e){
      $('#p_name').val('');
                $('#p_precio').val('');
                $('#p_vsubida').val('');
                $('#p_vbajada').val('');
                $('#p_idrouter option[value=e]').attr('selected',true);
                $('#p_perfil option[value=sn]').attr('selected',true);
                $('#p_dsc_perfil').val('');

    $('#p_error1').text('');
                $('#p_error2').text('');
                $('#p_error3').text('');
                $('#p_error6').text('');
                $('#p_error7').text('');
                $('#p_error4').text('');
     });

    


    $('#p_perfil').change(function(e){
      var val = $("select[name=p_perfil]").val();
      

      if (val == '0') {
        $('#p_remote_address').removeAttr('disabled'); 
        $('#p_remote_address').val(''); 
        $('#p_local_address').removeAttr('disabled'); 
        $('#p_local_address').val(''); 
        $('#p_dsc_perfil').removeAttr('disabled'); 
        $('#p_dsc_perfil').val(''); 
        $('#p_name').attr('disabled'); 
        $('#p_vsubida').attr('disabled'); 
        $('#p_vbajada').attr('disabled'); 
        $('#p_name').val(''); 
        $('#p_vsubida').val(''); 
        $('#p_vbajada').val(''); 

        $.ajax({
            url: "{{ url('/ip/pool') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/ip/pool') }}",
           data:{
              idrouter:$("select[name=p_idrouter]").val()
           },

           success:function(data){              
              //var obj = $.parseJSON(data); 
              $('#p_remote_address').empty();  
              $('#p_remote_address').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#p_remote_address').append("<option value='0'>Elija un perfil</option>");

              $.each(data, function(i, item) {
                  $('#p_remote_address').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
      }else{
        $('#p_remote_address').empty();  
        $('#p_remote_address').attr('disabled',true); 
        $('#p_local_address').attr('disabled',true); 
        $('#p_dsc_perfil').attr('disabled',true); 
      }
       
    });

    $('#p_perfil').change(function(e){
      
      var val = $("select[name=p_perfil]").val();
      var rate, local_ip, remote_ip, name;

      $.each(datos, function(i, item) {
        console.log(item.name);
          if(item.name == val){
              name = item.name;
              rate = item['rate-limit'];
              local_ip = item['local-address'];
              remote_ip = item['remote-address'];
          }
      });


      if (val == '0') {        
        $('#p_dsc_perfil').removeAttr('disabled'); 
        @foreach($parametros as $val)
          if ('{{$val->parametro}}' == 'LOCAL_ADDR') {
            $('#p_local_address').val('{{$val->valor_long}}');  
          }          
        @endforeach
        
      }else{
        $('#p_dsc_perfil').attr('disabled',true); 
        $('#p_dsc_perfil').val(val); 
        $('#p_name').attr('disabled',true); 
        $('#p_name').val(name); 
        $('#p_local_address').attr('disabled',true); 
        $('#p_local_address').val(local_ip); 
        $('#p_vsubida').attr('disabled',true); 
        $('#p_vsubida').val(rate.substr(0,rate.indexOf('/')));
        $('#p_vbajada').attr('disabled',true); 
        $('#p_vbajada').val(rate.substr(rate.indexOf('/')+1,rate.length));
        $('#p_remote_address').append("<option value='"+remote_ip+"'>"+remote_ip+"</option>");
      }

       
    });

    $('#pu_perfil').change(function(e){
      
      var val = $("select[name=pu_perfil]").val();

      if (val == '0') {
        $('#pu_dsc_perfil').removeAttr('disabled'); 
        $('#pu_dsc_perfil').val(''); 
      }else{
        $('#pu_dsc_perfil').attr('disabled',true); 
        $('#pu_dsc_perfil').val(val); 
        
      }

       
    });

</script>