@extends('layouts2.app')
@section('titulo','Registrar Documento')

@section('main-content')
<br>
<div id="app-5">
<div class="row" v-if="(seccion == 1)"> 
  <div class="col s12 m12 l12">
    <div class="card">
      <div class="card-header">                    
          <i class="fa fa-table fa-lg material-icons">receipt</i>
          <h2>Documentos</h2>
      </div>
      <div class="row card-header sub-header">
              <div class="col s12 m12">                         
              <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="viewCreate" data-position="top" data-delay="500" data-tooltip="Crear Nuevo Documento">
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
             <th>Long. Caracteres</th>
             <th>Fecha de Creaci&oacute;n</th>
             <th>Estado</th> 
             <th>Aci&oacute;n</th>                        
          </tr>
       </thead>
       <tbody>
         <tr v-for="documento in documentos">
           <td v-text="documento.iddocumento"></td>
           <td v-text="documento.descripcion"></td>
           <td v-text="documento.dsc_corta"></td>
           <td v-text="documento.longitud_caracteres"></td>
           <td v-text="documento.fecha_creacion"></td>
            <td v-if="documento.estado == 1"><div id="estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
              <b>ACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
            <td v-if="documento.estado == 2"><div id="estado" class="chip center-align" style="width: 70%">
              <b>INACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
           <td>
             <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Editar" v-on:click.prevent="edit(documento)">
             <i class="material-icons" style="color: #7986cb">visibility</i>
             </a>
             <a   class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-target="modal1"  data-position="top" data-delay="500" title="Eliminar" v-on:click.prevent="deleteDocumento(documento)">
             <i class="material-icons" style="color: #dd2c00">remove</i>
             </a> 
             <a v-if="documento.estado == 2" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Habilitar" v-on:click.prevent="enableDocumento(documento)">
             <i class="material-icons" style="color: #2e7d32">check</i>
             </a>
             <a v-else class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Dehabilitar" v-on:click.prevent="disableDocumento(documento)">
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
             <th>Long. Caracteres</th>
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
                    <h2>CREAR NUEVO DOCUMENTO</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createDocumento" data-position="top" data-delay="500" title="Guardar" v-if="(enviando == 1)">
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createDocumento" data-position="top" data-delay="500" title="Guardar" disabled v-else>
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
                          <span class="card-title">Datos del Documento</span>
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
                              <i class="material-icons prefix">label_outline</i>
                              <input id="longitud_caracteres" name="longitud_caracteres" type="text" minlength="1" maxlength="2" v-model="longitud_caracteres">
                              <label for="longitud_caracteres">Long. Caracteres</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.longitud_caracteres"></div> 
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
                    <h2>EDITAR DOCUMENTO</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="UpdateDocumento(fillDocumento.id)" data-position="top" data-delay="500" title="Actualizar" v-if="(enviando == 1)">
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
                          <span class="card-title">Datos del Documento</span>
                          <div class="row">                     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="e_descripcion" name="e_descripcion" type="text" minlength="1" maxlength="50" v-model="fillDocumento.descripcion">
                              <label for="e_descripcion" class="active">Descripción</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.descripcion"></div>                                
                            </div>      
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="e_dsc_corta" name="e_dsc_corta" type="text" maxlength="4" v-model="fillDocumento.dsc_corta">
                              <label for="e_dsc_corta" class="active">Abreviatura</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.dsc_corta"></div>                  
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="e_longitud_caracteres" name="e_longitud_caracteres" type="text" minlength="1" maxlength="2" v-model="fillDocumento.longitud_caracteres">
                              <label for="e_longitud_caracteres">Long. Caracteres</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.longitud_caracteres"></div> 
                            </div>                                                                
                          </div>
                        </div>
                      </div>
           
      </div>
  </div>                  
  </div>          
  </div>  
</div>

 

