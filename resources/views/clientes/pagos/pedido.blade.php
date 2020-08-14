@extends('layouts2.app')
@section('titulo','Detalle Compra')

@section('main-content')
<br>
@foreach($pagos as $datos)
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>DETALLE DE COMPRA</h2>
                  </div>
                 
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" href="#addPago"  data-position="top" data-delay="500" data-tooltip="Agregar Boucher">
                            <i class="material-icons" style="color: #03a9f4">add</i>
                          </a>
                          <a style="margin-left: 6px"></a>                          
                                                        
                        </div>  
                        @include('forms.pagos.addPago')         
                        @include('forms.scripts.modalInformacion')         
                  </div>
                          <br>
                <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                            <div class="row" style="margin-bottom: 0px">
                              <div class="input-field col s12 m6 l3">
                                
                                <input id="fecha" name="fecha" type="text" value="{{$datos->fecha}}" disabled="">
                                <label for="fecha">Fecha Emisión</label>
                                <div class="errorTxt1"></div>
                              </div>   
                              <div class="input-field col s12 m6 l3">
                                
                                <input id="descuento" name="descuento" type="text" value="{{$datos->descuento}}" disabled="">
                                <label for="descuento">Descuento</label>
                                <div class="errorTxt1"></div>
                              </div>   
                              <div class="input-field col s12 m6 l3">
                                
                                <input id="total" name="total" type="text" value="$ {{$datos->total}}" disabled="">
                                <label for="total">Total</label>
                                <div class="errorTxt1"></div>
                              </div>   
                              
                              <div class="input-field col s12 m6 l3">
                                @if($datos->estado == 'PE')
                                        <div id="u_estado" class="chip center-align" style="width: 100%">
                                            <b>PENDIENTE DE PAGO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                      @if($datos->estado == 'PV')
                                        <div id="u_estado2" class="chip center-align orange accent-1 white-text" style="width: 100%">
                                          <b>VERIFICANDO PAGO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                @if($datos->estado == 'PA')
                                        <div id="u_estado" class="chip indigo lighten-2 white-text center" style="width: 100%">
                                            <b>PENDIENTE DE ENTREGA</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                              </div>
                              
                            </div>
                        </div>
                    </div>

                    <div class="card white">
                        <div class="card-content">
                            <div class="row" style="margin-bottom: 0px">
                              <div class="input-field col s12">
                                  <i class="material-icons prefix">mode_edit</i>
                                  <textarea disabled="" id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" value="" style="height: 84px">{{$datos->descripcion_transportista}}</textarea>
                                  <label for="glosa" class="">Datos del Transportista</label>
                              </div>                               
                              
                            </div>
                        </div>
                    </div>

                    @if(!empty($datos->observacion))
                    <div class="card white">
                        <div class="card-content">
                            <div class="row" style="margin-bottom: 0px">
                              <div class="input-field col s12">
                                  <i class="material-icons prefix">mode_edit</i>
                                  <textarea disabled="" id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" value="" style="height: 84px">{{$datos->observacion}}</textarea>
                                  <label for="glosa" class="">Obvervación</label>
                              </div>                               
                              
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Detalle</span>

                            <div class="row cuerpo">
                            <?php 

                              $bandera = false;

                              if (count($dpagos) > 0) {
                                # code...
                                $bandera = true;
                                $i = 0;
                              }

                            ?>
                         
                            <div class="col s12 m12 l12">
                              
                                <div class="card-content">
                                  Existen <?php echo ($bandera)? count($dpagos) : 0; ?> registros. <br><br>
                                  <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                       <thead>
                                          <tr class="center">
                                             <th>#</th>
                                             <th>Producto</th>
                                             <th>Dsc. Producto</th>
                                             <th>Cantidad</th>
                                             <th>Precio Unit.</th>
                                             <th>Total</th>
                                          </tr>
                                       </thead>
                                       <?php
                                            if($bandera){                                                           
                                        ?>
                                       <tfoot>
                                          <tr>
                                             <th>#</th>
                                             <th>Producto</th>
                                             <th>Dsc. Producto</th>
                                             <th>Cantidad</th>
                                             <th>Precio Unit.</th>
                                             <th>Total</th>
                                          </tr>
                                        </tfoot>

                                       <tbody>
                                        <tr>
                                          <?php 
                                              foreach ($dpagos as $val) {
                                              $i++;
                                           ?>                           
                                             <td><?php echo $val->item ?></td>
                                             <td><?php echo $val->idproducto ?></td>
                                             @foreach($productos as $prod)
                                             @if($prod->codigo == $val->idproducto)
                                              <td><?php echo $prod->descripcion ?></td>
                                             @endif
                                             @endforeach
                                             <td class="center"><?php echo $val->cantidad ?></td>
                                             <td class="center">$ <?php echo $val->precio ?></td>
                                             <td class="center"><b>$ <?php echo $val->total ?></b></td>
                                             
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
  </div>
</div>
@endforeach

@endsection

@section('script')
  @include('forms.pagos.scripts.addPago')
@endsection

