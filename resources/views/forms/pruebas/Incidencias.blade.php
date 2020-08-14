@extends('layouts2.app')
@section('titulo','Registrar Empresa')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l8 offset-l2">
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
                          <a id="genLicencia" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Generar Licencia">
                            <i class="material-icons blue-text text-darken-2">code</i></a>
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/licencia')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row cuerpo">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="empresa" name="empresa" value="">
                    <input type="hidden" id="codigo2" name="codigo2" value="">
                    <input type="hidden" id="tipo" name="tipo" value="">
                    <input type="hidden" id="subtotal2" name="subtotal" value="">
                    <input type="hidden" id="total2" name="total" value="">
                                                         
                    <div class="col col s12">
                      <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title center">Gerador de Licencia</span>

                            <div class="row"> 
                              <div class="hide col s12 m6 l6">
                                <label for="iddocumento">Empresa</label>
                                <select class="browser-default" id="idempresa" name="idempresa" required>
                                  <option value="0" disabled>Seleccione</option>
                                 
                                </select>
                              </div>  
                              <div class="col s12 m6 l6">
                                <label for="idtipo">Tipo Liciencia</label>
                                <select class="browser-default" id="idtipo" name="idtipo" required>
                                  <option value="" disabled selected="">Seleccione</option>
                                  
                                </select>
                              </div>  
                              <div class="col s12 m6 l6">
                                <label for="iddocumento">Periodo</label>
                                <select class="browser-default" id="meses" name="meses" required disabled>
                                  <option value="" disabled selected="">Seleccione</option>
                                  <option value="1">1 mes</option>
                                  <option value="2">2 meses</option>
                                  <option value="3">3 meses</option>
                                  <option value="6">6 meses</option>
                                  <option value="12">1 año</option>
                                  <option value="24">2 años</option>
                                  <option value="36">3 años</option>
                                  <option value="60">5 años</option>
                                  <option value="120">10 años</option>
                                </select>
                              </div>  
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">local_atm</i>
                                <input id="precio" name="precio" type="text" disabled="" value="0">
                                <label for="precio">Precio Unitario</label>
                              </div>    
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">monetization_on</i>
                                <input id="subtotal" type="number" value="0" disabled> 
                                <label for="subtotal">Subtotal</label>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">local_offer</i>
                                <input id="descuento" name="descuento" type="number" value="0" disabled>
                                <label for="descuento">Descuento</label>
                              </div>                                
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">credit_card</i>
                                <input id="total" type="number" value="0" disabled> 
                                <label for="total">Total</label>
                              </div>    
                              <div class="input-field col s12">
                                <i class="material-icons prefix">subtitles</i>
                                <input id="codigo" name="codigo" type="text" disabled="" value=" " style="font-size: 20px; color: #e65100">
                                <label for="codigo">Licencia</label>
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
<br><br><br>
@endsection

