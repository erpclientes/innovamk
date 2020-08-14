@extends('layouts2.app')
@section('titulo','Importar/Exportar')

@section('main-content')
<br>
 <div class="row cuerpo">
      

      <div class="col s12 m6 l6 offset-m3 offset-l3">
                <div class="card"> 
                  <div class="card-header indigo lighten-5">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>IMPORT/EXPORT CLIENTES</h2>
                  </div>
               
                  <form class="formValidate right-alert" id="frmClientes" accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="row cuerpo" style="margin-top: 1rem; margin-bottom: 0.5rem">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                      
                      
                      <div class="card white">
                          <div class="card-content">
                            <div class="row" style="padding-bottom: 0px; margin-bottom: 0px">
                              <div class="col s12 m12 l12" style="padding-bottom: 10px">
                                <p>Ingrese un archivo en excel para realizar la importación</p>
                              </div>
                              <div class="col s12">
                                <div class="file-field input-field col s12 ">                                  
                                    <div class="btn light-blue darken-1">
                                      <span>File</span>
                                      <input type="file" id="inputClientes" name="inputClientes">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input class="file-path validate" type="text" name="clientesXLS" id="clientesXLS">
                                      <p class="right"><i>Solo se permiten archivos con extensión XLS y XLSX</i></p>
                                      <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                    </div>
                                  
                                </div>                    
                              </div>
                              <div class="col s12 mt-2 mb-2">                                
                                <a class="waves-effect waves-light btn right indigo darken-2" id="importClientes">
                                  <i class="material-icons left">file_upload</i> Importar
                                </a>                               
                              </div>
                            </div>                              
                          </div>
                      </div>   
                    </div>
                  </form>       


                </div>
     </div>


    </div>

@endsection

@include('forms.scripts.toast')

@section('script')
  @include('forms.clientes.herramientas.scripts.importExport')
@endsection
