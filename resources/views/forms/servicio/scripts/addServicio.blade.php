<script type="text/javascript">
  $(".datepicker").datepicker({
    autoclose: true,
    format: "dd/mm/yyyy"
  });

    $('#fecha_instalacion').formatter({
          'pattern': '@{{99}}/@{{99}}/@{{9999}}',
        });

    $('#dia_pago').formatter({
      'pattern' : '@{{99}}'
    });

 
    $('#ip').mask('099.099.099.099');
    $('#mac').mask('AA:AA:AA:AA:AA:AA');
    $('#ip_receptor').mask('099.099.099.099');
    //$('#usuario_cliente').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    $('#usuario_receptor').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    $('#precio').mask('###0.00', {reverse: true});

    $('#idtipo').change(function(e){
      var val = $('#idtipo').val();

      $("#idperfil option[value=0]").attr("selected", true);
      $("#idperfil option[value=cero]").attr("selected",true);

      if ( val != '0') {
        $('#idperfil').removeAttr("disabled");
      }else{
        $('#idperfil').attr("disabled");        
      };
      
    });

    $('#idperfil').change(function(e){
      val = $('#idperfil').val();
        

      @foreach($perfiles as $perfil)
        if (val == "{{$perfil->idperfil}}"){
          $('#precio').val('{{$perfil->precio}}');
        }
      @endforeach
    });

    $('#equipo_receptor').change(function(e){
      val = $('#equipo_receptor').val();

      @foreach($eqreceptor as $val)
        if (val == {{$val->idequipo}}){
          $('#usuario_receptor').val('{{$val->usuario}}');
          $('#contrasena_receptor').val('{{$val->contrasena}}');
          $('#ip_receptor').val('{{$val->ip}}');
        }
      @endforeach
    });


    //----------------------AGREGAR-----------------------------------
    $("#add").click(function(e){
        e.preventDefault();

        //var _token = $("input[name=_token]").val();
        var parent = $("select[name=parent]").val();
        var idrouter = $("select[name=idrouter]").val();
        
        var estado = $("input[name=estado]").val();
        var tipo_acceso = $("select[name=idtipo]").val();
        var perfil_internet = $("select[name=idperfil]").val();
        var usuario_cliente = $("input[name=usuario_cliente]").val();
        var contrasena_cliente = $("input[name=contrasena_cliente]").val();
        var direccion = $("input[name=direccion]").val();
        var coordenadas = $("input[name=coordenadas]").val();
        var ip = $("input[name=ip]").val();
        var mac = $("input[name=mac]").val();
        var fecha_instalacion = $("input[name=fecha_instalacion]").val();
        var dia_pago = $("input[name=dia_pago]").val();
        var precio = $("input[name=precio]").val();
        var emisor_conectado = $("select[name=emisor_conectado]").val();
        var equipo_receptor = $("select[name=equipo_receptor]").val();
        var ip_receptor = $("input[name=ip_receptor]").val();
        var usuario_receptor = $("input[name=usuario_receptor]").val();
        var contrasena_receptor = $("input[name=contrasena_receptor]").val();
        var glosa = $("text[name=glosa]").val();
        var zonas = $("select[name=zonas]").val();


        $.ajax({
            url: "{{ url('/servicio/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/servicio/grabar') }}",
           data:{
              idrouter:idrouter, 
              parent:parent,
              estado:estado,
              tipo_acceso:tipo_acceso,
              perfil_internet:perfil_internet,
              usuario_cliente:usuario_cliente,
              contrasena_cliente:contrasena_cliente,
              direccion:direccion,
              coordenadas:coordenadas,
              ip:ip,
              mac:mac,
              fecha_instalacion:fecha_instalacion,
              dia_pago:dia_pago,
              precio:precio,
              emisor_conectado:emisor_conectado,
              equipo_receptor:equipo_receptor,
              ip_receptor:ip_receptor,
              usuario_receptor:usuario_receptor,
              contrasena_receptor:contrasena_receptor,
              glosa:glosa,
              zonas:zonas,
              idcliente:"{{$idcliente}}"
           },

           success:function(data){
              
              if ( data[0] == "error") {
                
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.tipo_acceso != "undefined" )? $('#error2').text(data.tipo_acceso) : null;
                ( typeof data.perfil_internet != "undefined" )? $('#error3').text(data.perfil_internet) : null;
                ( typeof data.dia_pago != "undefined" )? $('#error4').text(data.dia_pago) : null;
                ( typeof data.precio != "undefined" )? $('#error5').text(data.precio) : null;
                ( typeof data.fecha_instalacion != "undefined" )? $('#error6').text(data.fecha_instalacion) : null;
                ( typeof data.zonas != "undefined" )? $('#error10').text(data.zonas) : null;
                ( typeof data.idrouter != "undefined" )? $('#error11').text(data.idrouter) : null;



              } else {   

                var obj = $.parseJSON(data);

                window.location="{{ url('/cliente') }}/{{$idcliente}}";  
                
                //alert(data.success);

              }

              
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });


     });

    //--------JPaiva--22-06-2018--------------------------------------LISTAR PERFILES---------------------------------------------------------
     $('#idtipo').change(function(e){
      var val = $("select[name=idtipo]").val();




      $("#idtipo option[value=0]").attr("selected", true);

      if ( val != '0') {
        $.ajax({
            url: "{{ url('/servicio/perfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/servicio/perfil') }}",
           data:{
              idtipo:val
           },

           success:function(data){
            
              var idrouter = $("select[name=idrouter]").val();
              
              $('#idperfil').empty();  
              $('#idperfil').removeAttr('disabled');
              $('#parent').removeAttr('disabled');
              

              $('#idperfil').append("<option value='0' disabled selected>Seleccione perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#idperfil').append("<option value='"+item.idperfil+"'>"+item.name+"</option>");
              });

              $.ajax({
                  url: "{{ url('/getQueues') }}",
                  type:"POST",
                  beforeSend: function (xhr) {
                      var token = $('meta[name="csrf-token"]').attr('content');

                      if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                      }
                  },
                 type:'POST',
                 url:"{{ url('/getQueues') }}",
                 data:{
                    idrouter:idrouter
                 },

                 success:function(data){
                  
                    //$('#parent').empty();  
                    //$('#parent').removeAttr('disabled');

                    //$('#parent').append("<option value='0' disabled selected>Seleccione Parent</option>"); 

                    $.each(data, function(i, item) {
                        //$('#parent').append("<option value='"+item.name+"'>"+item.name+"</option>");
                    });

                 },
                 error:function(){ 
                    alert("error!!!!");
              }

              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

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
              $('#ip').removeAttr('disabled');

              $('#idtipo').append("<option value='0' disabled selected>Elija una opción</option>"); 

              $.each(data, function(i, item) {
                  $('#idtipo').append("<option value='"+item.dsc_corta+"'>"+item.descripcion+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
    });

    //--------JPaiva--27-08-2019--------------------------------------IP POOL---------------------------------------------------------
    $('#ipPool').change(function(e){
      val = $('select[name=ipPool]').val();
      //console.log(val);
      listaIpDisponibles(val);
    });


    $("#ip").focus(function(){
        $(this).css("background-color", "#FFFFCC");
        $('#vwIpPool').modal('open');

        $.ajax({
            url: "{{ url('/getIpPool') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getIpPool') }}",
           data:{
              idrouter:$('#idrouter').val()
           },

           success:function(data){
            console.log(data);
              $('#ipPool').empty();  
              $('#ipPool').removeAttr('disabled');
              $('#ip').removeAttr('disabled');

              $('#ipPool').append("<option value='0' disabled selected>Elija grupo</option>"); 

              $.each(data, function(i, item) {
                  $('#ipPool').append("<option value='"+item.codigo+"'>"+item.descripcion+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });


        //listaIpDisponibles();  
    });    

    function prueba(ip){  
      $('#ip').val($("#ip"+ip).val());
      $('#vwIpPool').modal('close');
    }  


    function listaIpDisponibles(idPool){  
      val = $("select[name=idrouter]").val();
  
        $.ajax({
            url: "{{ url('/listaIpDisponibles') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/listaIpDisponibles') }}",
           data:{
              idrouter:val,
              codigo:idPool,
              idtipo:$("select[name=idtipo]").val()
           },

           success:function(data){
            
            cont = parseInt($('#cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#importHST" + i).remove();
            }
              
              $.each(data, function(i, item) {                   

                $("#tableImportHST").append("<tr class='center' id='importHST"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' id='ip"+i+"' value='"+item.ip+"'>"+ 
                  "<td class='center'>"+ i +"</td>"+
                  "<td id='ip"+i+"' class='center'>"+ item.ip +"</td>"+                  
                  "<td class='center'>"+
                      "<div id='i_estado' class='chip center-align teal accent-4 white-text' style='width: 90%'>"+
                        "<b>DISPONIBLE</b>"+
                        "<i class='material-icons'></i>"+
                      "</div>"+
                  "</td>"+
                  "<td class='center'>"+
                  "<a class='seleccionado2 btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Seleccionar' onClick='prueba("+i+")'><i class='material-icons' style='color: #757575 '>add</i></a>"+
                "</td>"+
                 // "</form>"+                 
                "</tr>");

                cont = i;
              });

              $('#cont').val(cont);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
    };
</script>