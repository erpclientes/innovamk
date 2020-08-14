<script type="text/javascript">
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#getPPPoE', function(){
      cont = parseInt($('#cont').val());

      for (var i = 0; i <= cont; i++) {
        $("#importPPP" + i).remove();
      }
      usuariosPPPoE();
  });

  $(document).on('click','#ImportPPPoE', function(){
    //cont = parseInt($('#cont').val());
    
      var data = $('#myForm2').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarClientesPppoe') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarClientesPppoe') }}",
           data:data,

           success:function(data){

             setTimeout(function() {
                  M.toast({ html: '<span>Importación de clientes PPPoE exitoso</span>'});
                }, 2000); 

             //window.location="{{ url('/perfiles') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });    
  });  


  function usuariosPPPoE(){  
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
              idtipo:'PPP'
           },

           success:function(data){
            console.log(data);
            var valor = "";
            cont = parseInt($('#cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#importPPP" + i).remove();
            }
              
              $.each(data, function(i, item) {     
                
                color = ( item['disabled'] === "false" )? 'teal' : 'grey';
                estado = ( item['disabled'] === "false" )? 'ACTIVO' : 'INACTIVO';

                $("#tableImportPPPoE").append("<tr class='' id='importPPP"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.name+"'>"+
                  "<input type='hidden' name='password"+i+"' value='"+item['password']+"'>"+                  
                  "<input type='hidden' name='service"+i+"' value='"+item['service']+"'>"+                  
                  "<input type='hidden' name='profile"+i+"' value='"+item['profile']+"'>"+  
                  "<input type='hidden' name='disabled"+i+"' value='"+item['disabled']+"'>"+ 
                  "<input type='hidden' name='comment"+i+"' value='"+item['comment']+"'>"+    
                  "<input type='hidden' name='remote-address"+i+"' value='"+item['remote-address']+"'>"+                                      
                  "<input type='hidden' name='idperfil"+i+"' value='"+item['idperfil']+"'>"+                  
                  "<input type='hidden' name='profile"+i+"' value='"+item['perfil']+"'>"+                
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
                  "<td>"+ item['profile'] +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'value='"+item.precio+"'>"+
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

              $('#cont').val(cont);
              $('#id_router').val(val);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  };

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#ppp_i_allCheck', function(){  
    cont = parseInt($('#cont').val());
console.log(cont);
    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#ppp_i_clearCheck', function(){  
    cont = parseInt($('#cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", false );
    }
  });    

  //---------------------------LIMPIAR DATOS---------------------
  $('#iPPPoE2').click(function(e){
    cont = parseInt($('#cont').val());

    $('#ppp_i_idrouter').val('0');

    for (var i = 0; i <= cont; i++) {
      $("#importPPP" + i).remove();
    }
  });

  //-------------------CARGAR TIPO SERVICIO SEGUN ROUTER-----------------
  $('#idrouter').change(function(e){
      val = $('select[name=idrouter]').val();
      //console.log(val);
      $.ajax({
            url: "{{ url('/get-TipoAcceso') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getTipoAcceso') }}",
           data:{
              idrouter:val
           },

           success:function(data){
            //console.log(data);
              $('#idtipo').empty();  
              $('#idtipo').removeAttr('disabled');

              $('#idtipo').append("<option value='0' disabled selected>Importar desde</option>"); 

              $.each(data, function(i, item) {
                  $('#idtipo').append("<option value='"+item.dsc_corta+"'>"+item.descripcion+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });


    });

</script>
