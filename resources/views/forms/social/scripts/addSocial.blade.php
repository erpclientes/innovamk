<script type="text/javascript">
    //---JPaiva-26-07-2018----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();
      
      @foreach($parametros as $val)
        var parametro = console.log($("select[name='{{$val->parametro}}']").val());
        console.log(parametro);
        $.ajax({
            url: "{{ url('/social/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/social/actualizar') }}",
           data:{
              parametro:'{{$val->parametro}}',
              valor:$("select[name='{{$val->parametro}}']").val()
           },

           success:function(data){
              

           },
           error:function(){ 
              alert("error!!!!");
        }
        });
  
      @endforeach

      setTimeout(function() {
        M.toast({ html: '<span>Registro actualizado</span>'});
      }, 2000);  

    });


</script>