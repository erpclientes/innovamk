@extends('layouts2.app')
@section('titulo','Registrar Doc. Venta')

@section('main-content')
<br>
<div id="app-5">  
<div class="row" v-if="(seccion == 1)"> 
  <div class="col s12 m12 l12">
    <div class="card">
      <div class="card-header">                    
          <i class="fa fa-table fa-lg material-icons">receipt</i>
          <h2>Doc. de Ventas</h2>
      </div>
      <div class="row card-header sub-header">
              <div class="col s12 m12">                         
              <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="viewCreate" data-position="top" data-delay="500" data-tooltip="Crear Nuevo Doc. Venta">
              <i class="material-icons blue-text text-darken-2">add_circle</i></button>     
              </div>                         
        </div> 
 <div class="row cuerpo">                               
    <div class="col s12 m6 l6">
    Existen @{{pagination.total}} Registros.
    </div>
    <div class="col s12 m6 l6">                                    
        <div class="row rigth-align">                      
          <div class="input-field col col s12 m5 l4 right">
            <input id="busqueda" name="busqueda" type="text" class="validate" v-model="b_descripcion" @keyup="buscar(b_descripcion)">
            <label for="busqueda rigth-align">Buscar</label>                    
          </div>
        </div>         
    </div>
    <div class="card-content">
      <table class="responsive-table striped display" cellspacing="0">
         <thead>
          <tr>
             <th>#</th>
             <th>Descripci&oacute;n</th>
             <th>Abreviatura</th>
             <th>Serie</th>
             <th>Correlativo</th>
             <th>BOLETA</th>
             <th>FACTURA</th>
             <th>PROFORMA</th>            
             <th>Fecha de Creaci&oacute;n</th>
             <th>Estado</th> 
             <th>Aci&oacute;n</th>                        
          </tr>
       </thead>
       <tbody>
         <tr v-for="doc_venta in doc_ventas">
           <td v-text="doc_venta.iddocumento"></td>
           <td v-text="doc_venta.descripcion"></td>
           <td v-text="doc_venta.dsc_corta"></td>
           <td v-text="doc_venta.serie"></td>  
           <td v-text="doc_venta.correlativo"></td>  

          <td v-if="doc_venta.es_boleta == 1">
            <i class="material-icons" style="color: #2e7d32">check</i>
          </td>
          <td v-else>  
            <i class="material-icons" style="color: #757575">clear</i>  
          </td>

          <td v-if="doc_venta.es_factura == 1">  
            <i class="material-icons" style="color: #2e7d32">check</i>  
          </td> 
          <td v-else>  
            <i class="material-icons" style="color: #757575">clear</i>  
          </td>

          <td v-if="doc_venta.es_proforma == 1">  
            <i class="material-icons" style="color: #2e7d32">check</i>  
          </td> 
          <td v-else>  
            <i class="material-icons" style="color: #757575">clear</i>  
          </td>
             
          
          
           <td v-text="doc_venta.fecha_creacion"></td>
            <td v-if="doc_venta.estado == 1"><div id="estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
              <b>ACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
            <td v-if="doc_venta.estado == 2"><div id="estado" class="chip center-align" style="width: 70%">
              <b>INACTIVO</b>
              <i class="material-icons"></i>
            </div></td> 
           <td>
             <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Editar" v-on:click.prevent="edit(doc_venta)">
             <i class="material-icons" style="color: #7986cb">visibility</i>
             </a>
             <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Eliminar" v-on:click.prevent="deleteDocVenta(doc_venta)">
             <i class="material-icons" style="color: #dd2c00">remove</i>
             </a>
             <a v-if="doc_venta.estado == 2" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Habilitar" v-on:click.prevent="enableDocVenta(doc_venta)">
             <i class="material-icons" style="color: #2e7d32">check</i>
             </a>
             <a v-else class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Dehabilitar" v-on:click.prevent="disableDocVenta(doc_venta)">
             <i class="material-icons" style="color: #757575">clear</i>
             </a>            
           </td>
         </tr>
       </tbody>     
       <tfoot>
          <tr>
             <th>#</th>
             <th>Descripci&oacute;n</th>
             <th>Abreviatura</th>
             <th>Serie</th>
             <th>Correlativo</th>
             <th>BOLETA</th>
             <th>FACTURA</th>
             <th>PROFORMA</th> 
             <th>Fecha de Creaci&oacute;n</th>
             <th>Estado</th> 
             <th>Aci&oacute;n</th>              
          </tr>
        </tfoot>
      </table>
      <ul class="pagination">
        <li class="waves-effect" v-if="pagination.current_page > 1"><a href="#!" @click.prevent="changePage(pagination.current_page - 1)"><span>Atras</span></a></li>
        
        <li v-for="page in pagesNumber" :class="[ page == isActived ? 'active' : '']" ><a href="#!" @click.prevent="changePage(page)">@{{page}}</a></li>
               
        <li class="waves-effect" v-if="pagination.current_page < pagination.last_page"><a href="#!" @click.prevent="changePage(pagination.current_page + 1)"><span>Siguiente</span></a></li>
      </ul>       
    </div>
  </div>
