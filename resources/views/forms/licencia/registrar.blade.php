<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white" >
  @include('hotspot.layouts.partials.header')  

 
  
  <div class="contend">
   <div id="main" style="padding-left: 0px; padding-top: 1.2rem">
      <!-- START WRAPPER -->
      <div class="wrapper">
             <br>
         <section id="content center">
            <div class="row">
              <div class="col s12 m12 l6 offset-l3">
                            <div class="card">
                              <div class="card-header">                    
                                <i class="fa fa-table fa-lg material-icons">receipt</i>
                                <h2>REGISTRAR LICENCIA</h2>
                              </div>
                              
                              <div class="row card-header sub-header">
                                    <div class="col s12 m12 herramienta">                         
                                      <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                        <i class="material-icons blue-text text-darken-2">check</i></a>
                                      <a style="margin-left: 6px"></a>   
                                   
                                    </div>  

                                    @include('forms.scripts.modalInformacion')              
                                    
                              </div>
                                                
                              <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                              <div class="row cuerpo">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="empresa" name="empresa" value="">
                                <input type="hidden" id="codigo2" name="codigo2" value="">
                                <input type="hidden" id="idlicencia" name="idlicencia" value="">
                                <input type="hidden" id="meses" name="meses" value="">
                                <input type="hidden" id="tipo" name="tipo" value="">
                                <input type="hidden" id="idcliente" name="idcliente" value="">
                                <input type="hidden" id="fecha_inicio" name="fecha_inicio" value="">
                                <input type="hidden" id="fecha_fin" name="fecha_fin" value="">
                                @foreach($empresa as $data)
                                <input type="hidden" id="direccion" name="direccion" value="{{$data->direccion}}">
                                <input type="hidden" id="RUC" name="RUC" value="{{$data->RUC}}">
                                <input type="hidden" id="referencia" name="referencia" value="{{$data->referencia}}">
                                <input type="hidden" id="DNI1" name="DNI1" value="{{$data->DNI1}}">
                                <input type="hidden" id="representante1" name="representante1" value="{{$data->representante1}}">
                                <input type="hidden" id="razon_social" name="razon_social" value="{{$data->razon_social}}">
                                <input type="hidden" id="telefono" name="telefono" value="{{$data->telefono}}">
                                <input type="hidden" id="iddocumento" name="iddocumento" value="{{$data->iddocumento}}">
                                @endforeach
                                                                     
                                <div class="col col s12">
                                  <div class="card grey lighten-5">
                                    <div class="card-content">
                                        <span class="card-title center">Parametros</span>

                                        <div class="row"> 
                                          <div class="col s12" style="padding-bottom: 14px">
                                            <label for="idempresa">Empresa</label>
                                            <select class="browser-default" id="idempresa" name="idempresa" required >
                                              <option value="" disabled selected="">Seleccionar empresa</option>
                                              @foreach($empresa as $datos)
                                                <option value="{{$datos->idempresa}}">{{"($datos->idempresa)"." ".$datos->razon_social}}</option>
                                              @endforeach
                                            </select>
                                            <div id="error1" style="color: red; font-size: 12px; font-style: italic"></div>
                                          </div>   
                                          <div class="input-field col s12">
                                            <i class="material-icons prefix">filter_tilt_shift</i>
                                            <input id="ip_server" name="ip_server" type="text">
                                            <label for="ip_server"> IP del Servidor InnovaTec</label>
                                            <div id="error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>                                 
                                          <div class="input-field col s12">
                                            <i class="material-icons prefix">subtitles</i>
                                            <input id="codigo" name="codigo" type="text" onkeyup="mayus(this);">
                                            <label for="codigo">Licencia</label>
                                            <div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>    
                                        </div>

                                    </div>
                                  </div>
                                </div>
                                  
                              </div>
                              </form>
                          </div>
              </div>
            </div>
         </section>
        
        </div>
        <!-- END WRAPPER -->
    </div> 
  </div>
  
  @include('hotspot.layouts.partials.footer')
  @include('hotspot.layouts.partials.scripts')  
  @include('forms.licencia.scripts.validacion')
  @include('forms.licencia.scripts.valida')

</body>
</html>

