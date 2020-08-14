<div id="s_confirmacion2{{$valor->idservicio}}" class="modal" style="width: 500px">
    <div class="modal-content indigo white-text center">
    	<p>Se desabilitará el servicio y el usuario registrado en el Mikrotik. Está seguro que desea desabilitar este servicio?</p>
    </div>
    <div class="modal-footer indigo lighten-4">
	    <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
    	<a class="waves-effect waves-light btn-flat modal-action modal-close" id="dservicio{{$valor->idservicio}}" data-iddesabilitar="{{$valor->idservicio}}">Aceptar</a>
    </div>
</div>