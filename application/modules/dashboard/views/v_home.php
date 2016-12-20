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
          <!-- <?=var_dump($this->session->usuario);?> -->
	    </div><!--.container-fluid-->
	</div><!--.page-content-->

