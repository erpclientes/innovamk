@extends('layouts2.app')
@section('titulo','Importar/Exportar')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>IMPORT/EXPORT CLIENTES</h2>
                  </div>
                  
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="iPPPoE2" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Importar">
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px"></a>   
                         
                        </div>  

                        @include('forms.herramientas.pppoe.importar')   
                        @include('forms.herramientas.queues.importar')    
                        @include('forms.herramientas.pcq.importar')             
                        @include('forms.herramientas.hotspot.importar')             
                        
                  </div>
    <form id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">                              
    <div class="row cuerpo">
      <div class="col s12 m12 l12">
          <div class="card white">
            <div class="card-content">
              <div class="row">
                <div class="col s12 m4 l4">
                  <label for="idgrupo">Seleccionar Mikrotik</label>
                  <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" > 
                    <option value="" disabled="" selected="">Elija un router</option>
                    @foreach ($router as $valor)
                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                    @endforeach                                                     
                  </select>
                  <div id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                </div>
                <div class="col s12 m4 l4">
                  <label for="idgrupo">Tipo de Acceso</label>
                  <select class="browser-default" id="idtipo" name="idtipo" data-error=".errorTxt1" disabled> 
                    <option value="0" disabled="" selected="">Importar desde</option>
                  </select>
                  <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                </div>

                <div class="input-field col s12 m4 l4 left-align">
                  <blockquote style="margin: 0">Los usuarios a importar serán registrados siempre y cuando no exitan en la base de datos.</blockquote>
                </div> 
            </div>                     
          </div>
        </div>       
    </div>

      <div class="col s12">
        <div class="card white">
           
                    <div class="row" style="margin: 0.1rem 0.1rem">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                   
                        <div class="card-content" style="padding-top: 4px">                                               
                          <span class="card-title">Datos Generales</span>
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
                                    <input id="dia_pago" name="dia_pago" type="number" value="{{$dia_pago}}">
                                    <label for="dia_pago">Día de Pago</label>
                                    <div id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>

                                  <div class="col s12 m6 l6">
                                    <label for="moneda">Iniciar Aviso</label>
                                    <select class="browser-default" id="aviso" name="aviso" required>
                                      <option value="" disabled selected="">Seleccione</option>
                                      <option value="1">1 día antes</option>
                                      @for($i=2;$i<7;$i++)
                                        <option value="{{$i}}">{{$i}} días antes</option>                                       
                                      @endfor
                                    </select> 
                                    <div id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>
                                  <div class="col s12 m6 l6">
                                    <label for="moneda">Aplicar Corte</label>
                                    <select class="browser-default" id="corte" name="corte" required>
                                      <option value="" disabled selected="">Seleccione</option>
                                      <option value="1">1 día despues</option>
                                      @for($i=2;$i<7;$i++)
                                        <option value="{{$i}}">{{$i}} días despues</option>                                       
                                      @endfor
                                    </select> 
                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>
                                  <div class="col s12 m6 l6">
                                    <label for="moneda">Frecuencia de Corte</label>
                                    <select class="browser-default" id="frecuencia" name="frecuencia">
                                      <option value="" disabled selected="">Seleccione</option>
                                      <option value="1">mensual</option>
                                      @for($i=2;$i<7;$i++)
                                        <option value="{{$i}}">{{$i}} meses</option>                                       
                                      @endfor
                                    </select> 
                                    <div id="error6" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>
                                  <div class="col s12 m6 l6">
                                    <label for="moneda">Generar Comprobante</label>
                                    <select class="browser-default" id="fecha_factura" name="fecha_factura">
                                      <option value="" disabled selected="">Seleccione</option>
                                      @for($i=1;$i<29;$i++)
                                      @if($i == $dia_facturacion)
                                        <option value="{{$i}}" selected="">{{$i}} de cada mes</option>   
                                      @else
                                        <option value="{{$i}}">{{$i}} de cada mes</option>   
                                      @endif                                    
                                      @endfor
                                    </select> 
                                    <div id="error10" style="color: red; font-size: 12px; font-style: italic;"></div>
                                  </div>


                                             
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">mode_edit</i>
                                                  <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 120px;"></textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>            
                                              </div> 
                                            </div>
                                        </div>  
                </div>
        </div>

  	</div>

    </div>
   </form>            
             
  </div>
</div>

@endsection

@section('script')
  @include('forms.herramientas.scripts.importPPPoE')                           
  @include('forms.herramientas.scripts.importQUEUES')     
  @include('forms.herramientas.scripts.importPCQ')                           
  @include('forms.herramientas.scripts.importHotspot')                           
  @include('forms.herramientas.scripts.validaParametros')                           
@endsection
