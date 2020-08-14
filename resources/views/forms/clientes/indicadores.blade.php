<div class="col s12 m6 l4">
    <div class="card light-blue lighten-2 gradient-shadow min-height-100 white-text">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5">note</i>
              <p>Comprobantes</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0" style="color: white">{{count($comprobantes)}}</h4>
              <p class="no-margin">Pendientes</p>
              <p></p>
            </div>
          </div>
      </div>
  </div>
  <div class="col s12 m6 l4">
    <div class="card green lighten-2 gradient-shadow min-height-100 white-text">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5">add_alarm</i>
              <p>Avisos en pantalla</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0" style="color: white">+{{count($avisos)}}</h4>
              <p class="no-margin">Activos</p>
              <p></p>
            </div>
          </div>
      </div>
  </div>
  <div class="col s12 m6 l4">
    <div class="card red lighten-2 gradient-shadow min-height-100 white-text">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5">not_interested</i>
              <p>Suspendidos</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0" style="color: white">-{{count($suspendidos)}}</h4>
              <p class="no-margin">clientes</p>
              <p></p>
            </div>
          </div>
      </div>
  </div>