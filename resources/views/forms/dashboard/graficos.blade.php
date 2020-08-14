<div id="chart-dashboard">

              <div class="row">
                <div class="col s12">
                    <div class="divider"></div>
                    <h4 class="header">Actividad de la red</h4>
                </div>
                <div class="col s12 m8 l8">
                  <div class="card">
                    <div class="card-move-up waves-effect waves-block waves-light">
                      <div class="move-up cyan darken-1">
                        <div>
                          <span class="chart-title white-text">Revenue</span>
                          <div class="chart-revenue cyan darken-2 white-text">
                            <p class="chart-revenue-total">$4,500.85</p>
                            <p class="chart-revenue-per">
                              <i class="material-icons">arrow_drop_up</i> 21.80 %</p>
                          </div>
                          <div class="switch chart-revenue-switch right">
                            <label class="cyan-text text-lighten-5">
                              Month
                              <input type="checkbox">
                              <span class="lever"></span> Year
                            </label>
                          </div>
                        </div>
                        <div class="trending-line-chart-wrapper">
                          <canvas id="trending-line-chart" height="163" width="702" style="width: 562px; height: 131px;"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="card-content">
                      <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                        <i class="material-icons activator">filter_list</i>
                      </a>
                      <div class="col s12 m3 l3">
                        <div id="doughnut-chart-wrapper">
                          <canvas id="doughnut-chart" height="101" width="152" style="width: 122px; height: 81px;"></canvas>
                          <div class="doughnut-chart-status">4500
                            <p class="ultra-small center-align">Sold</p>
                          </div>
                        </div>
                      </div>
                      <div class="col s12 m2 l2">
                        <ul class="doughnut-chart-legend">
                          <li class="mobile ultra-small">
                            <span class="legend-color"></span>Mobile</li>
                          <li class="kitchen ultra-small">
                            <span class="legend-color"></span> Kitchen</li>
                          <li class="home ultra-small">
                            <span class="legend-color"></span> Home</li>
                        </ul>
                      </div>
                      <div class="col s12 m5 l6">
                        <div class="trending-bar-chart-wrapper">
                          <canvas id="trending-bar-chart" height="81" width="272" style="width: 218px; height: 65px;"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Revenue by Month
                        <i class="material-icons right">close</i>
                      </span>
                      <table class="responsive-table">
                        <thead>
                          <tr>
                            <th data-field="id">ID</th>
                            <th data-field="month">Month</th>
                            <th data-field="item-sold">Item Sold</th>
                            <th data-field="item-price">Item Price</th>
                            <th data-field="total-profit">Total Profit</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>January</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>February</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>March</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>April</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>May</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>June</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>July</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>August</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>Septmber</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>Octomber</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>11</td>
                            <td>November</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                          <tr>
                            <td>12</td>
                            <td>December</td>
                            <td>122</td>
                            <td>100</td>
                            <td>$122,00.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col s12 m4 l4">
                  <div class="card">
                    <div class="card-move-up teal accent-4 waves-effect waves-block waves-light">
                      <div class="move-up">
                        <p class="margin white-text">Browser Stats</p>
                        <canvas id="trending-radar-chart" height="137" width="362" style="width: 290px; height: 110px;"></canvas>
                      </div>
                    </div>
                    <div class="card-content  teal">
                      <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                        <i class="material-icons activator">done</i>
                      </a>
                      <div class="line-chart-wrapper">
                        <p class="margin white-text">Revenue by country</p>
                        <canvas id="line-chart" height="123" width="327" style="width: 262px; height: 99px;"></canvas>
                      </div>
                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">Revenue by country
                        <i class="material-icons right">close</i>
                      </span>
                      <table class="responsive-table">
                        <thead>
                          <tr>
                            <th data-field="country-name">Country Name</th>
                            <th data-field="item-sold">Item Sold</th>
                            <th data-field="total-profit">Total Profit</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>USA</td>
                            <td>65</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>UK</td>
                            <td>76</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>Canada</td>
                            <td>65</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>Brazil</td>
                            <td>76</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>India</td>
                            <td>65</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>France</td>
                            <td>76</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>Austrelia</td>
                            <td>65</td>
                            <td>$452.55</td>
                          </tr>
                          <tr>
                            <td>Russia</td>
                            <td>76</td>
                            <td>$452.55</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>