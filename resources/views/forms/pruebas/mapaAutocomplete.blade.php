@extends('layout7.app')
@section('titulo','Lista de Clientes') 
@section('main-content') 

<form action="#" id="myModal" method="get">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
  <div class="row cuerpo-2"> 
    <table class="table table-hover table-striped">
       <thead style="background-color:#e0e0e0 ">                  
       </thead>
       <tbody>
         <th>
         <form action="#" >
           <span>Tipo de búsqueda:</span>
           <hr size="8"/>
           <p>
             <label>
               <input     id="group2"  style=" color:#33AFE8;" name="group1" value="cor" type="radio" checked />
               <span> Coordenadas </span>
             </label>
           </p>
           <p>
             <label>
              <input  {{--  class="with-gap"  --}} style=" color:#33AFE8; background-color: #ff9800;" id="group1" name="group1" value="dir" type="radio" />
              <span>Dirección</span>
             </label>
           </p>  
          </form> 
         </th>
         <th>
         <div  id="texto" style="display: block" class="input-field col s12 l6 left-align">
           <blockquote style="margin: 0px">Para habilitar el campo de búsqueda tiene que seleccionar el parámetro respectivo.</blockquote>
          </div>
         </th>
        <th>
           <td>
             <div class="coordenadas" id="coordenadas" style="display: none">
             <p>
               <input style="width: 10vw;" id="latlng" type="text" value="" placeholder=" Ingrese Latitud"/>
               |
               <input style="width: 10vw;" id="latlog" type="text" value="" placeholder=" Ingrese Longitud "/> 
  
               <a   type="button" id="searchCor"  >  <i class=" material-icons prefix">search</i></a>
             </p>
             </div>
           
           </td>
        </th>
        <th>
           <td> 
             {{-- <div class="direcciones" id="direcciones" style="display: none">
             <input  id="address"   class="autocomplete" style="width: 18vw;" type="text" maxlength="100"  placeholder=" Ingrese dirección a buscar" >
             <label for="address">Autocomplete</label>
             <a   type="button" id="search"  >  <i class="material-icons prefix">search</i></a>
  
             </div> --}}
  
             <div class="row"  id="direcciones" style="display: none">
             <div class="col s12">
               <div class="row">
                <div class="input-field col s12">
                 
                 <input style="width: 18vw;" type="text" id="address" class="autocomplete">
                 <label for="address">Autocomplete</label>
                 <a type="button" id="search"  >  <i class="material-icons prefix">search</i></a>
                </div>
               </div>
             </div>
            </div>
            
           </td>                        
        </th>    
       </tbody>
    </table>
    <center>
       <br>
       <div id='map_canvas' style="width:600px; height:230px;"></div>
       <br>
       <a style="display: none" href="#" id="ActualizarDireccion"   class="btn waves-effect waves-light" style="width: 300px; color: white; background-color: #33AFE8">ENVIAR UBICACIÒN </a>
    </center>
    <table class="table table-hover table-striped">
       <thead style="background-color: e0e0e0 ">                                   
       </thead>
       <tbody>
         <th></th>
         <th>
            <td>
               <p>Latitud : <input  name="latitude" readonly="readonly" style="width: 15vw;" type="text" id="latitude" placeholder="Latitude"/></p>
            </td>
            <input  type="hidden" name="bandera"    value="A" type="text" id="bandera"  />
         </th>
         <th>
            <td>
               <p>Longitud :<input name="longitud" readonly="readonly" style="width: 15vw;" type="text" id="longitude" placeholder="Longitude"/>  </p>


            </td>                    
         </th>
         <th>
           <td>
             <p>Direccion:<input name="direccionf" readonly="readonly" style="width: 20vw;" type="text" id="direccionf" placeholder="direccion" value="direcion aun no buscada "/>  </p>
           </td>                     
         </th>
       </tbody>
    </table>             
  </div>  
  
</form>


 
   @endsection

   @section('script')

   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzNnpcmAbYVlos0_fn5wxNZpR68VOtQrM"></script>

    @include('forms.pruebas.scripts.mapa') 
    @include('forms.pruebas.scripts.enviar') 

     
    
@endsection

 


