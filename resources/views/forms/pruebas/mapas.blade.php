@extends('layouts2.app')
@section('titulo','Lista de Clientes')


@section('main-content') 




<form method="POST" action=" " id="myForm" enctype="multipart/form-data" class="grey lighten-5">
    // <input type="hidden" name="codigo" value="$datos->codigo">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
      <div class="row cuerpo-2">
         
         <table class="table table-hover table-striped">
             <thead style="background-color: e0e0e0 ">                  
             </thead>
             <tbody>
               <th></th>
               <th>
                   <td>
                        <input id="latlng" type="textbox" value=" " placeholder=" Ingrese Coordenadas a buscar ">
                       <input type="button" id="searchCor" value="Buscar" {{-- onclick="codeLatLng()" --}}> 
                   </td>
               </th>
               <th>
                   <td>
                   <input  style="width: 14vw;" type="text" maxlength="100" id="address" placeholder=" Ingrese dirección a buscar" />
                   <input type="button" id="search" value="Buscar" /> 
                   </td>                        
               </th>    
             </tbody>
         </table>
         <center>
             <br>
             <div id='map_canvas' style="width:650px; height:250px;"></div>
             <br>
             {{-- <a  id="ActualizarDireccion" data-tooltip="Actualizar direccion" type="submit" style="width: 14vw;" class="waves-effect 
             waves-light btn">ENVIAR UBICACIÒN</a> --}}
 
             <a href="#" id="ActualizarDireccion" class="btn waves-effect waves-light" style="width: 300px; color: white; background-color: #33AFE8">ENVIAR UBICACIÒN </a>
         </center>
         <table class="table table-hover table-striped">
             <thead style="background-color: e0e0e0 ">                                   
             </thead>
             <tbody>
                 <th></th>
                 <th>
                     <td>
                         <p>Latitud : <input  name="latitude" readonly="readonly" style="width: 12vw;" type="text" id="latitude" placeholder="Latitude"/></p>
                     </td>
                 </th>
                 <th>
                     <td>
                         <p>Longitud :<input name="longitud" readonly="readonly" style="width: 12vw;" type="text" id="longitude" placeholder="Longitude"/>  </p>
                     </td>                    
                 </th>
             </tbody>
         </table>             
      </div>   
 </form>
 
   @endsection

   @section('script')

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCau_UwFedPo-8s5LgR5O62tbJFSTQwT3A&libraries=places&callback=initMap"
    async
    defer
    ></script>
  

    @include('forms.pruebas.scripts.mapa')
    @include('forms.pruebas.scripts.addmapa')

     
    
@endsection

 