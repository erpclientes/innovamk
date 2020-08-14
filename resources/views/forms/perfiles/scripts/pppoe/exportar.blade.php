<script type="text/javascript">
//---JPaiva-12-02-2019----------------IMPORTAR-----------------------------
  $(document).on('click','#exportPppoe', function(){  
    @foreach ($pppoe as $val)

      var data = $('#myForm{{$val->idperfil}}').serializeArray();
        
        $.ajax({
            url: "{{ url('/exportPerfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/exportPerfil') }}",
           data:data,

           success:function(data){

             

           },
           error:function(){ 
              alert("error!!!!");
        }

        });

    @endforeach

    setTimeout(function() {
      M.toast({ html: '<span>Exportación de perfiles exitosa.</span>'});
    }, 2000); 
  });      

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#ppp_allCheck', function(){  
    @foreach ($pppoe as $val)
      $( "#c{{$val->idperfil}}" ).prop( "checked", true );
    @endforeach
  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#ppp_clearCheck', function(){  
    @foreach ($pppoe as $val)
      $( "#c{{$val->idperfil}}" ).prop( "checked", false );
    @endforeach
  });       

  //----------------------QUITAR CHECK A  A TODO LOS ITEMS DEL FORM_EXPORTAR------------
  $('#ePppoe3').click(function(e){
    
    @foreach($pppoe as $valor)
      $('#c{{$valor->idperfil}}').prop( "checked", false );
    @endforeach
  });
</script>