</div>
  </div>
</div>
<div class="row" v-if="(seccion == 2)">
  <div class="col s12 m12 l12">
                 <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>CREAR NUEVO DOC. DE VENTAS</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createDocVenta" data-position="top" data-delay="500" title="Guardar" v-if="(enviando == 1)">
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createDocVenta" data-position="top" data-delay="500" title="Guardar" disabled v-else>
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>                   
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-activates="dropdown2" data-position="top" data-delay="500" title="Regresar" v-on:click.prevent="(seccion = 1)">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>
                        </div>                         
                  </div>                                   
  <div class="row">
      <div class="col s12 m12 l12">          
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos del DocVenta</span>
                          <div class="row">                     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="descripcion" name="descripcion" type="text" minlength="1" maxlength="50" v-model="descripcion">
                              <label for="descripcion">Descripci&oacute;n</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.descripcion"></div>      
                            </div>      
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="dsc_corta" name="dsc_corta" type="text" maxlength="4" v-model="dsc_corta">
                              <label for="dsc_corta">abreviatura</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.dsc_corta"></div>    
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="serie" name="serie" type="text" maxlength="4" v-model="serie">
                              <label for="serie">Serie</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.serie"></div>    
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="correlativo" name="correlativo" type="text" maxlength="8" v-model="correlativo">
                              <label for="correlativo">Corelativo</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.correlativo"></div>    
                            </div>
                            <div class="col s12 m6 l6">
                              <label for="doc_venta">DocVenta del Equipo</label>  

                              <p>
                                <label>
                                  <input type="checkbox" id="boleta" class="filled-in" v-model="m_boleta"  checked="checked" />
                                  <span for="boleta">Boleta</span>
                                </label>
                              </p>
                              <p>
                                <label>
                                  <input type="checkbox" class="filled-in" id="factura" v-model="m_factura" checked="checked" />
                                  <span  for="factura">Factura</span>
                                </label>
                              </p>
                              <p>
                                <label>
                                  <input type="checkbox" class="filled-in" id="proforma" v-model="m_proforma" checked="checked" />
                                  <span  for="proforma">Proforma</span>
                                </label>
                              </p>                         
                            </div> 
                          </div>
                        </div>
                      </div>           
      </div>
  </div>                  
  </div>          
  </div>  
</div>

<div class="row" v-if="(seccion == 3)">
  <div class="col s12 m12 l12">
                 <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>EDITAR DOC. DE VENTAS</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="UpdateDocVenta(fillDocVenta.id)" data-position="top" data-delay="500" title="Actualizar" v-if="(enviando == 1)">
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Actualizar" disabled v-else>
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>                   
                          <a class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-activates="dropdown2" data-position="top" data-delay="500" title="Regresar" v-on:click.prevent="(seccion = 1)">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>
                        </div>                         
                  </div>
                                    
  <div class="row">
      <div class="col s12 m12 l12">
          
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos del Doc. de Ventas</span>
                          <div class="row">                     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="e_descripcion" name="e_descripcion" type="text" minlength="1" maxlength="50" v-model="fillDocVenta.descripcion">
                              <label for="e_descripcion" class="active">Descripción</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.descripcion"></div>                                
                            </div>      
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="e_dsc_corta" name="e_dsc_corta" type="text" maxlength="4" v-model="fillDocVenta.dsc_corta">
                              <label for="e_dsc_corta" class="active">Abreviatura</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.dsc_corta"></div>        
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="e_serie" name="e_serie" type="text" maxlength="4" v-model="fillDocVenta.serie">
                              <label for="e_serie" class="active">Serie</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.serie"></div>        
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="e_correlativo" name="e_correlativo" type="text" maxlength="8" v-model="fillDocVenta.correlativo">
                              <label for="e_correlativo" class="active">Correlativo</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.correlativo"></div>        
                            </div>
                            <div class="col s12 m6 l6">
                              <label for="dsc_corta">DocVenta del Equipo</label>
                              <p>
                                <label>
                                  <input type="checkbox" id="e_boleta" class="filled-in" v-model="fillDocVenta.m_boleta"  checked="checked" />
                                  <span for="e_boleta">Boleta</span>
                                </label>
                              </p>
                              <p>
                                <label>
                                  <input type="checkbox" class="filled-in" id="e_factura" v-model="fillDocVenta.m_factura" checked="checked" />
                                  <span  for="e_factura">Factura</span>
                                </label>
                              </p> 
                              <p>
                                <label>
                                  <input type="checkbox" class="filled-in" id="e_proforma" v-model="fillDocVenta.m_proforma" checked="checked" />
                                  <span  for="e_proforma">Proforma</span>
                                </label>
                              </p>                       
                            </div>                                                                
                          </div>
                        </div>
                      </div>
           
      </div>
  </div>                  
  </div>          
  </div>  
</div>

</div>
<br><br><br><br><br>
@endsection

