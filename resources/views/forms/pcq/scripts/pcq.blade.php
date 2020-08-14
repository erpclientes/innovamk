<script type="text/javascript">
	 //-----------JPaiva--22-03-2019------------------------------------PCQ-------------------------------------------------------------
    var datos;
     $('#pcq_idrouter').change(function(e){
      var val = $("select[name=pcq_idrouter]").val();

      if ( val != '0') {
        $('#pcq_perfil').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/pcq/getParent') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pcq/getParent') }}",
           data:{
              idrouter:$("select[name=pcq_idrouter]").val()
           },

           success:function(data){
              datos = data;

              $('#pcq_parent1').empty();  
              $('#pcq_parent1').removeAttr('disabled');
              $('#pcq_parent2').empty();  
              $('#pcq_parent2').removeAttr('disabled');

              $('#pcq_parent1').append("<option value=''>Seleccionar</option>");   
              $('#pcq_parent1').append("<option value='global'>Global</option>");             
              $('#pcq_parent2').append("<option value=''>Seleccionar</option>");            
              $('#pcq_parent2').append("<option value='global'>Global</option>");              

              $.each(data, function(i, item) {
                  $('#pcq_parent1').append("<option value='"+item.name+"'>"+item.name+"</option>");
                  $('#pcq_parent2').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

              $("#pcq_parent1 option[value=n]").attr('disabled', true);
              $("#pcq_parent2 option[value=n]").attr('disabled', true);

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

    $('#pcq_agregar').click(function(e){
      $('#pcq_name').val('');
      $('#pcq_precio').val('');
      $('#pcq_vsubida').val('');
      $('#pcq_vbajada').val('');
      $('#pcq_limite').val('');
      $('#pcq_prioridad').val('');
      $("#pcq_idrouter option[value='']").attr("selected",true);
      $("#pcq_parent1 option[value='']").attr("selected",true);
      $("#pcq_parent2 option[value='']").attr("selected",true);

      $('#pcq_error1').text('');
      $('#pcq_error2').text('');
      $('#pcq_error3').text('');
      $('#pcq_error6').text('');
      $('#pcq_error7').text('');
      $('#pcq_error4').text('');
    });

    function getParent(idrouter,parent1,parent2){
      
        $.ajax({
            url: "{{ url('/pcq/getParent') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pcq/getParent') }}",
           data:{
              idrouter:idrouter
           },

           success:function(data){
              datos = data;

              $('#u_pcq_parent1').empty();  
              $('#u_pcq_parent1').removeAttr('disabled');
              $('#u_pcq_parent2').empty();  
              $('#u_pcq_parent2').removeAttr('disabled');

              $('#u_pcq_parent1').append("<option value=''>Seleccionar</option>");   
              $('#u_pcq_parent1').append("<option selected value='global'>Global</option>");             
              $('#u_pcq_parent2').append("<option value=''>Seleccionar</option>");            
              $('#u_pcq_parent2').append("<option selected value='global'>Global</option>");              

              $.each(data, function(i, item) {
                if (item.name == parent1) {
                  $('#u_pcq_parent1').append("<option selected value='"+item.name+"'>"+item.name+"</option>");
                }else{
                  $('#u_pcq_parent1').append("<option value='"+item.name+"'>"+item.name+"</option>");
                }
             console.log(parent2);
                if (item.name == parent2) {
                  $('#u_pcq_parent2').append("<option selected value='"+item.name+"'>"+item.name+"</option>");
                }else{
                  $('#u_pcq_parent2').append("<option value='"+item.name+"'>"+item.name+"</option>");
                } 
                  
              });

              $("#u_pcq_parent1 option[value=n]").attr('disabled', true);
              $("#u_pcq_parent2 option[value=n]").attr('disabled', true);

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
      
    }

    

</script>