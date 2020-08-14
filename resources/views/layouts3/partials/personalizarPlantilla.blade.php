      <a href="#" data-target="theme-cutomizer-out" class="btn btn-customizer gradient-45deg-purple-deep-orange white-text sidenav-trigger theme-cutomizer-trigger"><i class="material-icons">settings</i></a>
      <a href="http://innova-tec.me" target="_blank" class="hide btn btn-buy-now gradient-45deg-indigo-purple gradient-shadow white-text tooltipped buy-now-animated tada" data-position="left" data-tooltip="Comprar ahora!"><i class="material-icons">add_shopping_cart</i></a>
      <div id="theme-cutomizer-out" class="theme-cutomizer sidenav row right-aligned ps ps--active-y" style="transform: translateX(0%);">

      <form id="frmPlantilla" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" id="cabecera_color" name="cabecera_color" value="{{Auth::user()->cabecera_color}}">
         <input type="hidden" id="footer_color" name="footer_color" value="{{Auth::user()->footer_color}}">
         <input type="hidden" id="logo_sidebar" value="">
         
         <div class="col s12">
            <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
            <h5 class="theme-cutomizer-title">Personalizar Plantilla</h5>
            <p class="medium-small">Visualize en tiempo real</p>
            <div class="menu-options">
               <h6 class="mt-6">Opciones para el Menú</h6>
               <hr class="customize-devider">
               <div class="menu-options-form row">
                  
                 
                  <div class="input-field col s12">
                     <div class="switch">
                        Menú Dark
                        <label class="float-right"><input name="menu_dark" {{(Auth::user()->menu_dark == 1)? 'checked' : '' }} class="menu-dark-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                     </div>
                  </div>
                  <div class="input-field col s12">
                     <div class="switch">
                        Menu Colapsible
                        <label class="float-right"><input name="menu_colapsible" {{(Auth::user()->menu_colapsible == 1)? 'checked' : '' }} class="menu-collapsed-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                     </div>
                  </div>
                  
               </div>
            </div>
            <h6 class="mt-6">Opciones de la Cabecera</h6>
            <hr class="customize-devider">
            <div class="navbar-options row">
               <div class="input-field col s12 navbar-color mb-0">
                  <p class="mt-0">Color Cabecera</p>
                  <div class="gradient-color center-align">
                     <span class="cargar navbar-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                     <span class="cargar navbar-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                     <span class="cargar navbar-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                     <span class="cargar navbar-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                     <span class="cargar navbar-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                     <span class="cargar navbar-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                     <span class="cargar navbar-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                     <span class="cargar navbar-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                     <span class="cargar navbar-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                  </div>
                  <div class="solid-color center-align">
                     <span class="cargar navbar-color-option red" data-color="red"></span>
                     <span class="cargar navbar-color-option purple" data-color="purple"></span>
                     <span class="cargar navbar-color-option pink" data-color="pink"></span>
                     <span class="cargar navbar-color-option deep-purple" data-color="deep-purple"></span>
                     <span class="cargar navbar-color-option cyan" data-color="cyan"></span>
                     <span class="cargar navbar-color-option teal" data-color="teal"></span>
                     <span class="cargar navbar-color-option light-blue" data-color="light-blue"></span>
                     <span class="cargar navbar-color-option amber darken-3" data-color="amber darken-3"></span>
                     <span class="cargar navbar-color-option brown darken-2" data-color="brown darken-2"></span>
                  </div>
               </div>
               <div class="input-field col s12">
                  <div class="switch">
                     Cabecera Dark
                     <label class="float-right"><input name="cabecera_dark" {{(Auth::user()->cabecera_dark == 1)? 'checked' : '' }} class="navbar-dark-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                  </div>
               </div>
               <div class="input-field col s12">
                  <div class="switch">
                     Cabecera Fija
                     <label class="float-right"><input name="cabecera_fija" {{(Auth::user()->cabecera_fija == 1)? 'checked' : '' }} class="navbar-fixed-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                  </div>
               </div>
               <div class="input-field col s12">
                  <div class="switch">
                     Ocultar Color Fondo
                     <label class="float-right"><input name="cabecera_fondo_ocultar" {{(Auth::user()->cabecera_fondo_ocultar == 1)? 'checked' : '' }} class="ocultarFondoColor" type="checkbox"> <span class="lever ml-0"></span></label>
                  </div>
               </div>
            </div>
            <h6 class="mt-6">Opciones del Pie de Página</h6>
            <hr class="customize-devider">
            <div class="navbar-options row">
               <div class="input-field col s12">
                  <div class="switch">
                     Footer Dark
                     <label class="float-right"><input name="footer_dark" {{(Auth::user()->footer_dark == 1)? 'checked' : '' }} class="footer-dark-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                  </div>
               </div>
               <div class="input-field col s12">
                  <div class="switch">
                     Footer Fija
                     <label class="float-right"><input name="footer_fija" {{(Auth::user()->footer_fija == 1)? 'checked' : '' }} class="footer-fixed-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                  </div>
               </div>
               <div class="input-field col s12">
                  <div class="switch">
                     Ocultar Footer
                     <label class="float-right"><input name="footer_ocultar" {{(Auth::user()->footer_ocultar == 1)? 'checked' : '' }} class="ocultarFooter" type="checkbox"> <span class="lever ml-0"></span></label>
                  </div>
               </div>
               <div class="input-field col s12">
                  <a id="add" class="waves-effect modal-trigger waves-light btn-large  gradient-45deg-purple-deep-purple" style="width: 100%">
                     <i class="material-icons left">save</i>Guardar Cambios
                  </a>
               </div>
            </div>
         </div>
      </form>
   </div