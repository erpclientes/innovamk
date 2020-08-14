<div id="s_confirmacion5{{$valor->idservicio}}" class="modal" style="width: 500px">
    <div class="modal-content indigo white-text center">
    	<p>Se desactivará el aviso de pago del servicio de internet en pantalla del cliente.</p>
    </div>
    <div class="modal-footer indigo lighten-4">
	    <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
    	<a class="waves-effect waves-light btn-flat modal-action modal-close" id="de_notificacion{{$valor->idservicio}}" data-idservicio="{{$valor->idservicio}}">Aceptar</a>
    </div>
</div>