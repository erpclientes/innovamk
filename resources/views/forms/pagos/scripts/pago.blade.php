<script type="text/javascript">
  $(document).ready(function(){
    
    @foreach($servicio as $val)
          
      var fecha_vencimiento = null;
    var fecha_corte = null;
    var fecha_inicio = null;
    var fecha_fin = null;
    var importe = null;
    var perfil = null;
    var vsubida = null;
    var vbajada = null;
    var fecha_emision = null;
    var descripcion = null;
          
   
    @foreach($servicio as $val)
      importe = '{{ $val->precio }}'; 
      $('#precio_unitario').val(importe);    
    @endforeach

    $('#principal').hide();
    @foreach($dfactura as $dfac)
    @if(!is_null($dfac->idservicio))
      $('#principal').show();
    @endif

    @if(!is_null($dfac->idproducto))
    console.log("entroooooaefsgf");
      descripcion = "{{$dfac->descripcion}}";
      total = '{{$dfac->total}}';
    
        $("#detFac").append("<div class='input-field col s12 m8 l10'>"+
            "<i class='material-icons prefix'>mode_edit</i>"+                                             
            "<input type='text' disabled='' value='"+descripcion+"' style='margin-bottom: 0px'>"+
          "</div>"+     
          "<div class='input-field col s12 m4 l2'>"+
            "<input type='text' disabled='' value='"+total+"' style='margin-bottom: 0px'>"+
          "</div>");            
    @endif  
    @endforeach
    @endforeach
    
  });

  $("#descuento").blur(function() {
    var subtotal = $("#subtotal").val();
    var descuento = $("#descuento").val() * 1;
    var subtotal_neto = 0;
    var impuesto = $("#impuesto").val();
    var total = 0;
console.log(subtotal);
    if(descuento >= subtotal){
      $("#descuento").val(0);
      $("#descuento").focus();

      setTimeout(function() {
        M.toast({ html: '<span>El descuento debe ser menor que el subtotal.</span>'});
      }, 2000); 
    }else if(descuento < 0){
      $("#descuento").val(0);
      $("#descuento").focus();

      setTimeout(function() {
        M.toast({ html: '<span>El descuento debe ser mayor que cero.</span>'});
      }, 2000); 
    }else{
      subtotal_neto = subtotal - descuento;
      total = subtotal_neto*(1+impuesto/100);

      $("#subtotal_neto").val(subtotal_neto);    
      $("#total").val(total);
    }    
  });

</script>