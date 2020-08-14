@extends('layouts2.app')
@section('titulo','Lista de Pagos Pendientes')

@section('main-content')
<br>
@foreach($plantilla as $plan)
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE PAGOS PENDIENTES</h2>
                  </div>

                
                  {{--  <video width=960 height=540 class="video-js vjs-default-skin" controls>
                    <source
                       src="https://storage.googleapis.com/brilliant-flame-242818.appspot.com/Copi/Chernobyl.xmdx.1x01.Latino.hd720.mp4"
                       >
                  </video>  --}}
                  

                  {{--  <video id=example-video width=960 height=540 class="video-js vjs-default-skin" controls>
                    <source
                       src="https://content-na.drive.amazonaws.com/cdproxy/share/Uh1j7gMGbZlHugAjtqrElIx1SM841wcXBJUxboR1ipr/nodes/aVwxwhO-SjyNfOIkHaSpnw?nonce=GfmlAeTh8s-l48VMN2-fVANKRhS6d97gZOi9z1_St1DZWpBQVqYC3B-q_lNI0Ctl"
                       >
                  </video>  --}}
                
                <form method="POST" action="{{ url('/editor/test') }}" accept-charset="UTF-8" enctype="multipart/form-data">  
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/empresa')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                
                    
                   
                  <div class="row cuerpo">
                    <div class="input-field col s12">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">         
                      <input type="hidden" name="idplantilla" value="COMPROBANTE_CLIENTE">         
                      <textarea id="descripcion" name="descripcion" class="materialize-textarea">{{$plan->descripcion}}</textarea>
                    
                    </div>
                  </div>
                </form>  

                  </div>
                </div>
              </div>
</div>
@endforeach

@endsection
@section('script')
  <script type="text/javascript">
    CKEDITOR.replace('descripcion');
  </script>
@endsection

