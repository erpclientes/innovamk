@extends('layouts2.app')
@section('titulo','Actualizar Servicio')

@section('main-content')
@foreach($servicio as $datos)
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRO DE SERVICIO</h2>
                  </div>
                  <form class="formValidate right-alert">
                    <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i></button>
                          <a style="margin-left: 6px"></a>   
                          <a href="{{url('/cliente')}}/{{$idcliente}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.servicio.frmIpPool')              
                        
                    </div>
                    <br> 
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col s12 m12 l12">
                          <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m5 l5">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                        @if($valor->idrouter == $datos->idrouter)
                                                          <option value="{{ $valor->idrouter }}" selected>{{ $valor->alias }}</option>
                                                        @else
                                                          <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                        @endif
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 s12 m3 l3 ">
                                                    <label for="zonas">ZONAS</label>
                                                  <select class="browser-default" id="zonas" name="zonas" required>
                                                    <option value="" disabled>Seleccione</option>
                                                    @foreach($zonas as $fp)
                                                    <option value="{{$fp->id }}" {{ $fp->id== $datos->idZona ? "selected" : "" }}>{{$fp->nombre}}</option>
                                                    @endforeach
                                                  </select> 
                                                   
                                                  </div>
                                                  

                                                  <div class="input-field col s12 s12 m4 l right-align">
                                                      @if($datos->estado == 0)
                                                        <div id="u_estado" class="chip center-align" style="width: 70%">
                                                            <b>Estado:</b> <b>NO DISPONIBLE</b>
                                                          <i class="material-icons"></i>
                                                        </div>
                                                      @else
                                                        <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                                          <b>Estado:</b>    <b>ACTIVO</b>
                                                          <i class="material-icons"></i>
                                                        </div>
                                                      @endif
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                                       
                      </div>  

                      <div class="col s12 m12 l6">
                          <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Datos Generales</span>

                                              <div class="row">                                                  
                                                  <div class="col s12 m6 l6">                                                    
                                                    <label for="idtipo">Tipo de Acceso</label>
                                                    <select class="browser-default" id="idtipo" name="idtipo" data-error=".errorTxt1" > 
                                                      <option value="0" disabled="" selected="">Elija opción</option>
                                                      @foreach ($tipo as $valor)
                                                        @if($valor->dsc_corta == $datos->tipo_acceso)
                                                          <option value="{{ $valor->dsc_corta }}" selected="">{{ $valor->descripcion }}</option>
                                                        @else
                                                          <option value="{{ $valor->dsc_corta }}">{{ $valor->descripcion }}</option>
                                                        @endif
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m6 l6">
                                                    <label for="idperfil">Perfil de Internet</label>
                                                    <select class="browser-default" id="idperfil" name="idperfil" data-error=".errorTxt1" disabled> 
                                                      <option value="cero" disabled="" selected="">Elija un perfil</option>
                                                      @foreach ($perfiles as $valor)
                                                        @if($valor->idperfil == $datos->perfil_internet)
                                                          <option value="{{ $valor->idperfil }}" selected>{{ $valor->name }}</option>
                                                        @else
                                                          <option value="{{ $valor->idperfil }}">{{ $valor->name }}</option>
                                                        @endif
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>                                                            
                                              </div> 
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">insert_invitation</i>
                                                  <input id="dia_pago" name="dia_pago" type="text" maxlength="2" value="{{$datos->dia_pago}}">
                                                  <label for="dia_pago">Día de Pago</label>
                                                  <div class="errorTxt1" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="precio" name="precio" type="text" placeholder="" maxlength="9" value="{{$datos->precio}}">
                                                  <label for="precio">Precio del Plan</label>
                                                  <div class="errorTxt1" id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                              </div>    
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">account_circle</i>
                                                  <input id="usuario_cliente" name="usuario_cliente" type="text" value="{{$datos->usuario_cliente}}">
                                                  <label for="usuario_cliente">Usuario</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">vpn_key</i>
                                                  <input id="contrasena_cliente" name="contrasena_cliente" type="text" value="{{$datos->contrasena_cliente}}">
                                                  <label for="contrasena_cliente">Contraseña</label>
                                                </div>                        
                                              </div> 
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip" name="ip" type="text" value="{{$datos->ip}}">
                                                  <label for="ip">Dirección IP</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">blur_linear</i>
                                                  <input id="mac" name="mac" type="text" value="{{$datos->mac}}">
                                                  <label for="mac">MAC</label>
                                                </div>                        
                                              </div>                   
                                              <div class="row"> 

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">maps_local</i>
                                                  <input id="latitudSU" name="latitudSU" type="text" value="{{$datos->latitud}}" readonly="readonly" >
                                                  <label for="latitudSU">Incorporar latitud</label>
                                                </div> 
                                                <div class="input-field col s12 m6 l6"> 
                                                  <i class="material-icons prefix">maps_local</i>
                                                  <input id="longitudSU" name="longitudSU" type="text" value="{{ $datos->longitud }}" readonly="readonly" >
                                                  <label for="longitudSU">Incorporar longitud</label> 
                                                </div> 
                                              </div>
                                              <div class="row">
                                                <div class="input-field col s12 m6 l12"> 
                                                  <i class="material-icons prefix">room</i>
                                                  <input id="direccionSU"  readonly="readonly" name="direccionSU" type="text" value="{{ $datos->direccion }}">
                                                  <label for="direccionSU">Dirección</label> 
                                                </div>                        
                                              </div> 
                                              <div class="row">
                                                <div class="col s12"> 
                                                  <a type="button" class="waves-effect waves-light btn modal-trigger gradient-45deg-indigo-blue col s12" href="#modalCreate1" id="modalServicio"  style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem;"   >AGREGAR  Dirección</a>
                                                  @include('forms.clientes.mapa.mapsClienteCreate')
                                                  
                                                </div> 
                                                                        
                                              </div>
                                                      
                                                  
                                            </div>
                    </div>
                  </div>

                  <div class="col s12 m12 l6">
                <div class="card white">
                                            <div class="card-content">
                                              <span class="card-title">Datos técnicos</span>

                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">insert_invitation</i>
                                                  <input id="fecha_instalacion" name="fecha_instalacion" type="text" class="datepicker" placeholder="dd/mm/AAAA" value="{{ date_format(date_create($datos->fecha_instalacion),'d/m/Y') }}">
                                                  <label for="fecha_instalacion">Fecha de Instalación</label>
                                                </div>   
                                                
                                                 <div class="col s12 m6 l6">
                                                    <label for="emisor_conectado">Equipo Emisor</label>
                                                    <select class="browser-default" id="emisor_conectado" name="emisor_conectado" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Seleccione un equipo</option>
                                                      @foreach ($eqemisor as $valor)
                                                        @if($valor->idequipo == $datos->emisor_conectado)
                                                          <option value="{{ $valor->idequipo }}" selected>{{ $valor->descripcion }}</option>
                                                        @else
                                                          <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                        @endif
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>                               
                                              </div>           
                                              <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <label for="equipo_receptor">Equipo Receptor</label>
                                                    <select class="browser-default" id="equipo_receptor" name="equipo_receptor" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Equipo Cliente Receptor</option>
                                                      @foreach ($eqreceptor as $valor)
                                                        @if($valor->idequipo == $datos->equipo_receptor)
                                                          <option value="{{ $valor->idequipo }}" selected>{{ $valor->descripcion }}</option>
                                                        @else
                                                          <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                        @endif
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1"></div>
                                                  </div>            

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip_receptor" name="ip_receptor" type="text" placeholder="" value="{{$datos->ip_receptor}}">
                                                  <label for="ip_receptor">IP equipo receptor</label>
                                                </div>                        
                                              </div>           
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">portrait</i>
                                                  <input id="usuario_receptor" name="usuario_receptor" type="text" placeholder="" value="{{$datos->usuario_receptor}}">
                                                  <label for="usuario_receptor">Usuario Equipo Receptor</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">vpn_key</i>
                                                  <input id="contrasena_receptor" name="contrasena_receptor" type="text" placeholder="" value="{{$datos->contrasena_receptor}}">
                                                  <label for="contrasena_receptor">Contraseña Equipo Receptor</label>
                                                </div>         
                                              </div>
                                              <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;">{{$datos->glosa}}</textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>            
                                              </div>
                                            </div>
                                        </div>  
                                    </div>                        
                   

                  </form>
              </div>
  </div>
