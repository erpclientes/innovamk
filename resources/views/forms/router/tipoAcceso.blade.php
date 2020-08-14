<div class="row">
<br>
  @foreach($router as $rou)
  <div class="col s12 m7 l5 offset-l1">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>TIPOS DE ACCESO</h2>
                  </div>
                
                <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                          <a id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>                          
                          <a style="margin-left: 6px"></a>                          
                          
                          <a href="{{url('/router')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #546e7a">keyboard_tab</i>
                          </a>          
                        </div> 
                        @include('forms.scripts.modalInformacion')
                        @include('forms.scripts.alertaConfirmacion2')         
                  </div>
                  
                  <form method="POST" action="{{ url('tipo/guardar') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="grey lighten-5">
                    <div class="row cuerpo-2">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                      
                      
                    @foreach($tipo as $datos)
                      <div class="card white">
                          <div class="card-content" style="padding-top: 4px">
                            <div class="row" style="padding-top: 20px">
                              <div class="col s6 m8 l10">
                                <p style="padding: 0px">{{$datos->descripcion}}</p>

                              </div>
                              <div class="col s6 m4 l2">
                                <div class="switch secondary-content">                     
                                  <label>                              
                                    <input type="checkbox" id="{{$datos->idtipo}}" name="{{$datos->idtipo}}" <?php echo ($datos->estado == 0)? 'df' : 'checked' ?> >
                                    <span class="lever"></span> 
                                  </label>
                                </div>
                              </div>
                            </div>
                                                                   
                          </div>
                      </div>  
                    @endforeach    

                    </div>
                  </form>               
                </div>
  </div>

              
 <div class="col s12 m5 l3 offset-l2">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>SISTEMA</h2>
                  </div>
                
                  
                  <div class="row cuerpo-2">                     
                    <div class="input-field col s12 m12 l12">
                      <a id="reiniciar" class="waves-effect waves-light btn-large light-green darken-4" style="width: 100%">Reiniciar</a>
                    </div>                      
                    <div class="input-field col s12 m12 l12">
                      <a id="apagar" class="waves-effect waves-light btn-large red darken-4" style="width: 100%">Apagar</a>                            
                    </div>           
                  </div>
               
                </div>
              </div>

  @endforeach
</div>




<br><br>