@section('script')
<script type="text/javascript" >

    var app5 = new Vue({      
      el: '#app-5',
      data: {
        m_boleta: false,
        m_factura: false,
        m_proforma: false, 
        seccion: 1,
        descripcion: '',      
        dsc_corta: '',
        serie: '',
        correlativo: '',     
        errors: '',
        enviando: '1',
        doc_ventas: [], 
        fillDocVenta: {id: '', descripcion: '', dsc_corta: '', serie: '', correlativo: '', m_boleta: false, m_factura: false, m_proforma: false},
        b_descripcion: '',
        offset: 2,
        pagination: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0,
        },          
      },
      created: function () {        
        this.listDocVentas();        
      },
      computed: {
        isActived: function(){
          return this.pagination.current_page;
        },
        pagesNumber: function(){
          if(!this.pagination.to){
            return [];
          }

          var from = this.pagination.current_page - this.offset; 
          if(from < 1){
              from = 1;
          }

          var to = from + (this.offset * 2); 
          if(to >= this.pagination.last_page){
              to = this.pagination.last_page;
          }

          var pagesArray = [];
          while(from <= to){
            pagesArray.push(from);
            from++;
          }
          return pagesArray;
        }
      },
      methods: {
        buscar: function(b_descripcion){
          if(b_descripcion == '')
          {
            this.listDocVentas();
          }else if(b_descripcion.length >= 4){            
          var urlBuscar = 'documentoVenta/buscar/' + b_descripcion;
          axios.get(urlBuscar).then(response => {
              this.doc_ventas = response.data.documentos.data;
              this.pagination = response.data.pagination;             
          });
          }
        },
        changePage: function(page){
          this.pagination.current_page = page;
          this.listDocVentas(page);
        },
        listDocVentas: function(page){
            var urlDocVentas= 'documentoVenta/lista?page='+page;
            axios.get(urlDocVentas).then(response => {
                this.doc_ventas = response.data.documentos.data;
                this.pagination = response.data.pagination;              
            });
        },
        viewCreate: function(){
          this.seccion = 2;          
        },
        deleteDocVenta: function(doc_venta){
            var url = 'documentoVenta/delete/' + doc_venta.iddocumento;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Doc. de Venta Eliminado</span>', 1500);
                }, 100);
                this.listDocVentas();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        disableDocVenta: function(doc_venta){
            var url = 'documentoVenta/disable/' + doc_venta.iddocumento;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Doc. de Venta Dehabilitado</span>', 1500);
                }, 100);
                this.listDocVentas();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        enableDocVenta: function(doc_venta){
            var url = 'documentoVenta/enable/' + doc_venta.iddocumento;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Doc. de Venta Habilitado</span>', 1500);
                }, 100);
                this.listDocVentas();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        edit: function(doc_venta){
          this.seccion = 3;
          this.fillDocVenta.id = doc_venta.iddocumento;
          this.fillDocVenta.descripcion = doc_venta.descripcion;
          this.fillDocVenta.dsc_corta = doc_venta.dsc_corta;
          this.fillDocVenta.serie = doc_venta.serie;
          this.fillDocVenta.correlativo = doc_venta.correlativo;
          this.fillDocVenta.m_boleta = ((doc_venta.es_boleta == 1) ? true : false);
          this.fillDocVenta.m_factura = ((doc_venta.es_factura == 1) ? true : false);
          this.fillDocVenta.m_proforma = ((doc_venta.es_proforma == 1) ? true : false);

          
        },
        UpdateDocVenta: function(id){
            var url = 'documentoVenta/update/' + id;
            axios.put(url, {  
                descripcion: this.fillDocVenta.descripcion,
                dsc_corta: this.fillDocVenta.dsc_corta,
                serie: this.fillDocVenta.serie,
                correlativo: this.fillDocVenta.correlativo,
                m_boleta: this.fillDocVenta.m_boleta,
                m_factura: this.fillDocVenta.m_factura,  
                m_proforma: this.fillDocVenta.m_proforma,
                                                 
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Doc. de Venta Actualizado</span>', 1500);
                }, 100);
                fillDocVenta= {'id': '', 'descripcion': '', 'dsc_corta': ''};
                this.errors = '';
                this.listDocVentas();
                this.seccion = 1;                
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });       
        },
        createDocVenta: function() { 
            this.enviando = 0;           
            var url = 'documentoVenta/store';
            axios.post(url, {  
                descripcion: this.descripcion,
                dsc_corta: this.dsc_corta, 
                serie: this.serie,
                correlativo: this.correlativo,              
                m_boleta: this.m_boleta,
                m_factura: this.m_factura,  
                m_proforma: this.m_proforma,  
                                                                            
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Doc. de Venta Registrado</span>', 1500);
                }, 100);
                this.descripcion= '';
                this.dsc_corta= '';
                this.serie= '';
                this.correlativo= '';
                this.m_boleta= '';
                this.m_factura= '';
                this.m_proforma= '';                                                  
                this.errors = '';
                this.enviando = 1;
                this.listDocVentas();
                this.seccion = 1;
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });
        }
       }
    })   
</script>                             
@endsection
