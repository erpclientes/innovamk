@extends('layouts2.app')
@section('titulo','Registrar Grupo')

@section('main-content')
<br>
<div id="app-5">
<div class="row" v-if="(seccion == 1)"> 
  <div class="col s12 m12 l12">
    <div class="card">
      <div class="card-header">                    
          <i class="fa fa-table fa-lg material-icons">receipt</i>
          <h2>Grupos</h2>
      </div>
      <div class="row card-header sub-header">
              <div class="col s12 m12">                         
              <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="viewCreate" data-position="top" data-delay="500" data-tooltip="Crear Nuevo Grupo">
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
             <th>Fecha de Creaci&oacute;n</th>
             <th>Estado</th> 
             <th>Aci&oacute;n</th>                        
          </tr>
       </thead>
       <tbody>
         <tr v-for="grupo in grupos">
           <td v-text="grupo.idgrupo"></td>
           <td v-text="grupo.descripcion"></td>
           <td v-text="grupo.dsc_corta"></td>
           <td v-text="grupo.fecha_creacion"></td>
            <td v-if="grupo.estado == 1"><div id="estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
              <b>ACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
            <td v-if="grupo.estado == 2"><div id="estado" class="chip center-align" style="width: 70%">
              <b>INACTIVO</b>
              <i class="material-icons"></i>
            </div></td>
           <td>
             <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Editar" v-on:click.prevent="edit(grupo)">
             <i class="material-icons" style="color: #7986cb">visibility</i>
             </a>
             <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Eliminar" v-on:click.prevent="deleteGrupo(grupo)">
             <i class="material-icons" style="color: #dd2c00">remove</i>
             </a>
             <a v-if="grupo.estado == 2" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Habilitar" v-on:click.prevent="enableGrupo(grupo)">
             <i class="material-icons" style="color: #2e7d32">check</i>
             </a>
             <a v-else class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" title="Dehabilitar" v-on:click.prevent="disableGrupo(grupo)">
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
                    <h2>CREAR NUEVO GRUPO</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createGrupo" data-position="top" data-delay="500" title="Guardar" v-if="(enviando == 1)">
                        <i class="material-icons blue-text text-darken-2">check</i></button>
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="createGrupo" data-position="top" data-delay="500" title="Guardar" disabled v-else>
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
                          <span class="card-title">Datos del Grupo</span>
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
                    <h2>EDITAR GRUPO</h2>
                  </div>              
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                        <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="UpdateGrupo(fillGrupo.id)" data-position="top" data-delay="500" title="Actualizar" v-if="(enviando == 1)">
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
                          <span class="card-title">Datos del Grupo</span>
                          <div class="row">                     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label_outline</i>
                              <input id="e_descripcion" name="e_descripcion" type="text" minlength="1" maxlength="50" v-model="fillGrupo.descripcion">
                              <label for="e_descripcion" class="active">Descripción</label>
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.descripcion"></div>                                
                            </div>      
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">label</i>
                              <input id="e_dsc_corta" name="e_dsc_corta" type="text" maxlength="4" v-model="fillGrupo.dsc_corta">
                              <label for="e_dsc_corta" class="active">Abreviatura</label>    
                              <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.dsc_corta"></div>                            
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
        seccion: 1,
        descripcion: '',      
        dsc_corta: '',     
        errors: '',
        enviando: '1',
        grupos: [], 
        fillGrupo: {'id': '', 'descripcion': '', 'dsc_corta': ''},
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
        this.listGrupos();        
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
            this.listGrupos();
          }else if(b_descripcion.length >= 4){            
          var urlBuscar = 'grupo/buscar/' + b_descripcion;
          axios.get(urlBuscar).then(response => {
              this.grupos = response.data.grupos.data;
              this.pagination = response.data.pagination;
          });
          }
        },
        changePage: function(page){
          this.pagination.current_page = page;
          this.listGrupos(page);
        },
        listGrupos: function(page){
            var urlGrupos= 'grupo/lista?page='+page;
            axios.get(urlGrupos).then(response => {
                this.grupos = response.data.grupos.data;
                this.pagination = response.data.pagination;      
            });
        },
        viewCreate: function(){
          this.seccion = 2;          
        },
        edit: function(grupo){
          this.seccion = 3;
          this.fillGrupo.id = grupo.idgrupo;
          this.fillGrupo.descripcion = grupo.descripcion;
          this.fillGrupo.dsc_corta = grupo.dsc_corta;                 
        },
        deleteGrupo: function(grupo){
            var url = 'grupo/delete/' + grupo.idgrupo;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Grupo Eliminado</span>', 1500);
                }, 100);
                this.listGrupos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        disableGrupo: function(grupo){
            var url = 'grupo/disable/' + grupo.idgrupo;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Grupo Dehabilitado</span>', 1500);
                }, 100);
                this.listGrupos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        enableGrupo: function(grupo){
            var url = 'grupo/enable/' + grupo.idgrupo;
            axios.delete(url).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Grupo Habilitado</span>', 1500);
                }, 100);
                this.listGrupos();
            }).catch(error => {                      
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });      
        },
        UpdateGrupo: function(id){
            var url = 'grupo/update/' + id;
            axios.put(url, {  
                descripcion: this.fillGrupo.descripcion,
                dsc_corta: this.fillGrupo.dsc_corta,                     
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Grupo Actualizado</span>', 1500);
                }, 100);
                fillGrupo= {'id': '', 'descripcion': '', 'dsc_corta': ''};
                this.errors = '';
                this.listGrupos();
                this.seccion = 1;                
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });       
        },
        createGrupo: function() { 
            this.enviando = 0;           
            var url = 'grupo/store';
            axios.post(url, {  
                descripcion: this.descripcion,
                dsc_corta: this.dsc_corta,                                                  
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Grupo Registrado</span>', 1500);
                }, 100);
                this.descripcion= '';
                this.dsc_corta= '';                           
                this.errors = '';
                this.enviando = 1;
                this.listGrupos();
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
