<script type="text/javascript">
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  $(document).on('click','#exportHotspot', function(){  
    @foreach ($hotspot as $val)

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
  $(document).on('click','#allCheck', function(){  
    @foreach ($hotspot as $val)
      $( "#c{{$val->idperfil}}" ).prop( "checked", true );
    @endforeach
  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#clearCheck', function(){  
    @foreach ($hotspot as $val)
      $( "#c{{$val->idperfil}}" ).prop( "checked", false );
    @endforeach
  });       

  //----------------------QUITAR CHECK A  A TODO LOS ITEMS DEL FORM_EXPORTAR------------
  $('#eHotspot3').click(function(e){
    console.log('entro');
    @foreach($hotspot as $valor)
      $('#c{{$valor->idperfil}}').prop( "checked", false );
    @endforeach
  });
</script>