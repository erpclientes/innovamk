<script type="text/javascript">
//---JPaiva-22-03-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#importPCQ', function(){
        
      var data = $('#formImportPCQ').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarImportPCQ') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarImportPCQ') }}",
           data:data,

           success:function(data){

             setTimeout(function() {
                  M.toast({ html: '<span>Importación de perfiles exitoso</span>'});
                }, 2000); 

             window.location="{{ url('/perfiles') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
    
  });      

  $('#ipcq_idrouter').change(function(e){
      val = $("select[name=ipcq_idrouter]").val();
  
        $.ajax({
            url: "{{ url('/importPerfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/importPerfil') }}",
           data:{
              idrouter:val,
              idtipo:'PCQ'
           },

           success:function(data){
            
            var valor = "";
            cont = parseInt($('#pcq_cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#importPCQ" + i).remove();
            }
              var rate = 0;
              
              $.each(data, function(i, item) {     
               if (item.kind == 'pcq') {   

                rate = item['pcq-rate'];

                if (rate >= 1000000000) {
                  rate = (rate/1000000000)+'G';
                }
                if (rate >= 1000) {
                  rate = rate/1000;
                }
                if (rate >= 1000) {
                  rate = rate/1000+'M';
                }else{
                  rate = rate+'k';
                }


                
                $("#tableImportPCQ").append("<tr class='' id='importPCQ"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.name+"'>"+
                  "<input type='hidden' name='pcq_rate"+i+"' value='"+rate+"'>"+                  
                  "<input type='hidden' name='parent"+i+"' value='"+item['parent']+"'>"+
                  "<input type='hidden' name='pcq_classifier"+i+"' value='"+item['pcq-classifier']+"'>"+             
                  "<input type='hidden' name='packet_mark"+i+"' value='"+item['packet_mark']+"'>"+             
                  "<input type='hidden' name='name_tree"+i+"' value='"+item['name_tree']+"'>"+             
                  "<input type='hidden' name='address_list"+i+"' value='"+item['address_list']+"'>"+             
                  "<td><p class='center'>"+
                    "<label for='check"+i+"'>"+
                    "<input type='checkbox' class='filled-in' id='check"+i+"' name='check"+i+"'>"+
                    "<span></span>"+
                    "</label>"+
                  "</p>"+
                  "</td>"+      
                  "<td class='center'>"+ 
                    "<input id='plan"+i+"' name='plan"+i+"' type='text' class='input_numerico' style='margin: 0; height: 2rem; width: 90%'>"+
                  "</td>"+                                  
                  "<td>"+ item.name +"</td>"+
                  "<td class='center'>"+ rate +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'>"+
                  "</td>"+
                  "<td class='center'>"+ 
                    "<input id='grupo"+i+"' name='grupo"+i+"' type='text' class='center-align input_numerico' style='margin: 0; height: 2rem; width: 60%'>"+
                  "</td>"+
                  "<td class='center'>"+
                      "<div id='i_estado' class='chip center-align teal accent-4 white-text' style='width: 100%'>"+
                        "<b>ACTIVO</b>"+
                        "<i class='material-icons'></i>"+
                      "</div>"+
                  "</td>"+ 
                 // "</form>"+                 
                "</tr>");

                cont = i;

               }
              });

              $('#pcq_cont').val(cont);
              $('#pcq_id_router').val(val);

              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  });

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#i_pcq_allCheck', function(){  
    cont = parseInt($('#pcq_cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#i_pcq_clearCheck', function(){  
    cont = parseInt($('#pcq_cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", false );
    }
  });    

  //---------------------------LIMPIAR DATOS---------------------
  $('#iPcq2').click(function(e){
    cont = parseInt($('#pcq_cont').val());

    $('#ipcq_idrouter').val('0');
    
    for (var i = 0; i <= cont; i++) {
      $("#importPCQ" + i).remove();
    }
  });

</script>
