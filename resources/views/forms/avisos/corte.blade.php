@extends('layouts2.app')
@section('titulo','Mantenedor de Corte')

@section('main-content')
<br>
@foreach($corte as $datos)
<div class="row">
  <div class="col s12 m12 l8 offset-l2">

                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>Mantenedor de Corte</h2>
                  </div>
                 <form class="formValidate right-alert" id="myForm" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>   
                          <a href="{{ url('/vwCorte') }}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver prototipo página">
                            <i class="material-icons" style="color: #7986cb ">visibility</i>
                          </a> 
                          <a style="margin-left: 6px"></a>                          
                                                        
                        </div>  
                        @include('forms.scripts.modalInformacion')                               
                  </div>
                  
                  <br>                  
                  <div class="row cuerpo">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="id" value="{{ $datos->codigo }}">
                                   

                  <div class="col s12">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Información a mostrar</span>

                            <div class="row">
                              
                              <div class="input-field col s12">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="titulo" name="titulo" type="text" data-error=".errorTxt2" maxlength="200" value="{{$datos->titulo}}">
                                <label for="titulo">Título</label>
                                <div id="u_error1" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem;"></div>
                              </div>
                              <div class="input-field col s12">
                                <i class="material-icons prefix">mode_edit</i>
                                <textarea id="descripcion" name="descripcion" class="materialize-textarea" lenght="200" style="height: 200px">{{$datos->descripcion}}</textarea>
                                <label for="descripcion" class="">Descripción</label>
                                <div id="u_error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem;"></div>
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


<div id="comodin" data-valor="0" class="hiden"></div>

@endsection

@include('forms.scripts.toast')
  
@section('script')
  @include('forms.avisos.scripts.updCorte')
@endsection

