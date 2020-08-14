<script type="text/javascript">
  @foreach($comprobantes as $comp)
  $("#vwFac{{$comp->codigo}}").click(function(e){
//console.log("prondaboansdscdsd2345y6ufl");
    var fecha_vencimiento = null;
    var fecha_corte = null;
    var fecha_inicio = null;
    var fecha_fin = null;
    var importe = null;
    var perfil = null;
    var vsubida = null;
    var vbajada = null;
    var codigo = $(this).data('codigo');
    
    @foreach($notificaciones as $val)
      @if($val->aviso >0)                
        fecha_vencimiento = '{{ date_format(date_create($val->fecha_pago),'d/m/Y') }}';   
        fecha_corte = '{{ date_format(date_create($val->fecha_corte),'d/m/Y') }}';  
        fecha_inicio = '{{ date_format(date_create($val->fecha_inicio),'d/m/Y') }}';  
        fecha_fin = '{{ date_format(date_create($val->fecha_fin),'d/m/Y') }}';  

        $('#fecha_vencimiento').val(fecha_vencimiento);
        $('#fecha_emision').val(fecha_corte);
      @endif
    @endforeach   
   
    @foreach($servicio as $val)
      importe = '{{ $val->precio }}'; 

      @foreach ($perfiles as $valor)
        @if($valor->idperfil == $val->perfil_internet)
          perfil = '{{$valor->name}}';
          vsubida = '{{$valor->vsubida}}';
          vbajada = '{{$valor->vbajada}}';
        @endif
      @endforeach

      $('#precio_unitario{{$comp->codigo}}').val({{$comp->subtotal}});
      $('#descripcion{{$comp->codigo}}').css('height','130px');
      $('#descripcion{{$comp->codigo}}').text('Servicio de Internet Banda ancha \n Periodo: desde '+fecha_inicio +' hasta '+fecha_fin+' \n Fecha de corte: '+fecha_corte+' \n Plan de Internet: '+perfil+' \n Descarga: '+vbajada+' \n Subida: '+ vsubida);
    @endforeach

    $('#detPrincipal{{$comp->codigo}}').hide();
    @foreach($dfactura as $dfac)
    @if(!is_null($dfac->idservicio) and $dfac->idfactura == $comp->codigo)
      $('#detPrincipal{{$comp->codigo}}').show();
    @endif

    @if(!is_null($dfac->idproducto) and $dfac->idfactura == $comp->codigo)
    
      descripcion = "{{$dfac->descripcion}}";
      total = '{{$dfac->total}}';
    
        $("#detFac{{$comp->codigo}}").append("<div class='input-field col s12 m6 l8'>"+
            "<i class='material-icons prefix'>mode_edit</i>"+                                             
            "<input type='text' disabled='' value='"+descripcion+"' style='margin-bottom: 0px'>"+
          "</div>"+     
          "<div class='input-field col s12 m6 l4'>"+
            "<i class='material-icons prefix'>attach_money</i>"+
            "<input type='text' disabled='' value='"+total+"' style='margin-bottom: 0px'>"+
          "</div>");            
    @endif  

    @if(!is_null($dfac->idconcepto) and $dfac->idfactura == $comp->codigo)
    
      descripcion = "{{$dfac->descripcion}}";
      total = '{{$dfac->total}}';
    
        $("#detFac{{$comp->codigo}}").append("<div class='input-field col s12 m6 l8'>"+
            "<i class='material-icons prefix'>mode_edit</i>"+                                             
            "<input type='text' disabled='' value='"+descripcion+"' style='margin-bottom: 0px'>"+
          "</div>"+     
          "<div class='input-field col s12 m6 l4'>"+
            "<i class='material-icons prefix'>attach_money</i>"+
            "<input type='text' disabled='' value='"+total+"' style='margin-bottom: 0px'>"+
          "</div>");            
    @endif
    @endforeach

    $('#subtotal').val(importe);
    $('#descuento').val('0');
    $('#subtotal_neto').val(importe);
    $('#impuesto').val('0');
    $('#total').val(importe);    

  });
@endforeach
</script>