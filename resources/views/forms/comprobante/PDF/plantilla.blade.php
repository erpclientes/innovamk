<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>InnovaTec | Comprobante de Pago</title>

    </head>
    <body>
        @foreach($empresa as $emp)
            <div class="row" style="background-color: white; height: 60px">
                      <div class="col-xs-4">
                        <img src="{{asset('/')}}{{$emp->url_imagen}}" alt="Smiley face" width="250">
                      </div>
                      <div class="col-xs-8 pull-right">
                        <p class="pull-right" style="padding-top: 43px; margin-bottom: 0px">{{$emp->marca}}</p>
                      </div>
                    </div>
            <hr style="margin-top: 5px">
        @endforeach
      
        <div class="container">
          @foreach($cliente as $clie)
          @foreach($factura as $fac)
          @foreach($notificaciones as $date)
          @foreach($empresa as $emp)
            <div class="row">
                <div class="col-xs-6">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <b>Cliente:</b> {{$clie->nombres." ".$clie->apaterno." ".$clie->amaterno}}
                      </li>
                      <li class="list-group-item">
                        <b>Dirección:</b> {{$clie->direccion}}
                      </li>
                      
                      <li class="list-group-item">
                        <b>Fecha Emisión:</b> {{ date_format(date_create($fac->fecha_emision),'d/m/Y') }}
                      </li>
                      <li class="list-group-item">
                        <b>Comprobante Pago:</b> {{$fac->dsc_corta." ".$fac->serie." ".$fac->numero}}
                      </li>
                    </ul>
                     
                </div>

                <div class="col-xs-5">
                
                    @if($fac->idestado == "EM")  
                    <div class="alert alert-danger" role="alert" style="text-align: center; margin-bottom: 5px; padding-bottom: 5px; padding-top: 5px"><b>Estado: PENDIENTE DE PAGO</b></div>                          
                    @elseif($fac->idestado == "PA") 
                      <div class="alert alert-success" role="alert" style="text-align: center; margin-bottom: 8px; padding-bottom: 5px; padding-top: 5px"><b>Estado: PAGADO</b></div>
                    @endif
                    <ul class="list-group">                     
                      <li class="list-group-item">
                        <b>Fecha Prox. Factura:</b> {{ date_format(date_create($date->fecha_facturacion),'d/m/Y') }}
                      </li>
                      
                      <li class="list-group-item">
                        <b>Numero para Pagos:</b> {{$emp->telefono}}
                      </li>
                      <li class="list-group-item">
                        <b>Fecha Limite Pago:</b> {{ date_format(date_create($fac->fecha_vencimiento),'d/m/Y') }}
                      </li>
                    </ul>
                     
                </div>                
            </div>
          @endforeach
          @endforeach
          @endforeach
          @endforeach
           
            <div class="row">                
                <div class="col-xs-12">
                    <div class="well well-sm" style="text-align: center;background-color: #e8eaf6"><b>RESUMEN DE TU CUENTA</div>
                    
                	<table class="table table-hover table-striped">
                        <thead style="background-color: e0e0e0 ">
                            <tr>
                                <th>Servicio de Internet</th>
                                <th style="text-align: center;">Costo</th>
                            </tr>                            
                        </thead>
                        <tbody>
                              @foreach($factura as $fac)
                                <tr style="background-color: white">
                                  <td>
                                    <h5><b>Servicio de Internet de Banda Ancha</b></h5>  
                                    <h5><b>Periodio:</b> desde <b>{{$fac->fecha_inicio}}</b> hasta <b>{{$fac->fecha_fin}}</b></h5>
                                    <h5><b>Fecha corte: {{$fac->fecha_corte}}</b></h5>
                                    <h5><b>Plan de Internet: </b>{{$fac->perfil}}</h5>
                                    <h5>Descarga: <b>{{$fac->vbajada}}</b></h5>
                                    <h5>Subida: <b>{{$fac->vsubida}}</b></h5>
                                  </td>
                                  <td style="text-align: center;">S/ {{$fac->costo_servicio}}</td>
                                </tr>
                                @foreach($dfactura as $dfac)
                                @if(!is_null($dfac->idproducto))
                                <tr>
                                  <td>{{$dfac->descripcion}}</td>
                                  <td style="text-align: center;">S/ {{$dfac->precio}}</td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                  <td style="text-align: right;"><b>Total a Pagar</b></td>
                                  <td style="text-align: center;"><b>S/ {{$fac->total}}</b></td>
                                </tr>
                              @endforeach  
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br>

            <footer>
              <div class="row">
                <div class="col-xs-12">
                      <blockquote style="font-size: 13px; padding-top:15px; padding-bottom: 15px; padding-right: 10px; background-color: #e3f2fd; border-left: 5px solid #64b5f6;">Estimado cliente, pague oportunamente y evite la suspencion del servicio, cobro de reconexión por producto e intereses de mora: <b>El incupliemento de los pagos genera reporte a centrales de riesgo como morosos</b>. Si ya realizó el pago, haga caso omiso.</blockquote>
                    </div>
              </div>                          
            </footer>
            
        </div>
    </body>
</html>