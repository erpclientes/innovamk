<!-- BEGIN VENDOR JS-->
    <script src="{{asset('js/script/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="{{asset('js/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/data-tables/data-tables-script.js')}}"></script>

    <script src="{{asset('js/script/chart.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/script/chartist.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/script/chartist-plugin-tooltip.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/script/chartist-plugin-fill-donut.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('js/script/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/script/customizer.js')}}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('js/script/data-tables.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- sparkline -->
    <script type="text/javascript" src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/sparkline/sparkline-script.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/plugins/formatter/jquery.formatter.min.js')}}"></script> 
    <script type="text/javascript" src="{{asset('js/jquery.mask.min.js')}}"></script>

    <!--angularjs-->
    <script type="text/javascript" src="{{asset('js/plugins/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/vue.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>

   

    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">

    <!-- Include video.js and videojs-contrib-hls in your page
      -->

    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>

    <!--
       Now, initialize your player. That's it!
      -->
    <script>
      (function(window, videojs) {
        var player = window.player = videojs('example-video');

        // hook up the video switcher
        var loadUrl = document.getElementById('load-url');
        var url = document.getElementById('url');
        loadUrl.addEventListener('submit', function(event) {
          event.preventDefault();
          player.src({
            src: url.value,
            type: 'application/x-mpegURL'
          });
          return false;
        });
      }(window, window.videojs));
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
           $(document).bind("contextmenu",function(e){
              return false;
           });
        });

        $(document).ready(function(){
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();
        });

        function mayus(e) {
          e.value = e.value.toUpperCase();
        }

         $('#radio').click(function(e){
          val = $('#left-sidebar-nav').data('valor');

          if(val == '0'){
            
            $('#sideusuario').hide();
            $('#left-sidebar-nav').data('valor','1');
            $('#mas_opciones').text('MÁS');
          }else{
            $('#sideusuario').show();
            $('#left-sidebar-nav').data('valor','0');
            $('#mas_opciones').text('MÁS OPCIONES');
          }
          

        });

        

    </script>

    @include('layouts2.scripts.herramientaPlantilla')


    
    @section('script')

    @show