<script type="text/javascript">
//---JPaiva-27-03-2019----------------IMPORTAR-----------------------------
  $(document).on('click','#exportPCQ', function(){  
    @foreach ($pcq as $val)

      var data = $('#formPCQ{{$val->idperfil}}').serializeArray();
        
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
  $(document).on('click','#e_pcq_allCheck', function(){  
    @foreach ($pcq as $val)
      $( "#c{{$val->idperfil}}" ).prop( "checked", true );
    @endforeach
  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#e_pcq_clearCheck', function(){  
    @foreach ($pcq as $val)
      $( "#c{{$val->idperfil}}" ).prop( "checked", false );
    @endforeach
  });       

  //----------------------QUITAR CHECK A  A TODO LOS ITEMS DEL FORM_EXPORTAR------------
  $('#ePcq3').click(function(e){
    
    @foreach($pcq as $valor)
      $('#c{{$valor->idperfil}}').prop( "checked", false );
    @endforeach
  });
</script>