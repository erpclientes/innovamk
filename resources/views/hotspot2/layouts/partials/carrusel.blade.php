<div class="slider" style="position: relative; height: 300px">
      <ul class="slides" style="height: 300px">
        @foreach($carrusel as $datos)
        @if($datos->img_principal == 1)
        <li>
          <img src="{{asset('/')}}{{$datos->url_imagen}}">
          <!-- random image -->
          <div class="caption {{$datos->alineacion}}" style="padding-top: {{$datos->padding_top}}px">
            <h3>{{$datos->titulo}}</h3>
            <h5 class="light {{$datos->color}}">{{$datos->descripcion}}</h5>
            @if($datos->btn_estado == 1)
            <p><a href="{{ (empty($datos->btn_idprod))? '#' : $datos->idprod }}" class="btn btn-large waves-effect waves-light {{ (empty($datos->btn_color))? 'gradient-45deg-purple-amber' : $datos->btn_color }}"><b>Ingresar</b></a></p>
            @endif
          </div>
        </li>
        @endif
        @endforeach        
        
        @foreach($carrusel as $datos)
        @if($datos->img_principal != 1)
        <li>
          <img src="{{asset('/')}}{{$datos->url_imagen}}" style="background-size: 100% 100%">
          <!-- random image -->
          <div class="caption {{$datos->alineacion}}" style="padding-top: {{$datos->padding_top}}px">
            <h3>{{$datos->titulo}}</h3>
            <h5 class="light grey-text text-lighten-3">{{$datos->descripcion}}</h5>
            @if($datos->btn_estado == 1)
            @if(!empty($datos->btn_idprod) and $datos->btn_idprod !== '0000000000')
            <p><a href="{{url('/linea/mostrar')}}/{{$datos->btn_idprod}}" class="btn btn-large waves-effect waves-light {{ (empty($datos->btn_color))? 'gradient-45deg-purple-amber' : $datos->btn_color }}"><b>Ingresar</b></a></p>
            @else
            <p><a href="#" class="btn btn-large waves-effect waves-light {{ (empty($datos->btn_color))? 'gradient-45deg-purple-amber' : $datos->btn_color }}"><b>Ingresar</b></a></p>
            @endif
            @endif
          </div>
        </li>
        @endif
        @endforeach
       
      </ul>
    </div>
