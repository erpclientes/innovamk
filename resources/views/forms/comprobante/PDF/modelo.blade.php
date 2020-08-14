@extends('layouts2.app')
@section('titulo','Plantilla Documento de Venta PDF')

@section('main-content')
<br>

<div class="row">
  <div class="col s12 m12 l10 offset-l1">
                <div class="card white">
                  <div class=" light-blue lighten-2" style="height: 120px">
                    <div class="row">
                      <div class="col s4">
                        <p>LOGO</p>
                      </div>
                      <div class="col s8">
                        <p>internet, radio y telecomunicaciones</p>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row" style="padding: 5px 25px 0 25px">
                    <div class="col s12 m6 l6">
                      <p>Cliente: <b>XXXXXXXX XXXXXXXXXX XXXXXXXX</b></p>
                      <p>Dirección: <b>XXXXXXXX XXXXXXXX</b></p>
                      <p>Telefono: <b>XXXXXXXX </b></p>
                      <p>Dcumento Indentidad: <b>CCC00006</b></p>
                      <p>Fecha expedicion: <b>XX/XX/XXXX</b></p>
                      <p>Número de Factura: <b>XX/XX/XXXX</b></p>
                    </div>
                    <div class="col s12 m6 l6">
                      <p>Cliente: <b>XXXXXXXX XXXXXXXXXX XXXXXXXX</b></p>
                      <p>Dirección: <b>XXXXXXXX XXXXXXXX</b></p>
                      <p>Telefono: <b>XXXXXXXX </b></p>
                      <p>Dcumento Indentidad: <b>CCC00006</b></p>
                      <p>Fecha expedicion: <b>XX/XX/XXXX</b></p>
                    </div>
                    <div class="col s12">
                      <p style="width: 100%" class="center green"><b>RESUMEN DE TU CUENTA</b></p>
                      <table id="tableHotspot" class="bordered responsive-table" cellspacing="0">
                        <thead class="grey">
                          <tr>
                            <th class="">Servicio de Internet</th>
                            <th class="center">Costo</th>
                          </tr>
                        </thead>
                        
                                                       
                        <tbody>
                          <tr>   
                            <td>Internet Dedicado Fibra Optica</td>   
                            <td style="text-align: center">S/ 580.00</td>                                                       
                          </tr>
                        </tbody>

                        <tfood>
                          <tr class="grey">
                            <th class="">Total a Pagar</th>
                            <th class="center">S/ 580.00</th>
                          </tr>
                        </tfood>
                      </table>

                    </div>
                    <br><br><br>
                    <div class="col 12">
                      <blockquote class=" blue lighten-5" style="padding-top:15px; padding-bottom: 15px; padding-right: 10px">Estimado cliente, pague oportunamente y evite la suspencion del servicio, cobro de reconexión por producto e intereses de mora: <b>El incupliemento de los pagos genera reporte a centrales de riesgo como morosos</b>. Si ya realizó el pago, haga caso omiso.</blockquote>
                    </div>
                  </div>
                

                <div style="height: 5rem"></div>
                </div>
                
  </div>
</div>
@endsection