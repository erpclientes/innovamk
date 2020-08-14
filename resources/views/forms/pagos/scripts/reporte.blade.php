<script type="text/javascript">
//---JPaiva-22-09-2019----------------GENERAR REPORTE-----------------------------
  var val = null;


  $(document).on('click','#execReport', function(){
    //cont = parseInt($('#pcq_cont').val());
    var data = $('#frmReport').serializeArray();
              
        $.ajax({
            url: "{{ url('/reportePagos') }}",
            type:"post",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'post',
           url:"{{ url('/reportePagos') }}",
           data:data,

           success:function(data){            

             //window.location="{{ url('/reporte-pagos') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });    
  });  

  
</script>
