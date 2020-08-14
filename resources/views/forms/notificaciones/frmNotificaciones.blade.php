<div class="row cuerpo">
<br>

@if(count($notificaciones) > 0)
@foreach($notificaciones as $val)
  
  <div class="col s12 m7 l5 offset-l3 offset-m2">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>TIPOS DE ACCIONES</h2>
                  </div>
                
                <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="nn_update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar cambios">
                            <i class="material-icons" style="color: #2E7D32">check</i></a>
                         
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>     
                        </div> 
                          
                  </div>
                  
                  <form method="POST" enctype="multipart/form-data" class="grey lighten-5">
                    <div class="row cuerpo-2">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">       
                    <input type="hidden" name="codigo" value="{{ $val->codigo }}">  
                    @foreach($servicio as $serv)
                      <input type="hidden" name="dia_pago" value="{{ $serv->dia_pago }}">                      
                    @endforeach                    
                                          
                      <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p style="padding-top: 15px" class="right-align">
                                  <i class="material-icons">credit_card</i>  
                                  Iniciar Aviso</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="aviso" name="aviso"> 
                                  @if($val->aviso == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif
                                  @if($val->aviso == 1)
                                    <option value="1" selected="">1 día antes</option>
                                  @else
                                    <option value="1">1 día antes</option>
                                  @endif                                 
                                  
                                  @for($i=2;$i<7;$i++)
                                    @if($val->aviso == $i)
                                      <option value="{{$i}}" selected="">{{$i}} días antes</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} días antes</option>
                                    @endif
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                      <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p class="right-align" style="padding-top: 15px">
                                  <i class="material-icons">credit_card</i>  
                                  Aplicar Corte</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="corte" name="corte"> 
                                  @if($val->corte == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif
                                  @if($val->corte == 1)
                                    <option value="1" selected="">1 día antes</option>
                                  @else
                                    <option value="1">1 día despues</option>
                                  @endif                                 
                                  
                                  @for($i=2;$i<7;$i++)
                                    @if($val->corte == $i)
                                      <option value="{{$i}}" selected="">{{$i}} días despues</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} días despues</option>
                                    @endif
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                      <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p style="padding-top: 15px" class="right-align">
                                  <i class="material-icons">credit_card</i>  
                                  Frecuencia de corte</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="frecuencia" name="frecuencia"> 
                                  @if($val->frecuencia == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif
                                  @if($val->frecuencia == 1)
                                    <option value="1" selected="">mensual</option>
                                  @else
                                    <option value="1">mensual</option>
                                  @endif                                 
                                  
                                  @for($i=2;$i<7;$i++)
                                    @if($val->frecuencia == $i)
                                      <option value="{{$i}}" selected="">{{$i}} meses</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} meses</option>
                                    @endif
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                       <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p style="padding-top: 15px" class="right-align">
                                  <i class="material-icons">credit_card</i>  
                                  Iniciar Facturación</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="facturacion" name="facturacion"> 
                                  @if($val->facturacion == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif                                  
                                  @for($i=1;$i<29;$i++)
                                    @if($val->facturacion == $i)
                                      <option value="{{$i}}" selected>{{$i}} de cada mes</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} de cada mes</option>
                                    @endif
                                    
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                    </div>   
                  </form> 
    </div>
  </div> 
@endforeach
@else
  <h5 class="center-align">No Existe registro de servicio</h5>    
@endif
</div>


@section('script') 
  
  @include('forms.servicio.scripts.hNotificacion')
  @include('forms.servicio.scripts.dNotificacion')


<script type="text/javascript">
    //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#nn_update').click(function(e){
      e.preventDefault();   

      $.ajax({
            url: "{{ url('/notificaciones/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/notificaciones/actualizar') }}",
           data:{
              codigo:$("input[name=codigo]").val(), 
              aviso:$("select[name=aviso]").val(),
              corte:$("select[name=corte]").val(),
              frecuencia:$("select[name=frecuencia]").val(),
              dia_pago:$("input[name=dia_pago]").val(),
              facturacion:$("select[name=facturacion]").val()
           },

           success:function(data){
             
              setTimeout(function() {
                  M.toast({ html: '<span>Registro actualizado</span>'});
                }, 2000);  

              setTimeout("redireccionarPagina()",4000);
           },
           error:function(){ 
              alert("error!!!!");
        }
        });


    });  

    function redireccionarPagina() {
      window.location = "{{ url('/cliente') }}/{{$idcliente}}";
    } 
   
</script>
@endsection



<br><br>