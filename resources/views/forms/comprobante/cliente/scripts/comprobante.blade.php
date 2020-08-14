<script type="text/javascript">
  $(document).ready(function(){
    @foreach($clientes as $val)
      var idcpago = "{{$val->doc_venta}}";
      
      @foreach($tipo_documento_venta as $datos)
        @if($datos->iddocumento == $val->doc_venta)
          $('#serie').val("{{$datos->serie.'-'.$datos->correlativo}}");    
        @endif
      @endforeach      
    @endforeach
  });

  $('#doc_venta2').change(function(e){
      val = $('#doc_venta2').val();
      
      @foreach($tipo_documento_venta as $datos)
      if ({{$datos->iddocumento}} == val) {
        $('#serie').val("{{$datos->serie.'-'.$datos->correlativo}}");    
      }
      @endforeach
    });

  $("#fecha_emision").blur(function(){
    
    var parts =$("#fecha_emision").val().split('/');
    fecha_vencimiento = new Date(parts[2], parts[1], parts[0]);    
    fecha_vencimiento.setDate(fecha_vencimiento.getDate() + parseInt("{{$dia_fecha_venc}}"));

    var d = String(fecha_vencimiento.getDate());
    var m = String(fecha_vencimiento.getMonth());
    var y = fecha_vencimiento.getFullYear();
    
    $('#fecha_vencimiento').val(d.padStart(2,"0")+"/"+m.padStart(2,"0")+"/"+y);
  });

  $("#descuento").blur(function() {
    var subtotal = $("#subtotal").val();
    var descuento = $("#descuento").val() * 1;
    var subtotal_neto = 0;
    var impuesto = $("#impuesto").val();
    var total = 0;

    if(descuento >= subtotal){
      $("#descuento").val(0);
      $("#descuento").focus();

      setTimeout(function() {
        M.toast({ html : '<span>El descuento debe ser menor que el subtotal.</span>'});
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

  $("#precio_unitario").blur(function() {
    var subtotal = $("#precio_unitario").val() * 1;
    var descuento = $("#descuento").val();
    var subtotal_neto = 0;
    var impuesto = $("#impuesto").val();
    var total = 0;

    if(subtotal <= 0){
      $("#precio_unitario").val(0);
      $("#precio_unitario").focus();

      setTimeout(function() {
        M.toast({ html: '<span>El importe deber ser mayor a cero.</span>'});
      }, 2000); 
    }else{
      subtotal_neto = subtotal - descuento;
      total = subtotal_neto*(1+impuesto/100);

      $("#subtotal").val(subtotal);
      $("#subtotal_neto").val(subtotal_neto);    
      $("#total").val(total);

    }    
  });


  $("#fecha_inicio2").blur(function() {
    $('#fecha_inicio').val($("#fecha_inicio2").val());
    getComprobante();
  });

  $("#fecha_fin2").blur(function() {
    $('#fecha_fin').val($("#fecha_fin2").val());
    getComprobante();
  });


  $("#compAdd").click(function(e){

    @foreach($parametros as $parametro)
      @if($parametro->parametro == 'ADD_FAC_RANGOFECHA' and $parametro->valor == 'SI')
        getComprobante();
        $('#addComprobante').modal('open');  
        @break
      @else
        @if(count($comprobantes) > 0)
          setTimeout(function() {
            M.toast({ html: '<span>Existen comprobantes Pendientes de Pago.</span>'});
          }, 2000); 
          @break
        @else
          getComprobante();
          $('#addComprobante').modal('open');  
          @break
        @endif
      @endif
    @endforeach

    
  });

  function getComprobante(){    
    
    var fecha_inicio2 = $("#fecha_inicio2").val();
    var fecha_fin2 = $("#fecha_fin2").val();
    var fecha_vencimiento = null;
    var fecha_corte = null;
    var fecha_inicio = null;
    var fecha_fin = null;
    var importe = null;
    var perfil = null;
    var vsubida = null;
    var vbajada = null;
    var fecha_emision = null;
    
    @foreach($notificaciones as $val)
   // console.log($val);
    
      @if($val->aviso >0)                
        fecha_vencimiento = "{{ date('d/m/Y', strtotime ( '+'.$dia_fecha_venc.' day' , strtotime ( date('Y-m-j') ) )) }}";   
        fecha_corte = '{{ date_format(date_create($val->fecha_corte),'d/m/Y') }}';  

        if (fecha_fin2.length > 0) {
          fecha_fin = fecha_fin2;  
        }else{
          fecha_fin = '{{ date_format(date_create($val->fecha_fin),'d/m/Y') }}';  
        }

        if (fecha_inicio2.length > 0) {
          fecha_inicio = fecha_inicio2;  
        }else{
          fecha_inicio = '{{ date_format(date_create($val->fecha_inicio),'d/m/Y') }}';  
        }

        $('#fecha_vencimiento').val(fecha_vencimiento);
        $('#fecha_emision').val('{{date('d/m/Y')}}');
      @endif
    @endforeach   
   
    @foreach($servicio as $val)
   // console.log($val);
      importe = '{{ $val->precio }}'; 
      

      @foreach ($perfiles as $valor)
     //// console.log($valor);
        @if($valor->idperfil == $val->perfil_internet) 
          perfil = '{{$valor->name}}';
          vsubida = '{{$valor->vsubida}}';
          vbajada = '{{$valor->vbajada}}';

        @endif
      @endforeach
     // console.log(perfil,vsubida,vbajada);
      

      $('#precio_unitario').val(importe);
      $('#descripcion').css('height','130px');

        $('#descripcion').text('Servicio de Internet Banda ancha \n Periodo: desde '+fecha_inicio +' hasta '+fecha_fin+' \n Fecha de corte: '+fecha_corte+' \n Plan de Internet: '+perfil+' \n Descarga: '+vbajada+' \n Subida: '+ vsubida); 
 
    @endforeach

    $('#subtotal').val(importe);
    $('#descuento').val('0');
    $('#subtotal_neto').val(importe);
    $('#impuesto').val('0');
    $('#total').val(importe);    

    $('#fecha_inicio').val(fecha_inicio);
    $('#fecha_fin').val(fecha_fin);
    $('#fecha_inicio2').val(fecha_inicio);
    $('#fecha_fin2').val(fecha_fin);
    $('#fecha_corte').val(fecha_corte);
    $('#perfil').val(perfil);
    $('#vbajada').val(vbajada);
    $('#vsubida').val(vsubida);
    
    

  };

</script>