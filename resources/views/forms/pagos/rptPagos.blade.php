@extends('layouts2.app2')
@section('titulo','Reporte de pagos')

@section('main-content')
<div style="margin-top: 8px"></div>
<div class="row">
  
  <div class="col s12 m12 l12">
                <?php 
                      $bandera = false;

                      if (count($facturas) > 0) {
                        $bandera = true;
                        $i = 0;
                      }
                ?>
                <form id="frmReport"  action="{{ url('/reportePagos') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2><b>REPORTE DE PAGOS |</b> <i style="color: #3f51b5">Existen <?php echo ($bandera)? count($facturas) : 0; ?> registros.</i></h2>
                  </div>
                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <button id="execReport" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Nuevo" type="submit">
                            <i class="material-icons" style="color: #03a9f4">add</i></button>
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/clientes/exportExcel') }}" data-position="top" data-delay="500" data-tooltip="Descargar excel">
                            <i class="material-icons" style="color: black">vertical_align_bottom</i></a>
                        </div>  
                        
                  </div>
                                    
                  <div class="row cuerpo">
                    
                  
                  <div class="row">
                    <div class="col s12">
                      <br>
                      
                        <div class="row">                                                
                                <div class="col s12 m6 l3">
                                  <label for="idrouter">Router Mikrotik</label>
                                  <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" > 
                                    <option value="" disabled="" selected="">Elija un router</option>
                                    @foreach ($router as $valor)
                                    <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                    @endforeach
                                  </select>
                                  <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                </div>
                                <div class="col s12 m6 l3">
                                  <label for="idrouter">Forma de pago</label>
                                  <select class="browser-default" id="idforma_pago" name="idforma_pago" data-error=".errorTxt1" > 
                                    <option value="" disabled="" selected="">Elija una forma</option>
                                    @foreach ($formaPago as $valor)
                                    <option value="{{ $valor->idforma_pago }}">{{ $valor->descripcion }}</option>
                                    @endforeach
                                  </select>
                                  <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                </div>
                                <div class="input-field col s12 m6 l3">
                                    <i class="material-icons  prefix">event</i>
                                    <input class="datepicker" id="from" name="from" type="text" data-error=".errorTxt2" required>
                                    <label for="from">Fecha inicio</label>
                                    <div id="p_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                </div>     
                                <div class="input-field col s12 m6 l3">
                                    <i class="material-icons  prefix">event</i>
                                    <input class="datepicker" id="to" name="to" type="text" data-error=".errorTxt2" required>
                                    <label for="to">Fecha fin</label>
                                    <div id="p_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                </div>                                                 
                              </div> 
                      </form>
                    </div>
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th class="center">#</th>
                                     <th>Cliente</th>
                                     <th class="center">Fecha Pago</th>
                                     <th>Servicio</th>
                                     <th class="center">Precio</th>
                                     <th>Documento</th>
                                     <th class="center">Fecha que Pagó</th>
                                     <th class="center" style="width: 70px">Estado</th>
                                     <th class="center hide">Acción</th>
                                  </tr>
                               </thead>
                               <tfoot>
                                  <tr>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th class="">TOTAL:</th>
                                     <th>{{number_format($total,2)}}</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                  </tr>
                                </tfoot>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($facturas as $datos) {
                                      $i++;
                                   ?>
                                     <td class="center">{{$i}}</td>
                                     <td>{{$datos->razon_social}}</td>
                                     <td class="center">{{$datos->fecha_pago}}</td>
                                     <td>{{$datos->name}}</td>
                                     <td class="center">{{$datos->precio}}</td>
                                     <td>{{$datos->dsc_corta.' '.$datos->serie.'-'.$datos->numero}}</td>
                                     <td class="center">{{$datos->fecha_pagado}}</td>
                                     <td class="center">
                                      @if($datos->idestado == 'AN')
                                        <span class="badge grey darken-2 white-text text-accent-5">ANULADO</span>
                                      @elseIF($datos->idestado == 'PA')
                                        <span class="badge green lighten-5 green-text text-accent-4">PAGADO</span>                                        
                                      @endif
                                     </td>
                                     <td class="center hide">
                                       <a href="{{ url('/cliente/') }}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>
                                     </td>
                                  </tr>
                                    
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>
                    
                  </div>

                  </div>
                </div>
              </div>
            </div>
</div>
<br><br>

@endsection
@section('script')
  <script type="text/javascript">
    $(".datepicker").datepicker({
       autoclose: true,
       format: "dd/mm/yyyy"
    });
  </script>
  @include('forms.pagos.scripts.reporte')

@endsection
@include('forms.scripts.toast')
