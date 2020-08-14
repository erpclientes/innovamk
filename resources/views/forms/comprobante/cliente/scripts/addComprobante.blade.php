<script type="text/javascript">
	//-----JPaiva--13-07-2018-------------GRABAR-----------------------------------
    $("#addComp").click(function(e){
        e.preventDefault(); 

        var idcliente = null;
        var idforma_pago = null;
        var iddocumento = null;
        var idmoneda = null;
        var idservicio = null;

       @foreach($clientes as $datos)
          idcliente = '{{$datos->idcliente}}';
          idforma_pago = '{{$datos->forma_pago}}';
          iddocumento = '{{$datos->doc_venta}}';
          idmoneda = '{{$datos->moneda}}';
       @endforeach

       @foreach($servicio as $serv)
          idservicio = '{{$serv->idservicio}}';
       @endforeach
       
        $.ajax({
            url: "{{ url('/comprobante/cliente/guardar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/comprobante/cliente/guardar') }}",
           data:{
              fecha_emision:$("input[name=fecha_emision]").val(), 
              fecha_vencimiento:$("#fecha_vencimiento").val(), 
              descripcion:$("#descripcion").val(), 
              precio_unitario:$("input[name=precio_unitario]").val(), 
              subtotal:$("input[name=subtotal]").val(), 
              descuento:$("input[name=descuento]").val(), 
              subtotal_neto:$("input[name=subtotal_neto]").val(), 
              impuesto:$("input[name=impuesto]").val(), 
              total:$("input[name=total]").val(), 
              idcliente:idcliente,
              idforma_pago:idforma_pago,
              iddocumento:$("select[name=doc_venta2]").val(),
              idmoneda:idmoneda,
              idservicio:idservicio,
              fecha_inicio:$('#fecha_inicio').val(),
              fecha_fin:$('#fecha_fin').val(),
              fecha_corte:$('#fecha_corte').val(),
              perfil:$('#perfil').val(),
              vbajada:$('#vbajada').val(),
              vsubida:$('#vsubida').val()

           },

           success:function(data){
              console.log(data);

              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.name != "undefined" )? $('#error2').text(data.name) : null;
                ( typeof data.precio != "undefined" )? $('#error3').text(data.precio) : null;
                ( typeof data.vsubida != "undefined" )? $('#error4').text(data.vsubida) : null;
                ( typeof data.vbajada != "undefined" )? $('#error5').text(data.vbajada) : null;
              } else if(data.valor == "CONFORME"){
               
                setTimeout(function() {
                  M.toast({ html: '<span>comprobante generado.</span>'});
                }, 2000); 

                window.location="{{ url('/cliente') }}/{{$idcliente}}";                                        
               
              }
              
           },
          error:function(){ 
              alert("error!!!!");
          }
        });
  });

    
</script>