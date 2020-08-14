<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white" >
	@include('hotspot.layouts.partials.header')  

  @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

	
	<div class="contend">
   <div id="main" style="padding-left: 0px">
      <!-- START WRAPPER -->
      <div class="wrapper">
             <br>
         <section id="content center">
          <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                    <div class="card">
                            <div class="card-content center">
                              <form method="POST" action="{{ route('register') }}" style="padding: 5px">
                                <div class="row">
                                  <div class="input-field col s12 center">              
                                    <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px; margin-bottom: 5px">REGISTRO DE USUARIO</p>
                                    <div class="divider"></div>
                              <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
                                  </div>
                                </div>
                                
                                @csrf
                                <div class="row">
                                 
                                  <div class="input-field col s12">
                                    <i class="material-icons prefix">face</i>
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                                    @if ($errors->has('name'))
                                      <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                    @endif
                                    <label for="nombre" class="center-align">Nombre</label>
                                  </div>
                                  <div class="input-field col s12">
                                    <i class="material-icons prefix">person_outline</i>
                                    <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required>
                                    @if ($errors->has('usuario'))
                                      <span class="invalid-feedback">
                                        <strong>{{ $errors->first('usuario') }}</strong>
                                      </span>
                                    @endif
                                    <label for="usuario" class="center-align">Usuario</label>
                                  </div>
                                  <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                      <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                    @endif
                                    <label for="email" class="center-align">Email</label>
                                  </div>
                                  <div class="input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                      <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                    @endif
                                    <label for="password">Contraseña</label>
                                  </div>
                                  <div class="input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input id="password-again" type="password" name="password_confirmation" required>

                                    <label for="password-again">Repetir contraseña</label>
                                  </div>
                                  <div class="input-field col s12">
                                    <button type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px;background: #673ab7 !important;letter-spacing: .5px;">
                                      Registrar</button>
                                  </div>
                                  <div class="input-field col s12">
                                    <p class="margin center medium-small sign-up">Ya tienes una cuenta? <a href="{{ url('/login') }}">Ingresar</a></p>
                                  </div>
                                </div>
                              </form>
                            </div>
                            
                      </div>
            </div>
          </div>
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div> 
  </div>

      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  
      <script language="JavaScript">
	
	  </script>
</body>
</html>