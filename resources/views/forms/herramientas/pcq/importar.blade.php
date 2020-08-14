<div id="iPCQ" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>IMPORTAR CLIENTES PCQ</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="ImportPCQ" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          <a id="pcq_i_allCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Seleccionar todo">
                                            <i class="material-icons " style="color: #4a148c">radio_button_checked</i></a>
                                          <a id="pcq_i_clearCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Quitar checkeds">
                                            <i class="material-icons " style="color: #616161">radio_button_unchecked</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          <a id="getPCQ" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Traer Clientes PCQ">
                                            <i class="material-icons " style="color: #4a148c">vertical_align_bottom</i></a>
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  
           
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
                                      
                                     
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Clientes PCQ</span>
                                              <div class="row">
                                                   
                                                  
                                                    <div class="card-content">
                                                      <form id="formPCQ" accept-charset="UTF-8" enctype="multipart/form-data">
                                                        <input type="hidden" name="cont" id="pcq_cont" value="0">
                                                        <input type="hidden" name="id_router" id="pcq_idrouter" value="0">
                                                        <input type="hidden" name="pcq_idtipo" id="pcq_idtipo" value="0">
                                                        <input type="hidden" name="pcq_forma_pago" id="pcq_forma_pago" value="0">
                                                        <input type="hidden" name="pcq_doc_venta" id="pcq_doc_venta" value="0">
                                                        <input type="hidden" name="pcq_moneda" id="pcq_moneda" value="0">
                                                        <input type="hidden" name="pcq_dia_pago" id="pcq_dia_pago" value="0">
                                                        <input type="hidden" name="pcq_aviso" id="pcq_aviso" value="0">
                                                        <input type="hidden" name="pcq_corte" id="pcq_corte" value="0">
                                                        <input type="hidden" name="pcq_frecuencia" id="pcq_frecuencia" value="0">
                                                        <input type="hidden" name="pcq_fecha_factura" id="pcq_fecha_factura" value="0">
                                                        <input type="hidden" name="pcq_glosa" id="pcq_glosa" value="0">
                                                        <table id="tableImportPCQ" class="bordered responsive-table" cellspacing="0">
                                                           <thead>
                                                              <tr>
                                                                 <th class="center">Check</th>
                                                                 <th>Lista</th>
                                                                 <th style="width: 8rem">Usuario</th>
                                                                 <th>Dirección IP</th>
                                                                 <th style="width: 9rem">Perfil Internet</th>
                                                                 <th class="center" style="width: 6rem">Precio</th>                      
                                                                 <th class="center">Estado</th>
                                                              </tr>
                                                           </thead>
                                                          
                                                           
                                                           <tbody>                                                           
                                                            
                                                           </tbody>
                                                        </table>
                                                      </form>
                                                      </div> 

                                              </div> 
                                            </div>
                                        </div>                                        
                                            

                                    </div>   
                                  

              </div>
              
            </div>

  