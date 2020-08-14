<script type="text/javascript">
      //---JPaiva-01-10-2019----------------GUARDAR-----------------------------
    $('#add').click(function(e){
      e.preventDefault();

      var data = $('#frmPlantilla').serializeArray();
      //console.log(data);

      $.ajax({
            url: "{{ url('/herramientaPlantilla') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/herramientaPlantilla') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.alias != "undefined" )? $('#error2').text(data.alias) : null;
                ( typeof data.ip != "undefined" )? $('#error3').text(data.ip) : null;
                ( typeof data.usuario != "undefined" )? $('#error4').text(data.usuario) : null;
                ( typeof data.password != "undefined" )? $('#error5').text(data.password) : null;
              } else {  
                //var obj = $.parseJSON(data);                
                //setTimeout("location.href='{{url('/router')}}'", 0000);
                setTimeout(function() {
                  M.toast({ html: '<span>Actualización exitoso.</span>'});
                }, 2000); 
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

    //---JPaiva-08-10-2019---------------PERSONALIZAR PLANTILLA SISTEMA------------------------------
    
      $(document).ready(function()
      {
        $(".cargar").bind("click",function()
        {
          var dato = $(this).data('color');
          var valor = "page-footer footer footer-dark  gradient-shadow navbar-border navbar-shadow footer-fixed "+dato;

          $("#piePagina").removeAttr("class");
          $("#piePagina").attr("class",valor);
          $('#cabecera_color').val(dato);
          $('#footer_color').val(dato);
        });

        $(".footer-dark-checkbox").bind("click",function()
        {
          if( $('.footer-dark-checkbox').prop('checked') ) {
              $('.colorInnova').css('color','#fafafa')
              $('#footer_color').val('footer-dark');
          }else{
            $('#footer_color').val('footer-light');
          }          
        });

        $("navbar-dark-checkbox").bind("click",function()
        {
          if( $('.navbar-dark-checkbox').prop('checked') ) {
            $('#cabecera_color').val('navbar-dark');
            alert('Seleccionado');
          }else{
            $('#cabecera_color').val('navbar-light');
          }          
        });

        $(".navbar-dark-checkbox").bind("click",function()
        { 
          var color = $('#footer_color').val();   
          $valor = "navbar-main navbar-color nav-collapsible sideNav-lock no-shadow ";  

          if( $('.navbar-dark-checkbox').prop('checked') ) {
            $('#navbarMain').attr('class',$valor+" navbar-dark");
            $('.navbar-main').css('background','#37474f');
            $('#cabecera_color').val('#37474f');
          }else{
            $('#navbarMain').attr('class',$valor+" navbar-light");
            $('.navbar-main').css('background','#fff');
            $('#cabecera_color').val('#fff');
          }          
        });

        $(".ocultarFondoColor").bind("click",function()
        {
          var color = $('#footer_color').val();   
          var valor = "content-wrapper-before "+color;
          if( $('.ocultarFondoColor').prop('checked') ) {
            //alert('Seleccionado');
            $('#fondoColor').removeAttr("class");
          }else{
            $('#fondoColor').attr("class",valor);
          }          
        });

        $(".ocultarFooter").bind("click",function()
        {
          var fijar = " footer-static";
          if( $('.footer-fixed-checkbox').prop('checked') ) {
              fijar = " footer-fixed";
            }

          var color = $('#footer_color').val();
          var valor = "page-footer footer footer-dark  gradient-shadow navbar-border navbar-shadow " + color + fijar;
          if( $('.ocultarFooter').prop('checked') ) {
            //alert('Seleccionado');
            $('#piePagina').removeAttr("class");
            $('#piePagina').attr("class","hide");
          }else{
            $('#piePagina').attr("class",valor);
          }          
        });

        $(".menu-dark-checkbox").bind("click",function()
        {
          var url = null;
          var url2 = null;

          if( $('.menu-dark-checkbox').prop('checked') ) {
            if( $('.menu-collapsed-checkbox').prop('checked') ) {
              url = "{{asset('images/logo/Isotipo_Blanco.png')}}";  
            }else{
              url = "{{asset('images/logo/InnovaWifi2.png')}}";       
            }

            $('#logoInnova').removeAttr("src");
            $('#logoInnova').attr("src",url);
          }else{
            if( $('.menu-collapsed-checkbox').prop('checked') ) {
              url = "{{asset('images/logo/Isotipo.png')}}";  
            }else{
              url = "{{asset('images/logo/InnovaWifi.png')}}";       
            }

            $('#logoInnova').removeAttr("src");
            $('#logoInnova').attr("src",url);
          }          
        });

        $(".menu-collapsed-checkbox").bind("click",function()
        {
          var dato = 'logo-text hide-on-med-and-down';
          var url = null;
          var url2 = null;

          if( $('.menu-collapsed-checkbox').prop('checked') ) {
            if( $('.menu-dark-checkbox').prop('checked') ) {
              url = "{{asset('images/logo/Isotipo_Blanco.png')}}";  
            }else{
              url = "{{asset('images/logo/Isotipo.png')}}";       
            }

            $('#logoInnova').removeAttr("src");
            $('#logoInnova').attr("src",url);
            $('.logo-wrapper').css('padding-left','12px');
            $('#LogoInnovaTec').attr('class',dato);    
          }else{
            if( $('.menu-dark-checkbox').prop('checked') ) {
              url = "{{asset('images/logo/InnovaWifi2.png')}}"; 
            }else{
              url = "{{asset('images/logo/InnovaWifi.png')}}";              
            }

            $('#logoInnova').removeAttr("src");
            //$('#logoInnova').attr("src",$valor);
            $('#logoInnova').attr("src",url);
            $('.logo-wrapper').css('padding-left','20px');
            $('#LogoInnovaTec').attr('class','hide');
          }          
        });

      });

</script>