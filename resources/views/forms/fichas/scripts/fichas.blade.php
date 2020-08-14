<script type="text/javascript">
//-----------JPaiva--13-08-2019-------------------------------MOSTRAR PERFILES SEGUN ROUTER-------------------------------------------------------
    
    $('#idrouter').change(function(e){
      var val = $("select[name=idrouter]").val();

      $('#idperfil').removeAttr("disabled");
      $('#idperfil').empty();  
      $('#idperfil').append("<option value='n'>Seleccionar perfil</option>");   
      $("#idperfil option[value=n]").attr('disabled', true);

      @foreach($perfiles as $datos)
      if("{{$datos->idrouter}}" == val && "{{$datos->idtipo}}" == 'HST'){
        $('#idperfil').append("<option value='{{$datos->idperfil}}'>{{$datos->name}}</option>");
      }
      @endforeach

    });

    @foreach ($fichas as $val)
      $(document).on('click','#genFichas{{$val->idfichas}}', function(){
        $("#idficha").val($(this).data('id'));
      });      
    @endforeach

    $('#generar').click(function(e){

      idplantilla = $('#idplantilla').val();
      idficha = $('#idficha').val();
      
      window.open("{{url('/fichas/pdf')}}/"+idficha+"/"+idplantilla, '_blank');
    });

</script>