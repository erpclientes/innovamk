<script type="text/javascript">
//---JPaiva-26-03-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#getHST', function(){
      cont = parseInt($('#hst_cont').val());

      for (var i = 0; i <= cont; i++) {
        $("#importHST" + i).remove();
      }
      usuariosHotspot();
  });

  $(document).on('click','#ImportHST', function(){
    //cont = parseInt($('#hst_cont').val());
    
      var data = $('#formHotspot').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarClientesHotspot') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarClientesHotspot') }}",
           data:data,

           success:function(data){

             setTimeout(function() {
                  M.toast({ html: '<span>Importación de clientes Hotspot exitoso</span>'});
                }, 2000); 

             //window.location="{{ url('/perfiles') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });    
  });  


  function usuariosHotspot(){  
      val = $("select[name=idrouter]").val();
  
        $.ajax({
            url: "{{ url('/showUsuarios') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/showUsuarios') }}",
           data:{
              idrouter:val,
              idtipo:'HST'
           },

           success:function(data){
            
            var valor = "";
            cont = parseInt($('#hst_cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#importHST" + i).remove();
            }
              
              $.each(data, function(i, item) {     
                
                color = ( item['disabled'] === "false" )? 'teal' : 'grey';
                estado = ( item['disabled'] === "false" )? 'ACTIVO' : 'INACTIVO';

                $("#tableImportHST").append("<tr class='' id='importHST"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.name+"'>"+
                  "<input type='hidden' name='password"+i+"' value='"+item['password']+"'>"+                  
                  "<input type='hidden' name='profile"+i+"' value='"+item['profile']+"'>"+
                  "<input type='hidden' name='idperfil"+i+"' value='"+item['idperfil']+"'>"+  
                  "<input type='hidden' name='disabled"+i+"' value='"+item['disabled']+"'>"+ 
                  "<input type='hidden' name='comment"+i+"' value='"+item['comment']+"'>"+                  
                  "<td><p class='center'>"+
                    "<label for='check"+i+"'>"+
                    "<input type='checkbox' class='filled-in' id='check"+i+"' name='check"+i+"'>"+
                    "<span></span>"+
                    "</label>"+
                  "</p>"+
                  "</td>"+                                             
                  "<td>"+ item.comment +"</td>"+
                  "<td>"+ item['name'] +"</td>"+
                  "<td>"+ item['password'] +"</td>"+
                  "<td>"+ item['perfil'] +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' value='"+item.precio+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'>"+
                  "</td>"+
                  "<td class='center'>"+
                      "<div id='i_estado' class='chip center-align "+ color +" accent-4 white-text' style='width: 100%'>"+
                        "<b>"+estado+"</b>"+
                        "<i class='material-icons'></i>"+
                      "</div>"+
                  "</td>"+ 
                 // "</form>"+                 
                "</tr>");

                cont = i;
              });

              $('#hst_cont').val(cont);
              $('#hst_id_router').val(val);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  };

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#hst_i_allCheck', function(){  
    cont = parseInt($('#hst_cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#hst_i_clearCheck', function(){  
    cont = parseInt($('#hst_cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", false );
    }
  });    

  //---------------------------LIMPIAR DATOS---------------------
  $('#iHST2').click(function(e){
    cont = parseInt($('#hst_cont').val());

    $('#hst_i_idrouter').val('0');

    for (var i = 0; i <= cont; i++) {
      $("#importHST" + i).remove();
    }
  });

</script>
