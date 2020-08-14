<div class="row">
<br>
  @foreach($router as $rou)
  <div class="col s12 m7 l8">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>DATOS MIKROTIK</h2>
                  </div>
                <form method="POST" id="myForm" class="formValidate right-alert" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/nuevo-router') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i>
                          </a>
                          <a href="#confirmacion" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                            <i class="material-icons " style="color: #dd2c00">remove</i>
                          </a>
                          <a style="margin-left: 6px"></a>   
                          <a id="updRouter" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>                          
                          <a style="margin-left: 6px"></a>                          
                          
                          <a href="{{url('/router')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #546e7a">keyboard_tab</i>
                          </a>          
                        </div> 
                        
                        @include('forms.scripts.alertaConfirmacion2')         
                  </div>
                  
                  <div class="row cuerpo-2">                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idrouter" value="{{ $rou->idrouter }}">
                      <div class="row">
                        <div class="input-field col s12 s12 m6 l6">
                          <i class="material-icons prefix active">label_outline</i>
                          <input type="text"  maxlength="3" value="{!! $rou->idrouter !!}" disabled>
                          <label for="idrouter">Código Router</label>
                        </div>
                        <div class="input-field col s12 m12 l6">
                          <i class="material-icons prefix">local_offer</i>
                          <input id="alias" name="alias" type="text" value="{!! $rou->alias !!}">
                          <label for="alias" class="">Alias del Router</label>
                          <div id="error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                        </div>  
                        <div class="input-field col s12 m12 l6">
                          <i class="material-icons prefix">filter_tilt_shift</i>
                          <input id="ip" name="ip" type="text" value="{!! $rou->ip !!}">
                          <label for="ip">Dirección IP</label>
                          <div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                        </div>    
                        <div class="input-field col s12 m12 l6">
                          <i class="material-icons prefix ">person</i>
                          <input id="usuario" name="usuario" type="text" value="{!! $rou->usuario !!}">
                          <label for="usuario">Usuario Api Mikrotik</label>
                          <div id="error4" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                        </div>
                        <div class="input-field col s12 m12 l6">
                          <i class="material-icons prefix">lock_outline</i>
                          <input id="password" name="password" type="password" value="{!! $rou->password !!}">
                          <label for="password">Contraseña</label>
                          <div id="error5" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
                        </div>    
                        <div class="input-field col s12 m12 l6">
                          <i class="material-icons prefix">settings_ethernet</i>
                          <input id="puerto" name="puerto" type="text" placeholder="Puerto Api Opcional" value="{!! $rou->puerto !!}">
                          <label for="puerto">Puerto Api</label>
                        </div>
                      </div>   
                    </div>
                     </form>
                </div>
              </div>

              
  
  <div class="col s12 m5 l4">
                <div class="card">
                <div class="card-header" style="margin-left: -0.05px;margin-right: -0.05px;background-color: #29b6f6; height: 60px ">
                  <i class="material-icons left" style="color: white; font-size: 25px; margin-top: 6px">info_outline</i>
                      <h4 class="header2" style="margin: 12px 0px; font-size: 16px; color: white"><b>Características</b></h4>  
                </div>
                  
                  <div class="row cuerpo">
                    <form method="POST" action="{{ url('router/guardar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
                    @include('forms.scripts.apiMikrotik')
                        
                    </form>
                  </div>
                </div>
              </div>
  @endforeach
</div>

@section('script')
  @include('forms.router.scripts.updRouter')
  @include('forms.router.scripts.reiniciar')
  @include('forms.router.scripts.apagar')
  <script type="text/javascript">
     //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();
      console.log("entroo..");

      @foreach($tipo as $val)
        val = 0;

        if ($('#{{$val->idtipo}}').is(':checked')){
          val = 1;          
        }
        console.log(val);

        $.ajax({
            url: "{{ url('/tipo/actualizar/estado') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/tipo/actualizar/estado') }}",
           data:{
              idtipo:'{{$val->idtipo}}',
              estado:val
           },

           success:function(data){
              

           },
           error:function(){ 
              alert("error!!!!");
        }
        });
  
      @endforeach

      setTimeout(function() {
        M.toast({ html: '<span>Registro actualizado</span>'});
      }, 2000);  

    });
  </script>

@endsection



<br><br>