<script type="text/javascript">
//---JPaiva-26-03-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#getPCQ', function(){
      cont = parseInt($('#pcq_cont').val());

      for (var i = 0; i <= cont; i++) {
        $("#importPCQ" + i).remove();
      }
      usuariosPCQ();
  });

  $(document).on('click','#ImportPCQ', function(){
    //cont = parseInt($('#pcq_cont').val());
    
      var data = $('#formPCQ').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarClientesPCQ') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarClientesPCQ') }}",
           data:data,

           success:function(data){

             setTimeout(function() {
                  M.toast({ html: '<span>Importación de clientes PCQ exitoso</span>'});
                }, 2000); 

             //window.location="{{ url('/perfiles') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });    
  });  


  function usuariosPCQ(){  
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
              idtipo:'PCQ'
           },

           success:function(data){
            console.log(data);
            var valor = "";
            cont = parseInt($('#pcq_cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#importPCQ" + i).remove();
            }
              
              $.each(data, function(i, item) {     
                
                color = ( item['disabled'] === "false" )? 'teal' : 'grey';
                estado = ( item['disabled'] === "false" )? 'ACTIVO' : 'INACTIVO';

                $("#tableImportPCQ").append("<tr class='' id='importPCQ"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.list+"'>"+
                  "<input type='hidden' name='address"+i+"' value='"+item['address']+"'>"+                  
                  "<input type='hidden' name='idperfil"+i+"' value='"+item['idperfil']+"'>"+                  
                  "<input type='hidden' name='profile"+i+"' value='"+item['perfil']+"'>"+  
                  "<input type='hidden' name='disabled"+i+"' value='"+item['disabled']+"'>"+ 
                  "<input type='hidden' name='comment"+i+"' value='"+item['comment']+"'>"+                  
                  "<td><p class='center'>"+
                    "<label for='check"+i+"'>"+
                    "<input type='checkbox' class='filled-in' id='check"+i+"' name='check"+i+"'>"+
                    "<span></span>"+
                    "</label>"+
                  "</p>"+
                  "</td>"+                                             
                  "<td>"+ item.list +"</td>"+
                  "<td>"+ item.comment +"</td>"+
                  "<td>"+ item['address'] +"</td>"+
                  "<td>"+ item['perfil'] +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%' value='"+item.precio+"'>"+
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

              $('#pcq_cont').val(cont);
              $('#pcq_idrouter').val(val);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  };

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#pcq_i_allCheck', function(){  
    cont = parseInt($('#pcq_cont').val());
console.log(cont);
    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#pcq_i_clearCheck', function(){  
    cont = parseInt($('#pcq_cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", false );
    }
  });    

  //---------------------------LIMPIAR DATOS---------------------
  $('#iPCQ2').click(function(e){
    cont = parseInt($('#pcq_cont').val());

    $('#PCQ_i_idrouter').val('0');

    for (var i = 0; i <= cont; i++) {
      $("#importPCQ" + i).remove();
    }
  });

  
</script>
