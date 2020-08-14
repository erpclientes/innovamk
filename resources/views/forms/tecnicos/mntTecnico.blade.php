@extends('layouts2.app')
@section('titulo','Registro Tecnico')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card"  style="margin: auto; width: 91%">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRO DE TECNICOS</h2>
                  </div>
                  <form class="formValidate right-alert" id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="row card-header sub-header">
                          <div class="col s12 m12 herramienta">                         
                            <a id="updTecnicos" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped"  data-position="top" data-delay="500" data-tooltip="Guardar">
                              <i class="material-icons" style="color: #2E7D32">check</i></a>
                            <a style="margin-left: 6px"></a>   
                            <a href="{{url('/tecnicos')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                              <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                          </div>   
                          @include('forms.scripts.modalInformacion')  
                    </div> 
						  <br>
						  @foreach ($Tecnicos as $tecnico)
								
						  
                    <div class="col s12 m12 l6"> 
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idtecnico" value="{{ $tecnico->idtecnico }}">

                        <div class="card white">
                                      <div class="card-content">
                                        <span class="card-title">Datos Generales</span>
                                        <div class="row"> 
                                          <div class="col s12 m6 l6">
															<label for="iddocumento">Documento</label>
															@foreach($parametros as $val)
															@if($val->parametro == 'ADD_COD_INTERNO' and $val->valor == 'SI')
															  <select class="browser-default" id="iddocumento" name="iddocumento" required disabled> 
																 <option value="COD" disabled selected="">Código interno</option>                                  
															  </select>
															@elseif($val->parametro == 'ADD_COD_INTERNO' and $val->valor == 'NO')
															<select class="browser-default" id="iddocumento" name="iddocumento" required>
															  <option value="" disabled selected="">Seleccione</option>
															  @foreach($tipo_documento as $documento)
															  <option value="{{$documento->iddocumento}}" {{ $documento->iddocumento == $tecnico->iddocumento ? "selected" : "" }}>{{$documento->dsc_corta}} - {{$documento->descripcion}}</option>
															  @endforeach
															@endif
															@endforeach
															</select>
															<div class="errorTxt1"></div>
														 </div>                    
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix active">label_outline</i>
                                            <input id="nro_documento" value="{{ $tecnico->nro_documento }}" name="nro_documento" type="text" data-error=".errorTxt2" maxlength="20" onkeyup="mayus(this);">
                                            <label for="nro_documento">Nro. Documento</label>
                                            <div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>
                                          <div class=" col s12 m6 l6">
                                            <label for="sexo">Sexo</label>
                                            <select class="browser-default" id="sexo" name="sexo" required>  
															 @if ( $tecnico->sexo == '1')
                                <option value="1">FEMENINO</option> 
                                <option value="2">MASCULINO</option>
                                
															 @endif
															 @if ( $tecnico->sexo == "2")
															 <option value="2">MASCULINO</option>
															 <option value="1">FEMENINO</option> 
															 
															 @endif 
                                            </select>
                                            <div id="error5" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>        
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">perm_identity</i>
                                            <input id="apaterno" name="apaterno" type="text" value="{{ $tecnico->apaterno }}" data-error=".errorTxt3">
                                            <label for="apaterno">Apellido Paterno</label>
                                            <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">perm_identity</i>
                                            <input id="amaterno" name="amaterno" value="{{ $tecnico->amaterno }}" type="text" data-error=".errorTxt4">
                                            <label for="amaterno">Apellido Materno</label>
                                            <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>   
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">person</i>
                                            <input id="nombres" name="nombres" value="{{ $tecnico->nombre }}" type="text" data-error=".errorTxt5">
                                            <label for="nombres">Nombres</label>
                                            <div id="error1" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div>  
                                          <div class="input-field col s12 m6 l6">
                                                      <i class="material-icons prefix">date_range</i>
                                                      <input  class="datepicker" value="{{ $tecnico->fecha_nacimiento }}" id="fNacimiento" name="fNacimiento" type="text" data-error=".errorTxt5">
                                                      <label for="fNacimiento">Fecha de Nacimiento</label>
                                                      <div id="error" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                                          </div> 
                                          <div class="input-field col s12 m6 l6"  >
                                            <i class="material-icons prefix">room</i>
                                            <input id="direccion" value="{{ $tecnico->direccion }}"  name="direccion" type="text" >
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
														  <option value="" disabled selected="">Seleccione</option>
														  @foreach($empresa as $val)
														  @if($val->idempresa == $tecnico->idempresa)
															 <option value="{{$val->idempresa}}" selected> {{$val->razon_social}}</option>
														  @endif
														  @endforeach
														  @foreach($empresa as $val)
														  @if($val->idempresa != $tecnico->idempresa)
															 <option value="{{$val->idempresa}}"> {{$val->razon_social}}</option>
														  @endif
														  @endforeach
														</select>
														<div class="errorTxt1"></div>
												  </div> 
                                    <div class=" input col s12 m6 l6 left" > 
                                        <label for="zonas">ZONAS</label>
                                        <select class="browser-default" id="zonas" name="zonas" required>
                                          <option value="" disabled>Seleccione</option>
                                          
														@foreach($zonas  as $val)
														  @if($val->id == $tecnico->idZona)
															 <option value="{{$val->id}}" selected> {{$val->nombre}}</option>
														  @endif
														  @endforeach
														  @foreach($zonas as $val)
														  @if($val->id != $tecnico->idZona)
															 <option value="{{$val->id}}"> {{$val->nombre}}</option>
														  @endif
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
                                            <input id="correo" value="{{ $tecnico->correo }}"  name="correo" type="email">
                                            <label for="correo">Email</label>
                                          </div>                                
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">call</i>
                                            <input id="telefono1" value="{{ $tecnico->telefono }}" name="telefono1" type="text">
                                            <label for="telefono1">Telefono 1</label>
                                          </div>   
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">call</i>
                                            <input id="telefono2" value="{{ $tecnico->telefono2 }}" name="telefono2" type="text">
                                            <label for="telefono2">Telefono 2</label>
                                          </div>  
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">mode_edit</i>
                                            <textarea id="glosa"   name="glosa" class="materialize-textarea" lenght="400" style="height: 80px">{{ $tecnico->glosa }}</textarea>
                                            <label for="glosa" class="">Comentario</label>
                                          </div>
                                            
                                        </div>
                                      </div>
                            </div>
                      
						  </div> 
						  @endforeach
                  </form>
              </div>
  </div>
</div>
<br><br>
@endsection

@section('script') 
  @include('forms.tecnicos.scripts.updTecnico')



@endsection