<div id="modal1" class="modal" style="width: 500px">
	<div class="modal-content indigo white-text center">
		<p>Está seguro que desea eliminar este registro?</p>
	</div>
	<div class="modal-footer indigo lighten-4">
		<a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
		<a   id="eliminador" class="waves-effect waves-light btn-flat modal-action modal-close">Aceptar</a>
	</div>
</div>




</div>
<br><br><br><br><br>
@endsection

@section('script')
<script type="text/javascript" >
  $(document).ready(function(){
    $('.modal').modal();
  });
      

    var app5 = new Vue({      
      el: '#app-5',
      data: {
        seccion: 1,
        descripcion: '',      
        dsc_corta: '',
        longitud_caracteres: '',     
        errors: '',
        enviando: '1',
        documentos: [], 
        fillDocumento: {id: '', descripcion: '', dsc_corta: '', longitud_caracteres: ''},
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
        this.listDocumentos();        
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
            this.listDocumentos();
          }else if(b_descripcion.length >= 4){            
          var urlBuscar = 'documento/buscar/' + b_descripcion;
          axios.get(urlBuscar).then(response => {
              this.documentos = response.data.documentos.data;
              this.pagination = response.data.pagination;  
          });
          }
        },changePage: function(page){
          this.pagination.current_page = page;
          this.listDocumentos(page);
        },
        listDocumentos: function(page){
            var urlDocumentos= 'documento/lista?page='+page;
            axios.get(urlDocumentos).then(response => {
                this.documentos = response.data.documentos.data;
                this.pagination = response.data.pagination;              
            });
        },
        viewCreate: function(){
          this.seccion = 2;          
        },
        edit: function(documento){
          this.seccion = 3;
          this.fillDocumento.id = documento.iddocumento;
          this.fillDocumento.descripcion = documento.descripcion;
          this.fillDocumento.dsc_corta = documento.dsc_corta;
          this.fillDocumento.longitud_caracteres = documento.longitud_caracteres;                  
        },
        deleteDocumento: function(documento){
            //alert("esta seguro de eliminar este documento");
            var url = 'documento/delete/' + documento.iddocumento; 
            $('#modal1').modal('open'); 
            $('#eliminador').click(function(){
              $('#modal1').modal('close'); 
              $.ajax({ 
                type:'get',
                url:url,  
                success:function(data){  
                        setTimeout(function() {
                          M.toast({ html: '<span>Registro eliminado</span>'});
                          window.location = "{{ url('/documento') }}"; 
                        }, 500); 
                  },
                  error:function(){ 
                    M.toast({ html: 'error!!!!'}); 
                  }
              }); 
           });       
        },
        disableDocumento: function(documento){
            var url = 'documento/disable/' + documento.iddocumento;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Documento Dehabilitada</span>', 1500);
                }, 100);
                this.listDocumentos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        enableDocumento: function(documento){
            var url = 'documento/enable/' + documento.iddocumento;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Documento Habilitado</span>', 1500);
                }, 100);
                this.listDocumentos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        UpdateDocumento: function(id){
            var url = 'documento/update/' + id;
            axios.put(url, {  
                descripcion: this.fillDocumento.descripcion,
                dsc_corta: this.fillDocumento.dsc_corta,
                longitud_caracteres: this.fillDocumento.longitud_caracteres,                     
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Documento Actualizado</span>', 1500);
                }, 100);
                fillDocumento= {id: '', descripcion: '', dsc_corta: '', longitud_caracteres: ''};
                this.errors = '';
                this.listDocumentos();
                this.seccion = 1;                
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });       
        },
        createDocumento: function() { 
            this.enviando = 0;           
            var url = 'documento/store';
            axios.post(url, {  
                descripcion: this.descripcion,
                dsc_corta: this.dsc_corta,
                longitud_caracteres : this.longitud_caracteres,                                                  
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Documento Registrado</span>', 1500);
                }, 100);
                this.descripcion= '';
                this.dsc_corta= '';                           
                this.errors = '';
                this.enviando = 1;
                this.listDocumentos();
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
