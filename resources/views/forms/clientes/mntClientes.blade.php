 @extends('layouts2.app')
@section('titulo','Registro Cliente')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRO CLIENTE</h2>
                  </div>
                  <form class="formValidate right-alert" id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped"  data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i></a>
                          <a style="margin-left: 6px"></a>   
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>

      <br>  
      <div class="col s12 m12 l6">
       
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos Generales</span>
                          <div class="row">
                            <div class="col s12 m6 l6">
                                  <label for="idempresa">Empresa</label>                 
                                  <select class="browser-default" id="idempresa" name="idempresa" required>
                                    <option value="" disabled selected="">Seleccione</option>
                                    @foreach($empresa as $datos)
                                    <option value="{{$datos->idempresa}}"> {{$datos->razon_social}}</option>
                                    @endforeach
                                  </select>
                                <div id="error110" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>
                            <div class="col s12 m6 l6">                                                                               
                              <label for="iddocumento">Documento</label>
                              @foreach($parametros as $datos)
                              @if($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'SI')
                                <select class="browser-default" id="iddocumento" name="iddocumento" required disabled> 
                                  <option value="COD" disabled selected="">Código interno</option>                                  
                                </select>
                                <input type="hidden" id="parametro" name="parametro" value="SI">
                              @elseif($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'NO')
                                <select class="browser-default" id="iddocumento" name="iddocumento" required> 
                                  <option value="" disabled selected="">Seleccione</option>
                                  @foreach($tipo_documento as $documento)
                                  <option value="{{$documento->iddocumento}}">{{$documento->dsc_corta}} - {{$documento->descripcion}}</option> 
                                  @endforeach                                                                                  
                                </select>
                                <input type="hidden" id="parametro" name="parametro" value="NO">
                              @endif
                              @endforeach
                              <div id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>                    
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix active">label_outline</i>
                              @foreach($parametros as $datos)
                              @if($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'SI')
                              <input id="nro_documento" name="nro_documento" type="text" data-error=".errorTxt2" maxlength="20" disabled onkeyup="mayus(this);">
                              @elseif($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'NO')
                              <input id="nro_documento" name="nro_documento" type="text" data-error=".errorTxt2" maxlength="20" onkeyup="mayus(this);">
                              @endif
                              @endforeach
                              <label for="nro_documento">Nro. Documento</label>
                              <div id="error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                              
                            </div>        
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">perm_identity</i>
                              <input id="apaterno" name="apaterno" type="text" data-error=".errorTxt3">
                              <label for="apaterno">Apellido Paterno</label>
                              <div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">perm_identity</i>
                              <input id="amaterno" name="amaterno" type="text" data-error=".errorTxt4">
                              <label for="amaterno">Apellido Materno</label>
                              <div id="error4" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                            </div>   
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">person</i>
                              <input id="nombres" name="nombres" type="text" data-error=".errorTxt5">
                              <label for="nombres">Nombres</label>
                              <div id="error5" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                            </div>  
                                 
                            <div class="input-field col s12 m6 l6" readonly="readonly">
                              <i class="material-icons prefix">maps_local</i>
                              <textarea id="latitudC" name="latitudC" class="materialize-textarea" readonly="readonly"></textarea>
                              <label for="latitudC" class="">Latitud</label>
                            </div> 
                            <div class="input-field col s12 m6 l6" readonly="readonly">
                              <i class="material-icons prefix">maps_local</i>
                              <textarea id="longitudC" name="longitudC" class="materialize-textarea" readonly="readonly" ></textarea>
                              <label for="longitudC" class="">Longitud</label>
                            </div> 
                            <div class="input-field col s12 m12 l12"  >
                              <i class="material-icons prefix">room</i>
                              <input id="direccion" name="direccion" type="text" readonly="readonly">
                              <label for="direccion">Dirección</label>
                              <div id="error6" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                            </div>

                            
                            <div class="col s12"> 
                              <a type="button" class="waves-effect waves-light btn modal-trigger gradient-45deg-indigo-blue col s12" href="#modalCreate1" id="modalClienteDir"  style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem;"   >AGREGAR  Dirección</a>
                              @include('forms.clientes.mapa.mapsClienteCreate')
                              
                            </div>   
                                          
                          </div>
                        </div>
          </div>

      </div> 
      @include('forms.clientes.modalValidarId')
      @include('forms.clientes.modalDatos')
      <div class="col s12 m12 l6"> 
            <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Contato</span>
                          <div class="row">                         
                            
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">email</i>
                              <input id="correo" name="correo" type="email">
                              <label for="correo">Email</label>
                            </div>  
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">perm_contact_cal</i>
                              <input id="contacto" name="contacto" type="text">
                              <label for="contacto">Contacto</label>
                            </div>                              
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">call</i>
                              <input id="telefono1" name="telefono1" type="text">
                              <label for="telefono1">Telefono 1</label>
                            </div>   
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">call</i>
                              <input id="telefono2" name="telefono2" type="text">
                              <label for="telefono2">Telefono 2</label>
                            </div>  
                            <div class="input-field col s12">
                              <i class="material-icons prefix">mode_edit</i>
                              <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="400" style="height: 80px"></textarea>
                              <label for="glosa" class="">Comentario</label>
                            </div>            
                          </div>
                        </div>
              </div>
         
      </div>
        

                  
                  <div class="row">                   
                    
                      

                      <div class="col s12 m12 l12">
                        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                          <li class="active">
                            <div class="collapsible-header light-blue light-blue-text text-lighten-5 active">
                              <i class="material-icons">business</i> 
                              Datos por Defecto para Doc. Venta</div>
                            <div class="collapsible-body light-blue lighten-5" style="display: none">                              
                                <div class="row">                       
                                  <div class="col s12 m6 l6">
                                    <label for="forma_pago">Forma de Pago</label>
                                    <select class="browser-default" id="forma_pago" name="forma_pago" required>
                                      <option value="" disabled selected="">Seleccione</option>
                                      @foreach($forma_pagos as $fp)
                                      <option value="{{$fp->idforma_pago}}">{{$fp->descripcion}}</option>
                                      @endforeach
                                    </select> 
                                    <div id="error7" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>
                                                       
                                  <div class="col s12 m6 l6">
                                    <label for="doc_venta">Comp. de Venta</label>
                                    <select class="browser-default" id="doc_venta" name="doc_venta" required>
                                      <option value="" disabled selected="">Seleccione</option>
                                      @foreach($tipo_documento_venta as $tdv)
                                      <option value="{{$tdv->iddocumento}}">{{$tdv->descripcion}}</option>
                                      @endforeach
                                    </select>
                                    <div id="error8" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>
                                                        
                                  <div class="col s12 m6 l6">
                                    <label for="moneda">Moneda</label>
                                    <select class="browser-default" id="moneda" name="moneda" required>
                                      <option value="" disabled selected="">Seleccione</option>
                                      @foreach($moneda as $m)
                                      <option value="{{$m->idmoneda}}">{{$m->descripcion}} - {{$m->dsc_corta}}</option>
                                      @endforeach
                                    </select> 
                                    <div id="error9" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">event</i>
                                    <input id="dia_pago" name="dia_pago" type="number">
                                    <label for="dia_pago">Día de Pago</label>
                                  </div>                        
                                </div> 
                            </div>
                          </li>                  
                        </ul>
                      </div>

                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br>
@endsection

@section('script')
  @include('forms.clientes.scripts.validacion')
  @include('forms.clientes.scripts.addCliente') 
  @include('forms.clientes.scripts.obtenerUbicacion')  
@endsection
