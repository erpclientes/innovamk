<script type="text/javascript">
  //----JPaiva--03-03-2019---------------------------------GUARDAR LICENCIA-----------------------------------------------
  $(document).on('click','#add', function(){
  
    var data = $('#myForm').serializeArray();

          $.ajax({
              url: "{{ url('/licencia/grabar') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/licencia/grabar') }}",
             data:data,

             success:function(data){              
                if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.idtipo != "undefined" )? $('#error2').text(data.idtipo) : null;
                
              } else {  
                
                setTimeout("location.href='{{url('/licencia')}}'", 0000);
                
              }
                   
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });

  //----JPaiva--29-06-2019---------------------------------GUARDAR LICENCIA-----------------------------------------------
  $('#idtipo').change(function(e){
      //$('#descuento').removeAttr('disabled');
      $('#meses').removeAttr('disabled');
      $("#meses option[value=1]").attr("selected", true);
      $("#descuento").val(0);

      var data = $("select[name=idtipo]").val();
      var meses =  parseInt($("#meses").val());
      var descuento = parseInt($("#descuento").val());
      var total = 0;

      @foreach($tipo as $datos)
        if(data == "{{$datos->idtipo}}"){
          total = parseInt('{{$datos->precio}}') * meses;
          if (descuento > total) {
            setTimeout(function() {
              M.toast({ html: '<span>El descuento sobrepasa el límite.</span>'});
            }, 2000); 

            $("#descuento").val(0);
            $("#precio").val('{{$datos->precio}}');
            $("#subtotal").val(total); 
            $("#total").val(total);  
            $("#subtotal2").val(total); 
            $("#total2").val(total);  
          }else{
            $("#precio").val('{{$datos->precio}}');
            $("#subtotal").val(total); 
            $("#total").val(total-descuento);  
            $("#subtotal2").val(total); 
            $("#total2").val(total-descuento);  
          }          
        }
      @endforeach           
  });

  $('#meses').change(function(e){
      var meses = parseInt($("select[name=meses]").val());
      var descuento = parseInt($("#descuento").val());
      var precio = parseInt($("#precio").val());      
      var total = meses*precio;
      var subtotal = total;

      if (meses < 3) {
        $("#descuento").val(0);
        $('#descuento').attr('disabled',true);
        descuento = 0;
      }else{
        $('#descuento').removeAttr('disabled');
      }

      if (descuento > (total*0.15)) {
        setTimeout(function() {
          M.toast({ html: '<span>El descuento sobrepasa el límite.</span>'});
        }, 2000); 

        $("#descuento").val(0);
        $("#total").val(total);
        $("#subtotal").val(subtotal); 
        $("#total2").val(total);
        $("#subtotal2").val(subtotal); 
      }else{
        $("#subtotal").val(subtotal); 
        $("#total").val(total-descuento);
        $("#subtotal2").val(subtotal); 
        $("#total2").val(total-descuento);
      }

           
  });

  $("#descuento").blur(function(){
    
    var descuento = parseInt($("#descuento").val());
    var total = parseInt($("#subtotal").val());

    if (isNaN(descuento)) {
      descuento = 0;
      $("#descuento").val(0);
    }

    if (descuento > (total*0.15)) {
      setTimeout(function() {
        M.toast({ html: '<span>El descuento sobrepasa el límite.</span>'});
      }, 2000); 

      $("#descuento").val(0);
      $("#total").val(total);
      $("#total2").val(total);
    }else{
      $("#total").val(total-descuento);
      $("#total2").val(total-descuento);
    }
    
  });
</script>