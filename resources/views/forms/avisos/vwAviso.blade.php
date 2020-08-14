
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Aviso</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Somos Proveedores de Servicios de Internet - WISP">
    <meta name="keywords" content="mikrotik, sistema mikrotik, mikrotik sistema, ubiquiti, mikrtoik ubiquiti, innovaMk, innovaTec">
    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->

  <!-- CORE CSS-->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/estilos.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

  <link href="css/carrusel_b.css" rel="stylesheet" type="text/css" />
  <script src="js/carrusel_b.js"></script>
    
  
</head>

<body  onload="principal()" style="background-color: #616161">
     
  @foreach($empresa as $emp) 
    @foreach($aviso as $datos)
      <div class="row">
        <div class="col s12 m10 l10 offset-m1 offset-l1">
          <div class="card-panel z-depth-5" id="pagina-login" style=" padding: 0">

            <div class="card-header center white-text deep-purple darken-1"; style="border-bottom: 1px solid #90caf9; height: 60px; padding-top: 20px">
              <h2 class="" style="font-size: 30px;"><b>{{$datos->titulo}}</b></h2>                              
            </div>
            <form action="{{ url('/login') }}" method="post" style="padding: 10px">

              <div class="row">
                <div class="input-field col s12 center">              
                  <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px">Estado de su conexión</p>
                  <h6 class="text-primary black-text">Estimado usuario:</h6><br>
                  <div class="divider"></div>
                  <p style="color: #424242; font-size: 1.1rem" class="center"><b>{{$datos->descripcion}}</b></p><br>
                  <center>  
                      <span class="btn btn-secondary btn-block  deep-purple darken-3" style="width: 25rem;">Atte. Gerencia</span>
                     
                      <div class="col s8 m8 l6 center" style="margin: auto; width: 100%">
                        <img src="{{asset($emp->url_imagen)}}" alt="" id="" class=" responsive-img valign profile-image " style="width:120px;height:120px ;"> </div>
                  </center> 


                </div>
              </div>  
            </form>
        </div>
        </div>
      </div>
    @endforeach
  @endforeach

    </div>


  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <!--materialize js -->
  <script type="text/javascript" src="js/materialize.min.js"></script>  
  <!--prism-->
  <script type="text/javascript" src="js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script src="js/jquery.vide.min.js"></script>

   
  <script type="application/javascript">
  function getIP(json) {
    //var obj = $.parseJSON(json);
    //document.write("My public IP address is: ", json.ip);
  }
</script>

<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>

     
</body>

</html>