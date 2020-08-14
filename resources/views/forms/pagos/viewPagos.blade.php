@extends('layouts2.app')
@section('titulo','Lista de Pagos Pendientes')
@section('main-content')
<br>
<div id="app-5">
  @foreach($factura as $datos)
  <div class="row" >
    <div class="col s12 m12 l12">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-table fa-lg material-icons">receipt</i>
          <h2>REGISTRAR PAGOS</h2>
        </div>
        <div class="row card-header sub-header">
          <div class="col s12 m12">
            @if($datos->idestado != "PA")
            <a href="#addConfirmacion" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Registrar pago">
            <i class="material-icons blue-text text-darken-2">check</i></a>
            @endif
            @if($datos->idestado == "PV")
            <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" href="#addPago"  data-position="top" data-delay="500" data-tooltip="Verificar Boucher">
              <i class="material-icons" style="color: #03a9f4">add</i>
            </a>
            @endif
            <a style="margin-left: 6px"></a>
            <a href="{{url('/descargarPDF')}}/{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF">
            <i class="material-icons grey-text text-darken-2">vertical_align_bottom</i></a>
            <a href="{{url('/pagos')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>
          </div>
        </div>   
        @include('forms.pagos.addPago')
        @include('forms.pagos.scripts.alertaConfirmacion')  
        <form class="formValidate right-alert" id="frmPago" accept-charset="UTF-8" enctype="multipart/form-data">   
        <div class="row">
    <br>      
          <div class="col s12 m12 l12">
            <div class="card white" style="margin-left: 15px; margin-right: 15px">
                                            <div class="card-content">
                                                <div class="row">
                                                 
                                                  <div class="col s12 m6 l5">
                                                    <label for="doc_venta2">Documento de Venta</label>
                                                    <select class="browser-default" id="doc_venta2" name="doc_venta2" disabled="">
                                                      <option value="" disabled>Seleccione</option>
                                                      @foreach($doc_venta as $val)
                                                      @if($datos->iddocumento == $val->iddocumento)
                                                      <option value="" selected="">{{$val->descripcion.': '.$datos->serie.'-'.$datos->numero.' - Servicio de Internet'}}</option>
                                                      @endif
                                                      @endforeach
                                                    </select>                                                    
                                                  </div>   
                                                  
                                                  <div class="input-field col s12 m6 l2">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_emision" name="fecha_emision" type="text" data-error=".errorTxt2" placeholder="{{ date_format(date_create($datos->fecha_emision),'d/m/Y') }}" disabled="">
                                                    <label for="fecha_emision">Fecha Emisión</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      

                                                  <div class="input-field col s12 m6 l2">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_vencimiento" name="fecha_vencimiento" type="text" data-error=".errorTxt2" placeholder="{{ date_format(date_create($datos->fecha_vencimiento),'d/m/Y') }}" disabled="">
                                                    <label for="fecha_vencimiento">Fecha Venc.</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>  
                                                  @if($datos->idestado == "EM")    
                                                  <div class="input-field col s12 s12 m6 l3 right-align">
                                                    <div class="chip center-align red lighten-1 white-text" style="width: 100%">
                                                      <b>Estado: PENDIENTE DE PAGO</b>
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                  @elseif($datos->idestado == "PA")    
                                                  <div class="input-field col s12 s12 m6 l3 right-align">
                                                    <div class="chip center-align green lighten-1 white-text" style="width: 100%">
                                                      <b>Estado: PAGADO</b>
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                  @elseif($datos->idestado == "PV")    
                                                  <div class="input-field col s12 s12 m6 l3 right-align">
                                                    <div class="chip center-align amber accent-2 white-text" style="width: 100%">
                                                      <b>estado: VERIFICAR PAGO</b>
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                  @endif
                                                </div>                     
                                            </div>
            </div>  

            <div class="col s12 m6 l7">
            <div class="card white" style="padding-bottom: 30px">
              <div class="card-content">
                <span class="card-title">Datos Doc. Venta</span>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idfactura" value="{{ $datos->codigo }}">
                @foreach($cliente as $val)
                <div class="col s12">                  
                  @foreach($documento as $doc)
                  @if($doc->iddocumento == $val->iddocumento)
                  <div class="input-field col s12">
                    <i class="material-icons prefix">person</i>
                    <input id="cliente" name="cliente" type="text" placeholder="{{$doc->dsc_corta.': '.$val->nro_documento.' - '.$val->nombres.' '.$val->amaterno.' '.$val->apaterno}}" disabled="">
                    <label for="cliente">Cliente</label>
                    <div style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>    
                  @endif
                  @endforeach       
                </div>
                <div class="col s12 m6 l6">
                  <div class="col s12">
                    <label for="idrouter">Forma de pago</label>
                    <select class="browser-default" id="" name="" data-error=".errorTxt1" disabled="">
                      <option value="" disabled="" selected="">Elija forma de Pago</option>
                      @foreach($forma_pagos as $fp)
                      @if($fp->idforma_pago == $val->forma_pago)
                        <option value="{{$fp->idforma_pago}}" selected="">{{$fp->descripcion}}</option>
                      @endif
                      @endforeach
                    </select>
                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>

                  
                  <div class="col s12">
                    <label for="idrouter">Comprobante de pago</label>
                    <select class="browser-default" id="" name="" data-error=".errorTxt1" disabled="">
                      <option value="" disabled="" selected="">Elija Tipo de Pago</option>
                      @foreach($doc_venta as $doc)
                      @if($datos->iddocumento == $doc->iddocumento)
                        <option value="" selected="">{{$doc->descripcion}}</option>
                      @endif
                      @endforeach
                    </select>
                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>
                  <div class="col s12">
                    <label for="moneda">Moneda</label>
                    <select class="browser-default" id="moneda" name="moneda" required disabled="">
                      <option value="" disabled>Seleccione</option>
                      @foreach($moneda as $m)
                      @if($m->idmoneda == $val->moneda)
                      <option value="{{$m->idmoneda}}" selected>{{$m->descripcion}} - {{$m->dsc_corta}}</option>
                      @endif
                      @endforeach
                    </select> 
                  </div>  
                </div>
                  
                <div class="col s12 m6 l6">
                  @foreach($dfactura as $dfac)
                  @if(!is_null($dfac->idservicio))
                  <div class="col s12">
                    <label for="idrouter">Plan del servicio</label>
                    <select class="browser-default" id="" name="" data-error=".errorTxt1" disabled="">
                      <option value="" disabled="" selected="">Elija forma de Pago</option>
                      @foreach($servicio as $serv)
                      @foreach($perfiles as $perfil)
                      @if($serv->perfil_internet == $perfil->idperfil)
                        <option value="{{$fp->idforma_pago}}" selected="">{{$perfil->name}}</option>
                      @endif
                      @endforeach
                      @endforeach
                    </select>
                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>
                  @endif
                  @endforeach
                  <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="descripcion" name="descripcion" class="materialize-textarea" rows="6" lenght="200" maxlength="200" style="height: 6rem;" {{ ($datos->idestado == 'EM')? ''  : 'disabled' }}>{{$datos->glosa}}</textarea>
                    <label for="descripcion" class="">Glosa</label>
                  </div>
                </div>
                @endforeach
                                                      
            </div>
                        
            </div> 
            </div>   

            <div class="col s12 m6 l5">
              <div class="card">
                <div class="card-content">
                  <span class="card-title">Detalle</span>
                  <input type="hidden" name="subtotal" id="subtotal" value="{{$datos->subtotal}}">
                  <div class="row" id="principal" style="margin-bottom: 0px"> 
                    <div class="input-field col s12 m8 l10">
                      <i class="material-icons prefix">mode_edit</i>
                      <textarea id="descripcion5" name="descripcion5" class="materialize-textarea" rows="6" lenght="200" maxlength="200" style="height: 6rem;" disabled="">{{$datos->detalle}} </textarea>
                      <label for="descripcion" class="">Descripción</label>
                    </div>  
                    <div class="input-field col s12 m4 l2">
                      <input type="text" id="precio_unitario" data-error=".errorTxt5" disabled="" value=" " style="margin-bottom: 0px">
                      <label for="precio_unitario">Importe</label>
                      <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                    </div>                                             
                  </div> 
                  
                  <div class="row" id="detFac" style="margin-bottom: 0px"> 
                                                            
                  </div> 
                  <br>           
                  <div class="input-field col s12  m6 l6">                    
                    <input id="subtotal2" name="subtotal2" type="text" maxlength="40" value="{{$datos->subtotal}}" disabled="">
                    <label for="subtotal">Subtotal</label>
                    <div style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>  
                  @foreach($parametros as $val) 
                  @if($val->parametro == "EDIT_DESCUENTO") 
                  <div class="input-field col s12  m6 l6">                    
                    <input id="descuento" name="descuento" type="text" maxlength="40" value="{{$datos->descuento}}" {{($val->valor == "NO")? 'disabled' : ($datos->idestado == 'EM')? ''  : 'disabled'}} >
                    <label for="transaccion">Descuento</label>
                    <div style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>  
                  @endif 
                  @endforeach 
                  <div class="input-field col s12  m6 l6">                    
                    <input id="impuesto" name="impuesto" type="text" maxlength="40" value="{{$datos->impuesto}}" disabled="">
                    <label for="transaccion">Impuesto (%)</label>
                    <div style="color: red; font-size: 12px; font-style: italic;"></div>
                  </div>    
                  <div class="input-field col s12  m6 l6">                    
                    <input id="total" name="total" type="text" maxlength="40" value="{{$datos->total}}" disabled="">
                    <label for="transaccion">Total</label>
                    <div style="color: red; font-size: 12px; font-style: italic;"></div>
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
  @endforeach
</div>

@endsection

@section('script')
  @include('forms.pagos.scripts.pago')
  @include('forms.pagos.scripts.addPago')
  @include('forms.pagos.scripts.validacion')
  @include('forms.pagos.scripts.aceptar')
  @include('forms.pagos.scripts.rechazar')
@endsection