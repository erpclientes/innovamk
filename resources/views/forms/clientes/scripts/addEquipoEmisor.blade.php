 <script type="text/javascript">
   //------------JPaiva--25-06-2018------------------------------GRABAR EQUIPO----------------------------------------------------
    $("#addEquipoEmisor").click(function(e){
        e.preventDefault();
       // console.log('entooo'); 
        idRouter=parseInt($("input[name=contador]").val());  
        idRouter= idRouter+1;
        //console.log(idRouter);
                
        $.ajax({
            url: "{{ url('/equipos/grabarEmisor') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/equipos/grabarEmisor') }}",
           data:{
              idgrupo:$("select[name=idgrupo]").val(), 
              idmarca:$("select[name=idmarca]").val(), 
              idmodelo:$("select[name=idmodelo]").val(), 
              descripcionE:$("input[name=descripcionE]").val(),  
              idmodo:$("select[name=idmodo]").val(), 
              ip:$("input[name=ip]").val(),  
              usuario:$("input[name=usuario]").val(), 
              contrasena:$("input[name=contrasena]").val(), 
              zonas:$("select[name=zonas]").val()
           },

           success:function(data){
           // console.log(data[0]);
              $('#error1').text('');
                $('#error2').text('');
                $('#error3').text(''); 
                $('#error8').text('');             
              if ( data[0] == "error") {
                ( typeof data.idgrupo != "undefined" )? $('#error1').text(data.idgrupo) : null;
                ( typeof data.idmarca != "undefined" )? $('#error2').text(data.idmarca) : null;
                ( typeof data.idmodelo != "undefined" )? $('#error3').text(data.idmodelo) : null;
                ( typeof data.zonas != "undefined" )? $('#error8').text(data.zonas) : null;
              } else {    
                setTimeout(function() {
                  M.toast({ html: '<span>Registro exitoso</span>'});
                }, 2000); 


                var obj = $.parseJSON(data); 
                console.log(data); 
                console.log(idRouter);

               // [{"idequipo":57,"idestado":"SN","estado":"1","descripcion":"prueba","ip":"192.168.1.1","marca":"UBIQUITI","modelo":"ROCKET AC","modo":"EMISOR"}]      


                $("#tableEquipo").append(  
                  "<tr id='e'>"+ 
                    "<input type='hidden' name='idequipo"+idRouter+"' id='idequipo"+idRouter+"'value='"+obj[0]['idequipo']+"'>"+ 
                     "<td>"+
                      "<p class='center'>"+
                          "<label for='c"+obj[0]['idequipo']+"'>"+
                         "<input type='checkbox' class='filled-in' id='c"+obj[0]['idequipo']+"' name='check"+idRouter+"' tabindex='"+idRouter+"'>"+
                              "<span></span>"+
                            "</label>"+
                      "</p>"+
                     "</td>"+
                     "<td>"+ obj[0]['descripcion'] +"</td>"+
                     "<td>"+ obj[0]['marca'] +"</td>"+
                     "<td>"+ obj[0]['modelo'] +"</td>"+
                     "<td>"+ obj[0]['modo'] +"</td>"+ 

                     "<td><input id='precio"+idRouter+"' name='precio"+idRouter+"' type='number' class='right-align input_numerico'"+ "style='margin: 0; height: 2rem; width: 80%'></td>"+
                     "<td class='center'>"+
                      "<div class='chip center-align teal accent-4 white-text' style='width: 100%'>"+
                        "<b>ACTIVO</b>"+
                        "<i class='material-icons'></i>"+
                      "</div>"+
                      "</td>"+ 
                    "</tr>" 

                   
                  );
                  idRouter=idRouter+1;
                    //console.log("paso");
                    //var url = "{{ url('/equipos') }}"; 
                  // $(location).attr('href',url); 
                $('#modal2').modal('close');
              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>