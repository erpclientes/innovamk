<script type="text/javascript">
      //---JPaiva-26-03-2019----------------ACTUALIZAR-----------------------------
    $('#upd_PCQ').click(function(e){
      e.preventDefault();

      var data = $('#formPCQUpdate').serializeArray();

      $.ajax({
            url: "{{ url('/pcq/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/pcq/actualizar') }}",
           data:data,

        success:function(data){    
                        
              if ( data[0] == "error") {
                ( typeof data.u_pcq_idrouter != "undefined" )? $('#u_pcq_error1').text(data.u_pcq_idrouter) : null;
                ( typeof data.u_pcq_name != "undefined" )? $('#u_pcq_error2').text(data.u_pcq_name) : null;
                ( typeof data.u_pcq_precio != "undefined" )? $('#u_pcq_error3').text(data.u_pcq_precio) : null;
                ( typeof data.u_pcq_vsubida != "undefined" )? $('#u_pcq_error4').text(data.u_pcq_vsubida) : null;
                ( typeof data.u_pcq_vbajada != "undefined" )? $('#u_pcq_error5').text(data.u_pcq_vbajada) : null;
                ( typeof data.u_pcq_parent1 != "undefined" )? $('#u_pcq_error6').text(data.u_pcq_parent1) : null;
                ( typeof data.u_pcq_parent2 != "undefined" )? $('#u_pcq_error7').text(data.u_pcq_parent2) : null;                
                ( typeof data.u_pcq_limite != "undefined" )? $('#u_pcq_error8').text(data.u_pcq_limite) : null;
                ( typeof data.u_pcq_prioridad != "undefined" )? $('#u_pcq_error9').text(data.u_pcq_prioridad) : null;
                
              } else {   
                setTimeout(function() {
                  M.toast({html: '<span>Registro actualizado</span>'});
                }, 2000); 

                //setTimeout("redireccionarPagina()",4000); 
              }          
          
        },
        error:function(){ 
              alert("error!!!!");
        }
      });


    });  

    function redireccionarPagina() {
      window.location = "{{ url('/perfiles') }}";
    }  
    

    @foreach ($pcq as $val)
      $(document).on('click','#updPCQ{{$val->idperfil}}', function(){
        $("#u_pcq_idperfil").val($(this).data('id'));
        $("#u_pcq_name").val($(this).data('name'));
        $("#u_pcq_precio").val($(this).data('precio'));        
        $("#u_pcq_vbajada").val($(this).data('vbajada'));
        $("#u_pcq_vsubida").val($(this).data('vsubida'));
        $("#u_pcq_glosa").text($(this).data('glosa'));
        $("#u_pcq_idperfil").val($(this).data('id'));
        $("#u_pcq_limite").val($(this).data('limite_usu'));
        $("#u_pcq_prioridad").val($(this).data('prioridad'));

        var idrouter = $(this).data('idrouter');
        var parent1 = $(this).data('parent1');
        var parent2 = $(this).data('parent2');
        var perfil = $(this).data('perfil');
        var dsc = $(this).data('dsc_perfil');

        $("#u_pcq_idrouter option[value="+idrouter+"]").attr("selected",true);        

        if($(this).data('estado') == 1){
          $('#u_pcq_estado').hide();
          $('#u_pcq_estado2').show();
        }else{
          $('#u_pcq_estado2').hide();
          $('#u_pcq_estado').show();
        }

        getParent(idrouter,parent1,parent2);

       
      });      
    @endforeach



     $('#u_pcq_idrouter').change(function(e){
      var val = $("select[name=u_pcq_idrouter]").val();

      if ( val != '0') {
        $('#u_pcq_perfil').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/hotspot/perfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/hotspot/perfil') }}",
           data:{
              idrouter:$("select[name=u_pcq_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#u_pcq_perfil').empty();  
              $('#u_pcq_perfil').removeAttr('disabled');
              $('#u_pcq_dsc_perfil').removeAttr('disabled');  

              $('#u_pcq_perfil').append("<option value='n'>Elija un perfil</option>");
              $('#u_pcq_perfil').append("<option value='0'>Crear perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#u_pcq_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });


</script>