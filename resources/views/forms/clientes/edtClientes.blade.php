@extends('layouts.app')

@section('htmlheader_title')
  Registro de Clientes
@endsection

@section('main-content')
<br>
<div class="row">
  @foreach($clientes as $datos)
	<div class="col s12 m12 l12">
                <div class="card-panel-2">
                  <div class="row cabecera" style="margin-left: -0.85rem; margin-right: -0.85rem">                 
                    <div class="col s12 m12 l12">
                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar Cliente</b></h4>  
                    </div>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/clientes/actualizar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-left: -0.78rem; margin-right: -0.78rem">
                        <div class="col s12 m12 herramienta">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/clientes/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo"><i class="mdi-content-add" style="color: #03a9f4"></i></a>
                          <a href="#confirmacion" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar"><i class="mdi-content-remove" style="color: #dd2c00"></i></a>
                          <a style="margin-left: 6px"></a>   
                          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar"><i class="mdi-navigation-check" style="color: #2E7D32"></i></button>                          
                          <a style="margin-left: 6px"></a>                          
                          <a class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" href="#informacion" data-position="top" data-delay="500" data-tooltip="Ver Información del Formulario"><i class="mdi-action-info"></i></a>
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar"><i class="mdi-hardware-keyboard-tab" style="color: #546e7a "></i></a>          
                        </div> 
                        @include('forms.scripts.modalInformacion')
                        @include('forms.clientes.scripts.alertaConfirmacion2')         
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idcliente" value="{{ $datos->idcliente }}">

                      <div class="row">
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-maps-local-offer prefix active"></i>
                          <input id="documento" name="documento" type="text" data-error=".errorTxt1" maxlength="50" value="{{ $datos->documento }}">
                          <label for="documento">Tipo Documento</label>
                          <div class="errorTxt1"></div>
                        </div>   
                                        
                      </div>                     
                      <div class="row">
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-image-filter-tilt-shift prefix"></i>
                          <input id="apaterno" name="apaterno" type="text" data-error=".errorTxt3" value="{{ $datos->apaterno }}">
                          <label for="apaterno">Apellido Paterno</label>
                          <div class="errorTxt3"></div>
                        </div>
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-social-person prefix "></i>
                          <input id="amaterno" name="amaterno" type="text" data-error=".errorTxt4" value="{{ $datos->amaterno }}">
                          <label for="amaterno">Apellido Materno</label>
                          <div class="errorTxt4"></div>
                        </div>   
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-social-person prefix "></i>
                          <input id="nombres" name="nombres" type="text" data-error=".errorTxt5" value="{{ $datos->nombres }}">
                          <label for="nombres">Nombres</label>
                          <div class="errorTxt5"></div>
                        </div>                       
                      </div>
                      <div class="row">                         
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-social-person prefix "></i>
                          <input id="direccion" name="direccion" type="text" value="{{ $datos->direccion }}">
                          <label for="direccion">Dirección</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input id="correo" name="correo" type="text" value="{{ $datos->correo }}">
                          <label for="correo">Email</label>
                        </div>  
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-social-person prefix "></i>
                          <input id="contacto" name="contacto" type="text" value="{{ $datos->contacto }}">
                          <label for="contacto">Contacto</label>
                        </div>                                                   
                      </div>
                      <div class="row">                         
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-social-person prefix "></i>
                          <input id="telefono1" name="telefono1" type="text" value="{{ $datos->telefono1 }}">
                          <label for="telefono1">Telefono 1</label>
                        </div>   
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input id="telefono2" name="telefono2" type="text" value="{{ $datos->telefono2 }}">
                          <label for="telefono2">Telefono 2</label>
                        </div>  
                        <div class="input-field col s12 m4 l4">
                          <i class="mdi-editor-mode-edit prefix"></i>
                          <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" value="">{{ $datos->glosa }}</textarea>
                          <label for="glosa" class="">Comentario</label>
                        </div>            
                      </div>

                      <div class="col s12 m12 l12"  style="padding-left: 0; padding-right: 0">
                        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                          <li class="">
                            <div class="collapsible-header light-blue light-blue-text text-lighten-5 active"><i class="mdi-communication-business"></i> Datos por Defecto para Doc. Venta</div>
                            <div class="collapsible-body light-blue lighten-5" style="display: none">
                              <div class="row cuerpo-2">
                                <div class="row">
                                  <div class="input-field col s12 m6 l6">
                                    <i class="mdi-maps-local-offer prefix active"></i>
                                    <input id="forma_pago" name="forma_pago" type="text" value="{{ $datos->forma_pago }}">
                                    <label for="forma_pago">Forma de Pago</label>
                                  </div>   
                                  <div class="input-field col s12 m6 l6">
                                    <i class="mdi-maps-local-offer prefix active"></i>
                                    <input id="doc_venta" name="doc_venta" type="text" value="{{ $datos->doc_venta }}">
                                    <label for="doc_venta">Tipo Documento</label>
                                  </div>                        
                                </div> 
                                <div class="row">
                                  <div class="input-field col s12 m6 l6">
                                    <i class="mdi-maps-local-offer prefix active"></i>
                                    <input id="moneda" name="moneda" type="text" value="{{ $datos->moneda }}">
                                    <label for="moneda">Moneda</label>
                                  </div>   
                                  <div class="hide input-field col s12 m6 l6">
                                    <i class="mdi-maps-local-offer prefix active"></i>
                                    <input id="dia_pago" name="dia_pago" type="number" value="{{ $datos->dia_pago }}">
                                    <label for="dia_pago">Día de Pago</label>
                                  </div>                        
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
  @endforeach
</div>
<br><br>
@endsection

@section('script')
  <script type="text/javascript" src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">
    $("#formValidate").validate({
      rules: {
        documento: {
          required: true
        },
        nro_documento: {
            required: true,
            minlength: 8,
            maxlenght: 11
        },
        apaterno: {
          required: true          
        },
        amaterno: {
          required: true          
        },
        nombres: {
          required: true          
        }
      },
        //For custom messages
        messages: {
            documento: {
              required: "Ingrese un tipo de documento",
              minlength: "Ingresar 3 caracteres como mínimo"
            },
            nro_documento:{
                required: "Ingrese el Nro. de Documento",
                minlength: "Ingresar 8 caracteres como mínimo"
            },
            apaterno: {
              required: "Ingrese el apellido paterno"
            }, 
            amaterno: {
              required: "Ingrese el apellido materno"
            }, 
            nomnbres: {
              required: "Ingrese el nombre"
            },       
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
   
  </script>
@endsection
