@extends('layouts2.app')
@section('titulo','Lista de Clientes')

@section('main-content')
<br>
	<div class="row">

     
                  <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1">
                      <li class="tab col s3" style="background-color: #78909c;"><a class="white-text waves-effect waves-light active" href="#pestana1">Datos</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#pestana2" class="white-text waves-effect waves-light">Servicios</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#pestana3" class="white-text waves-effect waves-light">Notificaciones</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#pestana4" class="white-text waves-effect waves-light">Comprobantes</a>
                      </li>
                    
                  </ul>
                  </div>                  
                  <div class="col s12">
                    <div id="pestana1" class="col s12 tabs-mk">                    	
                      @include('forms.clientes.mntCliente')                         
                    </div>
                    <div id="pestana2" class="col s12 tabs-mk">
                      @include('forms.clientes.lstServicios')    
                    </div>
                    <div id="pestana3" class="col s12 tabs-mk" >
                      @include('forms.notificaciones.addNotificacion')   
                    </div>
                    <div id="pestana4" class="col s12 tabs-mk">
                      @include('forms.comprobante.cliente.lstComprobante')   
                    </div>
                  </div>                 
</div>

<br><br><br>
@endsection

@section('script') 

  @include('forms.comprobante.cliente.scripts.comprobante')
  @include('forms.comprobante.cliente.scripts.addComprobante')
  @include('forms.comprobante.cliente.scripts.vwComprobante')
  @include('forms.comprobante.cliente.scripts.validacion')
  @include('forms.clientes.scripts.validacion')
  @include('forms.dequipos.scripts.addEquipo')
  @include('forms.dequipos.scripts.addComprobante')
  @include('forms.dequipos.scripts.newComprobante')
  @include('forms.dequipos.scripts.validacion')
  @include('forms.servicio.scripts.desabilitar')
  @include('forms.servicio.scripts.habilitar')
  @include('forms.servicio.scripts.hNotificacion')
  @include('forms.servicio.scripts.dNotificacion')

  @include('forms.clientes.documentos.scripts.addDocumentoadjunto')
  @include('forms.equipos.scripts.equipos') 
  @include('forms.clientes.scripts.addEquipoEmisor')   
  @include('forms.comprobante.cliente.scripts.addConceptoManual')


 <script type="text/javascript">


  $("#modalActualizarClienteDir").click(function(g){
    g.preventDefault();
    //console.log("ingreso");
    var datos = []; 
    var latitud , longitud,direccion ;
    

    function buscarDireccion() {
       // value = $('#value').text();
       var data = []; 
       //ar data = bandera.push('B',); 
       data.push(['carlos']); 	
       $.ajax({
        url: " {{ url('/pasar') }} ",
        type:"POST",
        beforeSend: function (xhr) {
           var token = $('meta[name="csrf-token"]').attr('content');
           if (token) {
               return xhr.setRequestHeader('X-CSRF-TOKEN', token);
           }
        },
        type:'POST',
        url:" {{ url('/pasar') }} ",
        data:{
          bandera:"bandera"
        },
        success:function(data){
        //  console.log(data);
          if ( data[0] == "error") {
          console.log("error");
          
          } else {  
           console.log("recupero data ");
           console.log(data); 
           if(data.longitud==null ){
             console.log("esta nulo ")
              //setInterval(buscarDireccion, 3000);
             //intervalo();
           }else{
             latitud=data.latitud;
             longitud=data.longitud;
             direccion=data.direccion;
            console.log(direccion);
            $('#direccion').val(direccion ); 
            $('#latitudF').val(latitud);
            $('#longitudF').val(longitud );
            $('#modalUpdate').modal('close');
            console.log("se actualiza registro ");
           }
           //datos=data;
           //clearInterval(intervalo);

          }
        },
        error:function(){ 
          alert("error!!!!");
          }
      });
    }

    
    setInterval(buscarDireccion, 3000);
   
 })
  //---JPaiva--12-07-2018---------------VARIOS DATATABLE--------------------
    $(document).ready(function() {
    $('table.display').DataTable();  
  } );
  </script>
   
  <script type="text/javascript">
    //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#nn_update').click(function(e){
      e.preventDefault();   

      $.ajax({
            url: "{{ url('/notificaciones/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/notificaciones/actualizar') }}",
           data:{
              codigo:$("input[name=codigo]").val(), 
              aviso:$("select[name=aviso]").val(),
              corte:$("select[name=corte]").val(),
              frecuencia:$("select[name=frecuencia]").val(),
              dia_pago:$("input[name=dia_pago]").val(),
              facturacion:$("select[name=facturacion]").val()
           },

           success:function(data){
             
              setTimeout(function() {
                  M.toast({ html: '<span>Registro actualizado</span>'});
                }, 2000);  

              setTimeout("redireccionarPagina()",4000);
           },
           error:function(){ 
              alert("error!!!!");
        }
        });


    });  

    function redireccionarPagina() {
      window.location = "{{ url('/cliente') }}/{{$idcliente}}";
    } 
   
</script>
 
 
@endsection