</div>

@endsection

@section('script')
  <script type="text/javascript">

    $("#modalServicio").click(function(f){
      f.preventDefault();
      console.log("ingreso");
      var datos = []; 
    var latitud , longitud,direccion ;
    

    function ObtenerDireccion() {
       // value = $('#value').text();
       var data = []; 
       //ar data = bandera.push('B',); 
       data.push(['carlos']); 	
       $.ajax({
        url: " {{ url('/pasar') }} ",
        type:"POST",
        beforeSend: function (xhr) {
           var token = $('meta[name="csrf-token"]').attr('content');
           if (token) {
               return xhr.setRequestHeader('X-CSRF-TOKEN', token);
           }
        },
        type:'POST',
        url:" {{ url('/pasar') }} ",
        data:{
          bandera:"bandera"
        },
        success:function(data){
        //  console.log(data);
          if ( data[0] == "error") {
          console.log("error");
          
          } else {  
           console.log("recupero data ");
           console.log(data); 
           if(data.longitud==null ){
             console.log("esta nulo ")
              //setInterval(ObtenerDireccion, 3000);
             //intervalo();
           }else{
             latitud=data.latitud;
             longitud=data.longitud;
             direccion=data.direccion;
            console.log(direccion);
            $('#direccionSU').val(direccion ); 
            $('#latitudSU').val(latitud);
            $('#longitudSU').val(longitud );
            $('#modalCreate1').modal('close');
            console.log("se actualiza registro ");
           }
           //datos=data;
           //clearInterval(intervalo);

          }
        },
        error:function(){ 
          alert("error!!!!");
          }
      });
    }

    
    setInterval(ObtenerDireccion, 3000);
     
   });


    ////////////////////////////cargar calendario////////////////////////////////////
    $(".datepicker").datepicker({
      autoclose: true,
      format: "dd/mm/yyyy"
    });
  </script>


  
  <script type="text/javascript">
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

        //--------JPaiva--25-06-2018--------------------------------------LISTAR PERFILES---------------------------------------------------------
     $('#idtipo').change(function(e){
      var val = $("select[name=idtipo]").val();
      console.log(val);



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
            console.log(data);
              //var obj = $.parseJSON(data); 
              $('#idperfil').empty();  
              $('#idperfil').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#idperfil').append("<option value='0' disabled selected>Seleccione perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#idperfil').append("<option value='"+item.idperfil+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });


    $('#idperfil').change(function(e){
      val = $('#idperfil').val();
        console.log(val);

      @foreach($queues as $val)
        if (val == {{$val->idqueues}}){
          $('#precio').val('{{$val->precio}}');
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
        console.log("pruebaaaaaa");

        //var _token = $("input[name=_token]").val();
        var idrouter = $("select[name=idrouter]").val();
        var estado = $("input[name=estado]").val();
        var tipo_acceso = $("select[name=idtipo]").val();
        var perfil_internet = $("select[name=idperfil]").val();
        var usuario_cliente = $("input[name=usuario_cliente]").val();
        var contrasena_cliente = $("input[name=contrasena_cliente]").val();
        var direccionSU = $("input[name=direccionSU]").val();
        var latitudSU = $("input[name=latitudSU]").val();
        var longitudSU = $("input[name=longitudSU]").val(); 
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
        var zonas =$("select[name=zonas]").val();
        var glosa = $("text[name=glosa]").val();

        console.log(precio);
        $.ajax({
            url: "{{ url('/servicio/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/servicio/actualizar') }}",
           data:{
              idrouter:idrouter, 
              estado:estado,
              tipo_acceso:tipo_acceso,
              perfil_internet:perfil_internet,
              usuario_cliente:usuario_cliente,
              contrasena_cliente:contrasena_cliente,
              direccionSU:direccionSU,
              latitudSU :latitudSU,
              longitudSU :  longitudSU, 
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
              idservicio:"{{$datos->idservicio}}",
              zonas:zonas,
              idcliente:"{{$idcliente}}"
           },

           success:function(data){
              
              if ( data[0] == "error") {
                console.log(data.idtipo);
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.tipo_acceso != "undefined" )? $('#error2').text(data.tipo_acceso) : null;
                ( typeof data.perfil_internet != "undefined" )? $('#error3').text(data.perfil_internet) : null;
                ( typeof data.dia_pago != "undefined" )? $('#error4').text(data.dia_pago) : null;
                ( typeof data.precio != "undefined" )? $('#error5').text(data.precio) : null;
              } else {   

                var obj = $.parseJSON(data);

                window.location="{{ url('/cliente') }}/{{$datos->idcliente}}"; 
               

                //alert(data.success);

              }

              
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });


     });

    //--------JPaiva--28-08-2019--------------------------------------IP POOL---------------------------------------------------------
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
@endsection
@endforeach
