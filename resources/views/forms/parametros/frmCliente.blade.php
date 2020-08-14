@extends('layouts2.app')
@section('titulo','Parámetros')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m8 l6 offset-m2 offset-l3">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>PARÁMETROS DEL SISTEMA</h2>
                  </div>
                  <form id="myForm" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="updCliente" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>    
                          <a style="margin-left: 6px"></a>   
                                    
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    <div class="col s12 ">
                      
                    
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="card white">
                          <div class="card-content">
                              <span class="card-title">Generales</span>
                              <div class="row">
                                @if(count($parametros) > 0)
                                @foreach($parametros as $val)                                  
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>{{$val->descripcion}}</p>                                  
                                  </div>  
                                  
                                  @if($val->campo_texto == 1)
                                  <div class="col s12 m6 l4">
                                    <label for="color">Ingresar dato</label>
                                    <input id="{{$val->parametro}}" name="{{$val->parametro}}" type="text" value="{{$val->valor_long}}" data-error=".errorTxt2" maxlength="100">                                    
                                  </div> 
                                  @elseif($val->campo_texto == 2)
                                    @if($val->parametro == 'ADD_FREC_CORTE')
                                    <div class="col s12 m6 l4">
                                      <label for="color">Frecuencia de corte</label>
                                      <select class="browser-default" id="{{$val->parametro}}" name="{{$val->parametro}}"> 
                                        @if($val->valor_long == 0)
                                          <option value="0" selected="">Desabilitado</option>
                                        @else
                                          <option value="0">Desabilitado</option>
                                        @endif
                                        @if($val->valor_long == 1)
                                          <option value="1" selected="">mensual</option>
                                        @else
                                          <option value="1">mensual</option>
                                        @endif                                 
                                        
                                        @for($i=2;$i<7;$i++)
                                          @if($val->valor_long == $i)
                                            <option value="{{$i}}" selected="">{{$i}} meses</option>
                                          @else
                                            <option value="{{$i}}">{{$i}} meses</option>
                                          @endif
                                        @endfor
                                      </select>                                  
                                    </div> 
                                    @endif
                                    @if($val->parametro == 'ADD_INICIO_AVISO')
                                    <div class="col s12 m6 l4">
                                      <label for="color">Iniciar aviso</label>
                                      <select class="browser-default" id="{{$val->parametro}}" name="{{$val->parametro}}"> 
                                        @if($val->valor_long == 0)
                                          <option value="0" selected="">Desabilitado</option>
                                        @else
                                          <option value="0">Desabilitado</option>
                                        @endif
                                        @if($val->valor_long == 1)
                                          <option value="1" selected="">1 día antes</option>
                                        @else
                                          <option value="1">1 día antes</option>
                                        @endif                                 
                                        
                                        @for($i=2;$i<7;$i++)
                                          @if($val->valor_long == $i)
                                            <option value="{{$i}}" selected="">{{$i}} días antes</option>
                                          @else
                                            <option value="{{$i}}">{{$i}} días antes</option>
                                          @endif
                                        @endfor
                                      </select>          
                                    </div> 
                                    @endif
                                    @if($val->parametro == 'ADD_APLICAR_CORTE')
                                    <div class="col s12 m6 l4">
                                      <label for="color">Aplicar corte</label>
                                      <select class="browser-default" id="{{$val->parametro}}" name="{{$val->parametro}}"> 
                                         @if($val->valor_long == 0)
                                          <option value="0" selected="">Desabilitado</option>
                                        @else
                                          <option value="0">Desabilitado</option>
                                        @endif
                                        @if($val->valor_long == 1)
                                          <option value="1" selected="">1 día despues</option>
                                        @else
                                          <option value="1">1 día despues</option>
                                        @endif                                 
                                        
                                        @for($i=2;$i<7;$i++)
                                          @if($val->valor_long == $i)
                                            <option value="{{$i}}" selected="">{{$i}} días despues</option>
                                          @else
                                            <option value="{{$i}}">{{$i}} días despues</option>
                                          @endif
                                        @endfor
                                      </select>
                                    </div> 
                                    @endif
                                  @else
                                  <div class="col s12 m6 l4">
                                    <label for="idmodelo">Registro</label>
                                    <select id="{{$val->parametro}}" class="browser-default" name="{{$val->parametro}}" data-error=".errorTxt1"> 
                                      <option value="" disabled="">Habilitar</option>
                                      @if($val->valor == 'SI')
                                        <option value="SI" selected="">SI</option>
                                        <option value="NO">NO</option>
                                      @else if($val->valor == 'NO')
                                        <option value="SI">SI</option>
                                        <option value="NO" selected="">NO</option>
                                      @endif
                                    </select>                                  
                                  </div> 
                                  @endif

                                @endforeach        
                                @endif                        
                              </div>

                          </div>
                      </div>
                    </div>
                      
                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br><br>
@endsection

@section('script')
  @include('forms.parametros.scripts.addParametros')
  @include('forms.parametros.scripts.validacion')
@endsection
