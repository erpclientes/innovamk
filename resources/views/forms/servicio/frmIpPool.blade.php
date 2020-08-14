<div id="vwIpPool" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>LISTA DE IPs</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.2rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">   
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>             
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:45px; z-index: 1; margin-top: 70px">      
                                      
                                        <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Ip Pool</label>
                                                    <select class="browser-default" id="ipPool" name="ipPool" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Elija un grupo</option>
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                               
                                     
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Lista de IPs</span>
                                              <div class="row">
                                                   
                                                  
                                                    <div class="card-content">
                                                      <form id="formHotspot" accept-charset="UTF-8" enctype="multipart/form-data">
                                                        <input type="hidden" name="cont" id="cont" value="0">
                                                        <table id="tableImportHST" class="bordered responsive-table" cellspacing="0">
                                                           <thead>
                                                              <tr>
                                                                 <th class="center">#</th>
                                                                 <th class="center">IP disponible</th>                   
                                                                 <th class="center">Estado</th>                   
                                                                 <th class="center">Acción</th>
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

  