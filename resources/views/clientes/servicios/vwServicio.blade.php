@extends('layouts2.app')
@section('titulo','Actualizar Servicio')

@section('main-content')
@foreach($servicio as $datos)
<br>
<div class="row">
  <div class="col s12 m12 l8 offset-l2">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRO DE SERVICIO</h2>
                  </div>
                  <form class="formValidate right-alert">
                    <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          
                          <a href="{{url('/servicio')}}/{{Auth::user()->id}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                                                
                  </div>
                                   <br> 
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col s12">
                          <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" disabled> 
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

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
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

                      <div class="col s12">
                          <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Datos Generales</span>

                                              <div class="row">                                                  
                                                  <div class="col s12 m6 l6">                                                    
                                                    <label for="idtipo">Tipo de Acceso</label>
                                                    <select class="browser-default" id="idtipo" name="idtipo" data-error=".errorTxt1" disabled> 
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
                                                  <input id="dia_pago" name="dia_pago" type="text" maxlength="2" value="{{$datos->dia_pago}}" disabled>
                                                  <label for="dia_pago">Día de Pago</label>
                                                  <div class="errorTxt1" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="precio" name="precio" type="text" placeholder="" maxlength="9" value="{{$datos->precio}}" disabled>
                                                  <label for="precio">Precio del Plan</label>
                                                  <div class="errorTxt1" id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                              </div>    
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">account_circle</i>
                                                  <input id="usuario_cliente" name="usuario_cliente" type="text" value="{{$datos->usuario_cliente}}" disabled>
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
                                                  <i class="material-icons prefix">place</i>
                                                  <input id="direccion" name="direccion" type="text" value="{{$datos->direccion}}" disabled>
                                                  <label for="direccion">Dirección</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">my_location</i>
                                                  <input id="Coordenadas" name="coordenadas" type="text" value="{{$datos->coordenadas}}" disabled>
                                                  <label for="coordenadas">Coordenadas</label>
                                                </div>                        
                                              </div>         
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip" name="ip" type="text" value="{{$datos->ip}}" disabled>
                                                  <label for="ip">Dirección IP</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">blur_linear</i>
                                                  <input id="mac" name="mac" type="text" value="{{$datos->mac}}" disabled>
                                                  <label for="mac">MAC</label>
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
    $('#fecha_instalacion').formatter({
          'pattern': '@{{99}}/@{{99}}/@{{9999}}',
        });

    $('#dia_pago').formatter({
      'pattern' : '@{{99}}'
    });

 
    $('#ip').mask('099.099.099.099');
    $('#mac').mask('AA:AA:AA:AA:AA:AA');
    $('#ip_receptor').mask('099.099.099.099');
    $('#usuario_cliente').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    $('#usuario_receptor').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    $('#precio').mask('###0.00', {reverse: true});

        //--------JPaiva--25-06-2018--------------------------------------LISTAR PERFILES---------------------------------------------------------
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
            //console.log(data);
             
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
        //console.log(val);

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
        //console.log("pruebaaaaaa");

        //var _token = $("input[name=_token]").val();
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

        //console.log(precio);
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
              idservicio:"{{$datos->idservicio}}",
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
   
  </script>
@endsection
@endforeach
