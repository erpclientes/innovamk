<div id="mntPost" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="row cabecera" style="margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">                 
                                    <div class="col s12 m12 l12">
                                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar Servicio de Internet</b></h4>  
                                    </div>
                                  </div>
                                  
                                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-top: 40px; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 2">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar"><i class="mdi-navigation-check" style="color: #2E7D32"></i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario"><i class="mdi-action-info"></i></a>
                                          <a href="#" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar"><i class="mdi-hardware-keyboard-tab" style="color: #424242"></i></a>            
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 40px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      

                                      <div class="row">                                        
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px">
                                              <span class="card-title">Cabecera</span>
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                                        
                                      </div>                    

                                      <div class="row">                                        
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px">                                               
                                              <span class="card-title">Datos Generales</span>

                                              <div class="row">                                                  
                                                  <div class="col s12 m6 l6">                                                    
                                                    <label for="idtipo">Tipo de Acceso</label>
                                                    <select class="browser-default" id="idtipo" name="idtipo" data-error=".errorTxt1" > 
                                                      <option value="0" disabled="" selected="">Elija opción</option>
                                                      @foreach ($tipo as $valor)
                                                      <option value="{{ $valor->idtipo }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m6 l6">
                                                    <label for="idperfil">Perfil de Internet</label>
                                                    <select class="browser-default" id="idperfil" name="idperfil" data-error=".errorTxt1" disabled> 
                                                      <option value="cero" disabled="" selected="">Elija un perfil</option>
                                                      @foreach ($queues as $valor)
                                                      <option value="{{ $valor->idqueues }}">{{ $valor->nombre }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>                                                            
                                              </div> 
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-editor-insert-invitation prefix active"></i>
                                                  <input id="dia_pago" name="dia_pago" type="text">
                                                  <label for="dia_pago">Día de Pago</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-editor-attach-money prefix active"></i>
                                                  <input id="precio" name="precio" type="text" placeholder="">
                                                  <label for="precio">Precio del Plan</label>
                                                </div>
                                              </div>    
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-action-account-circle prefix active"></i>
                                                  <input id="usuario_cliente" name="usuario_cliente" type="text">
                                                  <label for="usuario_cliente">Usuario</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-communication-vpn-key prefix"></i>
                                                  <input id="contrasena_cliente" name="contrasena_cliente" type="text">
                                                  <label for="contrasena_cliente">Contraseña</label>
                                                </div>                        
                                              </div>                   
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-maps-place prefix active"></i>
                                                  <input id="direccion" name="direccion" type="text">
                                                  <label for="direccion">Dirección</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-maps-my-location prefix"></i>
                                                  <input id="Coordenadas" name="coordenadas" type="text">
                                                  <label for="coordenadas">Coordenadas</label>
                                                </div>                        
                                              </div>         
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-action-settings-ethernet prefix active"></i>
                                                  <input id="ip" name="ip" type="text">
                                                  <label for="ip">Dirección IP</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-image-blur-linear prefix"></i>
                                                  <input id="mac" name="mac" type="text">
                                                  <label for="mac">MAC</label>
                                                </div>                        
                                              </div>     
                                            </div>
                                        </div>                                        
                                      </div>          

                                      <div class="row">                                        
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px;">
                                              <span class="card-title">Datos técnicos</span>

                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-editor-insert-invitation prefix"></i>
                                                  <input id="fecha_instalacion" name="fecha_instalacion" type="text">
                                                  <label for="fecha_instalacion">Fecha de Instalación</label>
                                                </div>  
                                                
                                                 <div class="col s12 m6 l6">
                                                    <label for="emisor_conectado">Equipo Emisor</label>
                                                    <select class="browser-default" id="emisor_conectado" name="emisor_conectado" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Seleccione un equipo</option>
                                                      @foreach ($eqemisor as $valor)
                                                      <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>                               
                                              </div>           
                                              <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <label for="equipo_receptor">Equipo Receptor</label>
                                                    <select class="browser-default" id="equipo_receptor" name="equipo_receptor" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Equipo Cliente Receptor</option>
                                                      @foreach ($eqreceptor as $valor)
                                                      <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1"></div>
                                                  </div>            

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-action-settings-ethernet prefix"></i>
                                                  <input id="ip_receptor" name="ip_receptor" type="text" placeholder="">
                                                  <label for="ip_receptor">IP equipo receptor</label>
                                                </div>                        
                                              </div>           
                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-image-portrait prefix active"></i>
                                                  <input id="usuario_receptor" name="usuario_receptor" type="text" placeholder="">
                                                  <label for="usuario_receptor">Usuario Equipo Receptor</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="mdi-communication-vpn-key prefix"></i>
                                                  <input id="contrasena_receptor" name="contrasena_receptor" type="text" placeholder="">
                                                  <label for="contrasena_receptor">Contraseña Equipo Receptor</label>
                                                </div>         
                                              </div>
                                              <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="mdi-editor-mode-edit prefix"></i>
                                                  <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
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

@section('script')
<script type="text/javascript">

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
        console.log(val);

      @foreach($queues as $val)
        if (val == {{$val->idqueues}}){
          $('#precio').val('{{$val->precio}}');
          $('#precio').attr("placeholder","probandooo");
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
        var direccion = $("input[name=direccion]").val();
        var coordenadas = $("input[name=coordenadas]").val();
        var ip = $("input[name=ip]").val();
        var mac = $("input[name=mac]").val();
        var fecha_instalacion = $("input[name=fecha_creacion]").val();
        var dia_pago = $("input[name=dia_pago]").val();
        var precio = $("input[name=precio]").val();
        var emisor_conectado = $("select[name=emisor_conectado]").val();
        var equipo_receptor = $("select[name=equipo_receptor]").val();
        var ip_receptor = $("input[name=ip_receptor]").val();
        var usuario_receptor = $("input[name=usuario_receptor]").val();
        var contrasena_receptor = $("input[name=contrasena_receptor]").val();
        var glosa = $("text[name=glosa]").val();


        $.ajax({
            url: "{{ url('/cliente/servicios') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/cliente/servicios') }}",
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
              glosa:glosa
           },

           success:function(data){
              console.log('entro0000');
              console.log(data);
              
              if ( data[0] == "error") {
                console.log(data.idtipo);
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.tipo_acceso != "undefined" )? $('#error2').text(data.tipo_acceso) : null;
                ( typeof data.perfil_internet != "undefined" )? $('#error3').text(data.perfil_internet) : null;
                ( typeof data.emisor_conectado != "undefined" )? $('#error4').text(data.emisor_conectado) : null;
              } else {   

                var obj = $.parseJSON(data);
                console.log(data);

                //console.log(Object.values(data));
                $("#data-table-simple").append("<tr class='post"+ obj[0]['idservicio'] +"'>"+
                "<td>"+ obj[0]['idservicio'] +"</td>"+
                "<td>"+ obj[0]['desc_perfil'] +"</td>"+
                "<td>"+ obj[0]['precio'] +"</td>"+
                "<td>"+ obj[0]['equipo_receptor'] +"</td>"+
                "<td>"+ obj[0]['ip'] +"</td>"+
                "<td>"+ obj[0]['estado'] +"</td>"+
                "<td>"+ obj[0]['fecha_instalacion'] +"</td>"+
                "<td class='center'>"+
                  "<a href='{{ url('/cliente/servicios/mostrar') }}/"+ obj[0]['idservicio'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='mdi-action-visibility' style='color: #7986cb'></i></a>"+                                     
                  " <a href='#confirmacion"+ obj[0]['idservicio'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                "</td>"+
                "</tr>");

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