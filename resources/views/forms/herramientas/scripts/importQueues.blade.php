<script type="text/javascript">
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#getQUEUES', function(){
      cont = parseInt($('#contQUEUES').val());

      for (var i = 0; i <= cont; i++) {
        $("#importQUEUES" + i).remove();
      }
      usuariosQUEUES();
  });

  $(document).on('click','#ImportQUEUES', function(){
    //cont = parseInt($('#cont').val());
    
      var data = $('#formQUEUES').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarClientesQUEUES') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarClientesQUEUES') }}",
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


  function usuariosQUEUES(){  
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
              idtipo:'QUE'
           },

           success:function(data){
            console.log(data);
            var valor = "";
            cont = parseInt($('#contQUEUES').val());

            for (var i = 0; i <= cont; i++) {
              $("#importQUEUES" + i).remove();
            }
              
              $.each(data, function(i, item) {     
                
                color = ( item['disabled'] === "false" )? 'teal' : 'grey';
                estado = ( item['disabled'] === "false" )? 'ACTIVO' : 'INACTIVO';

                $("#tableImportQUEUES").append("<tr class='' id='importQUEUES"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.name+"'>"+
                  "<input type='hidden' name='target"+i+"' value='"+item.target+"'>"+
                  "<input type='hidden' name='max-limit"+i+"' value='"+item['max-limit']+"'>"+
                  "<input type='hidden' name='disabled"+i+"' value='"+item['disabled']+"'>"+                    
                  "<td><p class='center'>"+
                    "<label for='QUEUES_check"+i+"'>"+
                    "<input type='checkbox' class='filled-in' id='QUEUES_check"+i+"' name='check"+i+"'>"+
                    "<span></span>"+
                    "</label>"+
                  "</p>"+
                  "</td>"+                                                                 
                  "<td>"+ item['name'] +"</td>"+
                  "<td>"+ item['target'] +"</td>"+
                  "<td>"+ item['max-limit'] +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'>"+
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

              $('#contQUEUES').val(cont);
              $('#q_id_router').val(val);

              console.log(cont);
              console.log($('#contQUEUES').val());
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  };

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#QUEUES_allCheck', function(){  
    cont = parseInt($('#contQUEUES').val());
console.log('entro');
    for (var i = 0; i <= cont; i++) {
      $( "#QUEUES_check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#QUEUES_clearCheck', function(){  
    cont = parseInt($('#contQUEUES').val());

    for (var i = 0; i <= cont; i++) {
      $( "#QUEUES_check"+i ).prop( "checked", false );
    }
  });    

  

  
</script>
