<script type="text/javascript">
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  var val = null;

  $('#iPPPoE2').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();

      $.ajax({
            url: "{{ url('validaParametros') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('validaParametros') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.idtipo != "undefined" )? $('#error2').text(data.idtipo) : null;
                ( typeof data.dia_pago != "undefined" )? $('#error3').text(data.dia_pago) : null;
                ( typeof data.aviso != "undefined" )? $('#error4').text(data.aviso) : null;
                ( typeof data.corte != "undefined" )? $('#error5').text(data.corte) : null;
                ( typeof data.frecuencia != "undefined" )? $('#error6').text(data.frecuencia) : null;
                ( typeof data.forma_pago != "undefined" )? $('#error7').text(data.forma_pago) : null;
                ( typeof data.doc_venta != "undefined" )? $('#error8').text(data.doc_venta) : null;
                ( typeof data.moneda != "undefined" )? $('#error9').text(data.moneda) : null;
                ( typeof data.fecha_factura != "undefined" )? $('#error10').text(data.fecha_factura) : null;
                
              } else {  
                //var obj = $.parseJSON(data);                
                //setTimeout("location.href='{{url('/clientes')}}'", 0000);
                var idtipo = $('#idtipo').val();

                if(idtipo == 'PPP'){
                  $('#p_forma_pago').val($('#forma_pago').val());
                  $('#p_doc_venta').val($('#doc_venta').val());
                  $('#p_moneda').val($('#moneda').val());
                  $('#p_dia_pago').val($('#dia_pago').val());
                  $('#p_aviso').val($('#aviso').val());
                  $('#p_corte').val($('#corte').val());
                  $('#p_frecuencia').val($('#frecuencia').val());
                  $('#p_fecha_factura').val($('#fecha_factura').val());
                  $('#p_glosa').val($('#glosa').val());
                  
                  usuariosPPPoE();
                  $('#iPPPoE').modal('open');  
                  
                }else if(idtipo == 'HST'){
                  $('#hst_forma_pago').val($('#forma_pago').val());
                  $('#hst_doc_venta').val($('#doc_venta').val());
                  $('#hst_moneda').val($('#moneda').val());
                  $('#hst_dia_pago').val($('#dia_pago').val());
                  $('#hst_aviso').val($('#aviso').val());
                  $('#hst_corte').val($('#corte').val());
                  $('#hst_frecuencia').val($('#frecuencia').val());
                  $('#hst_fecha_factura').val($('#fecha_factura').val());
                  $('#hst_glosa').val($('#glosa').val());
         
                  usuariosHotspot();
                  $('#iHST').modal('open');  

                }else if(idtipo == 'QUE'){
                  $('#q_forma_pago').val($('#forma_pago').val());
                  $('#q_doc_venta').val($('#doc_venta').val());
                  $('#q_moneda').val($('#moneda').val());
                  $('#q_dia_pago').val($('#dia_pago').val());
                  $('#q_aviso').val($('#aviso').val());
                  $('#q_corte').val($('#corte').val());
                  $('#q_frecuencia').val($('#frecuencia').val());
                  $('#q_fecha_factura').val($('#fecha_factura').val());
                  $('#q_glosa').val($('#glosa').val());

                  usuariosQUEUES();
                  $('#iQUEUES').modal('open');  
                }else if(idtipo == 'PCQ'){
                  $('#pcq_forma_pago').val($('#forma_pago').val());
                  $('#pcq_doc_venta').val($('#doc_venta').val());
                  $('#pcq_moneda').val($('#moneda').val());
                  $('#pcq_dia_pago').val($('#dia_pago').val());
                  $('#pcq_aviso').val($('#aviso').val());
                  $('#pcq_corte').val($('#corte').val());
                  $('#pcq_frecuencia').val($('#frecuencia').val());
                  $('#pcq_fecha_factura').val($('#fecha_factura').val());
                  $('#pcq_glosa').val($('#glosa').val());
                  
                  usuariosPCQ();
                  $('#iPCQ').modal('open');  
                }                
                
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

  
</script>
