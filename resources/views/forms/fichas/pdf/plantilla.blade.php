<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('plantilla/css/estilos.css') }}" />

        <title>InnovaTec | Plantila para tikects</title>

    </head>
    <body style="padding-right: 60px; padding-left: -30px;">
      <?php $cont = 3; ?>
      @foreach($plantilla as $datos)
      @foreach($fichas as $grupo)
      @foreach($dfichas as $ficha)
      @foreach($perfiles as $perfil)
      @if($cont == 3)
      <div class="row"> 
        <?php $cont = 0; ?>
      @endif
        @if($cont == 0)
        <div class="bs-example col-xs-4" data-example-id="panel-without-body-with-table" style="padding: 0; padding-left: 20px"> 
        @else
        <div class="bs-example col-xs-4" data-example-id="panel-without-body-with-table" style="padding: 0;"> 
        @endif      
        
            <div class="panel panel-default" style="border-radius: 0px; padding-bottom: 0; margin-bottom: 0; background-color: {{(!is_null($datos->cfondo_cuerpo))? $datos->cfondo_cuerpo : '#FFFFFF' }}; color: white; border-color: black"> 
              <div class="panel-heading text-center" style="padding-top: 5px; padding-bottom: 0px; background-color: {{(!is_null($datos->cfondo_cuerpo))? $datos->cfondo_cabecera : '#2196F3' }}; border-bottom: 0px solid; border-radius: 0px">
                <img src="{{asset('images/logo/maxcom.png')}}" alt="InnovaWifi" style=" height: 40px; width: auto;">
              </div> 
              <table class="" style="margin-top: 5px; border-top: 0px; width: 100%; color: black"> 
                <thead> 
                </thead> 
                <tbody> 
                  <tr> 
                    <td class="text-center" style="padding: 0px; width: 60%; text-align: center;">
                      <p style="margin-bottom: 2px; font-size: 12px">Código PIN:</p>
                      <h5 style="border: 1.5px solid black; margin-left: 5px; font-size: 20px; margin-top: 0px; padding-top: 5px; padding-bottom: 5px"><b></b>{{$ficha->usuario}}</h5>
                    </td> 
                    <td style="padding: 0px; width: 40%" class="text-center">
                      <h5 style="font-size: 22px"><b>{{$perfil->nalternativo}}</b></h5>
                    </td> 
                  </tr> 
                </tbody> 
              </table>
              <div class="text-center">
                <h4 style="font-size: 12px; margin: 4px; color: black;"><i style="border-left: 3px solid #BBDEFB; padding-left: 2px">CONECTAMOS SOÑADORES</i></h4>
              </div> 
              <div class="text-center" style="background-color: {{(!is_null($datos->cfondo_cuerpo))? $datos->cfondo_footer : '#1976D2' }}">
                <div style="padding: 2px"></div>
                <h3 style="margin: 0px; font-size: 18px"><b>$ {{$perfil->precio}}</b></h3>
                <div style="padding: 2px"></div>
              </div>
            </div> 
        </div>
        <?php $cont++; ?>
      @if($cont == 3)
      <?php $cont = 3; ?>
      </div>
      @endif
      @endforeach
      @endforeach
      @endforeach
      @endforeach
    </body>
</html>