<script type="text/javascript">
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#importPPPoE', function(){
    //cont = parseInt($('#cont').val());
    
      var data = $('#formImportPPPoE').serializeArray();
        
        $.ajax({
            url: "{{ url('/guardarImportPppoe') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarImportPppoe') }}",
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

  $('#ppp_i_idrouter').change(function(e){
      val = $("select[name=ppp_i_idrouter]").val();
  
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
              idtipo:'PPP'
           },

           success:function(data){
            
            var valor = "";
            cont = parseInt($('#ppp_cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#importPPP" + i).remove();
            }
              
              $.each(data, function(i, item) {     
                        
                $("#tableImportPPPoE").append("<tr class='' id='importPPP"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.name+"'>"+
                  "<input type='hidden' name='target"+i+"' value='"+item['rate-limit']+"'>"+                  
                  "<input type='hidden' name='remote_address"+i+"' value='"+item['remote-address']+"'>"+                  
                  "<input type='hidden' name='local_address"+i+"' value='"+item['local-address']+"'>"+                  
                  "<td><p class='center'>"+
                    "<label for='check"+i+"'>"+
                    "<input type='checkbox' class='filled-in' id='check"+i+"' name='check"+i+"'>"+
                    "<span></span>"+
                    "</label>"+
                  "</p>"+
                  "</td>"+                                             
                  "<td>"+ item.name +"</td>"+
                  "<td>"+ item['remote-address'] +"</td>"+
                  "<td>"+ item['local-address'] +"</td>"+
                  "<td>"+ item['rate-limit'] +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'>"+
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
              });

              $('#ppp_cont').val(cont);
              $('#ppp_id_router').val(val);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  });

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#ppp_i_allCheck', function(){  
    cont = parseInt($('#ppp_cont').val());
console.log(cont);
    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#ppp_i_clearCheck', function(){  
    cont = parseInt($('#ppp_cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", false );
    }
  });    

  //---------------------------LIMPIAR DATOS---------------------
  $('#iPPPoE2').click(function(e){
    cont = parseInt($('#ppp_cont').val());

    $('#ppp_i_idrouter').val('0');

    for (var i = 0; i <= cont; i++) {
      $("#importPPP" + i).remove();
    }
  });

</script>
