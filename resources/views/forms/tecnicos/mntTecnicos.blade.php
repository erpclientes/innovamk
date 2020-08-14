@extends('layouts2.app')
@section('titulo','Registro Tecnico')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card" style="margin: auto; width: 87%">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRO DE TECNICOS </h2>
                  </div>
                  <form class="formValidate right-alert" id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="row card-header sub-header">
                          <div class="col s12 m12 herramienta">                         
                            <a id="addTecnicos" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped"  data-position="top" data-delay="500" data-tooltip="Guardar">
                              <i class="material-icons" style="color: #2E7D32">check</i></a>
                            <a style="margin-left: 6px"></a>   
                            <a href="{{url('/tecnicos')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
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
                                            <label for="iddocumento">Documento</label>
                                            @foreach($parametros as $datos)
                                            @if($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'SI')
                                              <select class="browser-default" id="iddocumento" name="iddocumento" required disabled> 
                                                <option value="COD" disabled  >Código interno</option>                                  
                                              </select>
                                            @elseif($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'NO')
                                              <select class="browser-default" id="iddocumento" name="iddocumento" required> 
                                                <option value="" disabled  >Seleccione</option>
                                                @foreach($tipo_documento as $documento)
                                                <option value="{{$documento->iddocumento}}">{{$documento->dsc_corta}} - {{$documento->descripcion}}</option> 
                                                @endforeach                                                                                  
                                              </select>
                                            @endif
                                            @endforeach
                                             
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
                                            <div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>
                                          <div class=" col s12 m6 l6">
                                            <label for="sexo">Sexo</label>
                                            <select class="browser-default" id="sexo" name="sexo" required>
                                              <option value="" disabled selected="">Seleccione</option> 
                                              <option value="2">MASCULINO</option>
                                              <option value="1">FEMENINO</option> 
                                            </select>
                                            <div id="error5" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>        
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">perm_identity</i>
                                            <input id="apaterno" name="apaterno" type="text" data-error=".errorTxt3">
                                            <label for="apaterno">Apellido Paterno</label>
                                            <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">perm_identity</i>
                                            <input id="amaterno" name="amaterno" type="text" data-error=".errorTxt4">
                                            <label for="amaterno">Apellido Materno</label>
                                            <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>   
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">person</i>
                                            <input id="nombres" name="nombres" type="text" data-error=".errorTxt5">
                                            <label for="nombres">Nombres</label>
                                            <div id="error1" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>  
                                          <div class="input-field col s12 m6 l6">
                                                      <i class="material-icons prefix">date_range</i>
                                                      <input  class="datepicker" id="fNacimiento" name="fNacimiento" type="text" data-error=".errorTxt5">
                                                      <label for="fNacimiento">Fecha de Nacimiento</label>
                                                      <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div> 
                                          <div class="input-field col s12 m6 l6"  >
                                            <i class="material-icons prefix">room</i>
                                            <input id="direccion" name="direccion" type="text" >
                                            <label for="direccion">Dirección</label>
                                            <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div> 
                                        </div> 
                                      </div>
                        </div> 
                    </div> 
                    <div class="col s12 m12 l6"> 
                      <div class="card white">
                                  <div class="card-content">
                                    <span class="card-title">Datos Laborales</span>
                                    <div class="row"> 
                                      <div class="col s12 m6 l6">
                                        <label for="idempresa">Empresa</label>                 
                                        <select class="browser-default" id="idempresa" name="idempresa" required>
                                          <option value="" disabled  >Seleccione</option>
                                          @foreach($empresa as $datos)
                                          <option value="{{$datos->idempresa}}"> {{$datos->razon_social}}</option>
                                          @endforeach
                                        </select>
                                      <div id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                    </div> 
                                    <div class=" input col s12 m6 l6 left" > 
                                        <label for="zonas">ZONAS</label>
                                        <select class="browser-default" id="zonas" name="zonas" required>
                                          <option value="" disabled>Seleccione</option>
                                          @foreach($zonas as $fp)
                                          <option value="{{$fp->id }}"> {{$fp->nombre}}</option> 
                                          @endforeach
                                        </select> 
                                        <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div> 
                                      </div>   
                                      
                                        
                                    </div>
                                  </div>
                        </div>
                  
                    </div>
                    <div class="col s12 m12 l6"> 
                          <div class="card white">
                                      <div class="card-content">
                                        <span class="card-title">Contacto</span>
                                        <div class="row">     
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">email</i>
                                            <input id="correo" name="correo" type="email">
                                            <label for="correo">Email</label>
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
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">mode_edit</i>
                                            <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="400" style="height: 80px"></textarea>
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
<br><br>
@endsection

@section('script') 
@include('forms.tecnicos.scripts.addTecnico')

@endsection
