<div class="page-content fade in hidden" ng-controller="Dashboard">
	    <div class="container-fluid">
	    		<div class="row">
	    			<div class="col-sm-2">
              <article class="statistic-box blue">
                  <div>
                    <div class="number">{{dados.le_recebidos}}</div>
                    <div class="caption"><div>Leads Recebidos</div></div>	
                  </div>
              </article>
         		</div><!--.col-->
         		<div class="col-sm-2">
              <article class="statistic-box purple">
                  <div>
                    <div class="number">{{dados.le_aberto}}</div>
                    <div class="caption"><div>Leads em Aberto</div></div>	
                  </div>
              </article>
         		</div><!--.col-->
         		<div class="col-sm-2">
              <article class="statistic-box gray">
                  <div>
                    <div class="number">{{dados.le_hoje}}</div>
                    <div class="caption"><div>Leads de Hoje</div></div>	
                  </div>
              </article>
         		</div><!--.col-->
         		<div class="col-sm-2">
              <article class="statistic-box yellow">
                  <div>
                    <div class="number">{{dados.le_negociacao}}</div>
                    <div class="caption"><div>Venda em Negociação</div></div>	
                  </div>
              </article>
         		</div><!--.col-->
         		<div class="col-sm-2">
              <article class="statistic-box green">
                  <div>
                    <div class="number">{{dados.le_efetivada}}</div>
                    <div class="caption"><div>Venda Efetivada</div></div>	
                  </div>
              </article>
         		</div><!--.col-->
         		<div class="col-sm-2">
              <article class="statistic-box red">
                  <div>
                    <div class="number">{{dados.le_perdida}}</div>
                    <div class="caption"><div>Venda Perdida</div></div>	
                  </div>
              </article>
         		</div><!--.col-->
	    		</div>
	        <div class="row">
            <div class="col-xl-12">
                <div class="chart-statistic-box">
                    <div class="chart-txt">
                        <div class="chart-txt-top">
                            <p><span class="unit">$</span><span class="number">1540</span></p>
                            <p class="caption">Week income</p>
                        </div>
                        <table class="tbl-data">
                            <tr>
                                <td class="price color-purple">120$</td>
                                <td>Orders</td>
                            </tr>
                            <tr>
                                <td class="price color-yellow">15$</td>
                                <td>Investments</td>
                            </tr>
                            <tr>
                                <td class="price color-lime">55$</td>
                                <td>Others</td>
                            </tr>
                        </table>
                    </div>
                    <div class="chart-container">
                        <div class="chart-container-in">
                            <div id="chart_div"></div>
                            <header class="chart-container-title">Income</header>
                            <div class="chart-container-x">
                                <div class="item"></div>
                                <div class="item">tue</div>
                                <div class="item">wed</div>
                                <div class="item">thu</div>
                                <div class="item">fri</div>
                                <div class="item">sat</div>
                                <div class="item">sun</div>
                                <div class="item">mon</div>
                                <div class="item"></div>
                            </div>
                            <div class="chart-container-y">
                                <div class="item">300</div>
                                <div class="item"></div>
                                <div class="item">250</div>
                                <div class="item"></div>
                                <div class="item">200</div>
                                <div class="item"></div>
                                <div class="item">150</div>
                                <div class="item"></div>
                                <div class="item">100</div>
                                <div class="item"></div>
                                <div class="item">50</div>
                                <div class="item"></div>
                            </div>
                        </div>
                    </div>
                </div><!--.chart-statistic-box-->
            </div><!--.col-->
	        </div><!--.row-->
          <!-- <?=var_dump($this->session->usuario);?> -->
	    </div><!--.container-fluid-->
	</div><!--.page-content-->

