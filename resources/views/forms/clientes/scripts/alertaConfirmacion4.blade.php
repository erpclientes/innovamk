<div id="confirmacion4{{$datos->idcliente}}" class="modal" style="width: 500px">
                                    <div class="modal-content teal white-text">
                                      <p>Al ejecutar esta acción, el cliente será exonerado de realizar pagos por el servcio de internet. Ejecutar acción?</p>
                                    </div>
                                    <div class="modal-footer teal lighten-4">
                                      <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
                                      <a class="waves-effect waves-light btn-flat modal-action modal-close" id="exonerar{{$datos->idcliente}}" data-idcliente="{{$datos->idcliente}}">Aceptar</a>
                                    </div>
                                  </div>

