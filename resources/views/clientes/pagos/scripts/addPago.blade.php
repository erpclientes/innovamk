<script type="text/javascript">
      //---JPaiva-24-09-2018----------------GRABAR-----------------------------
  
    $('#add').click(function(e){
      e.preventDefault();

      var formData = new FormData();
      formData.append('imagenURL', $('#imagenG')[0].files[0]);
      
      $.ajax({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                url: "{{ url('/pagos/imgGrabar') }}" + '?' + $('#myForm').serialize(),
                method: "POST",               
                data: formData,
                processData: false,
                contentType: false
            }).done(function (data) {
              
                if (data.success)
                    //$avatarImage.attr('src', data.path);
                   window.location="{{ url('/registrar-pagos') }}";
                    
            }).fail(function () {
                alert('La imagen subida no tiene un formato correcto');
            });

    });    

    @foreach ($factura as $val)
      $(document).on('click','#p{{$val->codigo}}', function(){

        var imagen = $(this).data('imagen');
        var val = '#';
                       
        if(imagen.length > 0){
          val = "{{url('/images')}}"+"/"+ $(this).data('imagen'); 
        }
                
        $("#id").val($(this).data('id'));
        $("#imagen").val($(this).data('imagen'));        
        $("#url_imagen").attr('src',val);

        if (imagen.length > 0) {
          
          $('#imagen_scr').hide();
          $('#url_imagen').show();          
        }else{
          $('#imagen_scr').show();
          $('#url_imagen').hide();  
        }

      });      
    @endforeach 


</script>