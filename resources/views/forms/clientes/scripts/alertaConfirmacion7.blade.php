<div id="confirmacion7{{$datos->idservicio}}" class="modal" style="width: 500px">
                                    <div class="modal-content teal white-text">
                                      <p>Al ejecutar esta acción, el cliente será restablecido como activo. Ejecutar acción?</p>
                                    </div>
                                    <div class="modal-footer teal lighten-4">
                                      <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
                                      <a class="waves-effect waves-light btn-flat modal-action modal-close" id="restablecer{{$datos->idservicio}}" data-idservicio="{{$datos->idservicio}}">Aceptar</a>
                                    </div>
                                  </div>

