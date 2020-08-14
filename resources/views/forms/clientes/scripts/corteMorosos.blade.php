<script type="text/javascript">
//---JPaiva-21-09-2019----------------GESTIÓN CORTE MOROSOS-----------------------------
  var val = null;


  $(document).on('click','#execCorte', function(){
    //cont = parseInt($('#pcq_cont').val());
    console.log('entro');
              
        $.ajax({
            url: "{{ url('/corte') }}",
            type:"GET",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'GET',
           url:"{{ url('/corte') }}",
           data:{data:'CORTE'},

           success:function(data){

             setTimeout(function() {
                  M.toast({ html: '<span>Cortes masivos exitoso</span>'});
                }, 2000); 

             //window.location="{{ url('/perfiles') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });    
  });  


  $(document).on('click','#corte', function(){
      
  
        $.ajax({
            url: "{{ url('/usuariosCorte') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/usuariosCorte') }}",
           data:{
              idrouter:val,
              idtipo:'PCQ'
           },

           success:function(data){
            
            var valor = "";
            cont = parseInt($('#pcq_cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#trCorte" + i).remove();
            }
              
              $.each(data, function(i, item) {     
                
                color = ( item['estado'] == 1 )? 'teal' : 'grey';
                estado = ( item['estado'] == 1 )? 'ACTIVO' : 'INACTIVO';

                $("#tableCorte").append("<tr class='' id='trCorte"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<td class='center'>"+ (i+1) +"</td>"+
                  "<td>"+ (item.razon_social).trim() +"</td>"+
                  "<td>"+ item['name'] +"</td>"+
                  "<td>"+ item['ip'] +"</td>"+                  
                  "<td class='center'>"+ item.precio +"</td>"+
                  "<td class='center'>"+ item.fecha_corte +"</td>"+
                  "<td class='center'>"+
                    "<span class='badge green lighten-5 "+ color +"-text text-accent-4'>"+estado+"</span>"+                        
                  "</td>"+ 
                 // "</form>"+                 
                "</tr>");

                cont = i;
              });

              $('#pcq_cont').val(cont);
              $('#pcq_idrouter').val(val);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  });
  
</script>
