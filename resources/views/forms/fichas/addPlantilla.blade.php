@extends('layouts2.app')
@section('titulo','Agregar Plantilla')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m8 l6 offset-m2 offset-l3">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>AGREGAR PLANTILLA</h2>
                  </div>
                  <form id="myForm" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="addPlantilla" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
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
                                  <div class="input-field col s12">
                                   <div id="estado" class="chip center-align teal accent-4 white-text col s12 m6 l5 offset-m6 offset-l7">
                                      ESTADO:<b> ACTIVO</b>
                                      <i class="material-icons"></i>
                                    </div>
                                  </div>
                                  <div class="input-field col s12 m6 l7">                                  
                                      <p>Seleccione el diseño de la plantilla a usar</p>                                  
                                  </div>                                      
                                  <div class="col s12 m6 l5">
                                      <label for="idmodelo">Diseño</label>
                                      <select id="iddiseno" class="browser-default" name="iddiseno" data-error=".errorTxt1"> 
                                        <option value="" disabled="">Seleccionar</option>                                                                      
                                          <option value="1" selected="">DEFAULT</option>                                                              
                                      </select> 
                                  </div>                                        
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Ingrese una descripción para esta plantilla</p>                                  
                                  </div>  
                                  <div class="col s12 m6 l5">
                                    <label for="color">Descripción</label>
                                    <input id="descripcion" name="descripcion"  type="text" value="" data-error=".errorTxt2" maxlength="100">
                                  </div>
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Definir el tamaño del texto para el precio</p>                                  
                                  </div>
                                  <div class="col s12 m6 l5">
                                    <label for="idmodelo">Tamaño píxeles</label>
                                    <p class="range-field">
                                      <input type="range" name="size_precio" id="size_precio" min="10" max="30" value="14" class="active"><span class="thumb"><span class="value"></span></span>
                                    </p>
                                  </div>      
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Definir el color de fondo para la cabecera</p>                                  
                                  </div>  
                                  <div class="col s12 m6 l5">
                                    <label for="color">Color fondo cabecera</label>
                                    <input id="cfondo_cabecera" name="cfondo_cabecera"  type="text" value="" data-error=".errorTxt2" maxlength="100">
                                  </div>      
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Definir el color de fondo para el cuerpo</p>                                  
                                  </div>  
                                  <div class="col s12 m6 l5">
                                    <label for="color">Color fondo cuerpo</label>
                                    <input id="cfondo_cuerpo" name="cfondo_cuerpo"  type="text" value="" data-error=".errorTxt2" maxlength="100">
                                  </div>      
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Definir el color de fondo para el pie de pagina</p>                                  
                                  </div>  
                                  <div class="col s12 m6 l5">
                                    <label for="color">Color fondo footer</label>
                                    <input id="cfondo_footer" name="cfondo_footer"  type="text" value="" data-error=".errorTxt2" maxlength="100">
                                  </div>      
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Ingrese una descripción para el texto 01</p>                                  
                                  </div>  
                                  <div class="col s12 m6 l5">
                                    <label for="color">Descripción texto 01</label>
                                    <input id="texto1" name="texto1"  type="text" value="" data-error=".errorTxt2" maxlength="100">
                                  </div>      
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Ingrese una descripción para el texto 02</p>                                  
                                  </div>  
                                  <div class="col s12 m6 l5">
                                    <label for="color">Descripción texto 02</label>
                                    <input id="texto2" name="texto2" type="text" value="" data-error=".errorTxt2" maxlength="100">
                                  </div> 
                                  <div class="input-field col s12 m6 l7">                                  
                                    <p>Definir el tamaño del texto 02</p>                                  
                                  </div>
                                  <div class="col s12 m6 l5">
                                    <label for="idmodelo">Tamaño píxeles</label>
                                    <p class="range-field">
                                      <input id="size_texto2" name="size_texto2" type="range" name="padding_top" min="10" max="30" value="14" class="active"><span class="thumb"><span class="value"></span></span>
                                    </p>
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

@section('script')
  @include('forms.fichas.scripts.addPlantilla')  
@endsection
