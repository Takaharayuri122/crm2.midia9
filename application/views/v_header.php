<header class="site-header" ng-controller="Header">
  <div class="container-fluid">

      <a href="#" class="site-logo">
          <img class="hidden-md-down" src="<?=base_url('assets')?>/image/logo.png" alt="">
          <img class="hidden-lg-up" src="<?=base_url('assets')?>/image/logo-mob.png" alt="">
      </a>

      <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
          <span>toggle menu</span>
      </button>

      <button class="hamburger hamburger--htla">
          <span>toggle menu</span>
      </button>

      <div class="site-header-content">
        <div class="site-header-content-in">
            <div class="site-header-shown">
                <div class="dropdown user-menu">
                    <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?=base_url('assets')?>/img/avatar-2-64.png" alt="">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                      <!-- <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a> -->
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?=base_url('login/sair')?>"><span class="font-icon glyphicon glyphicon-log-out"></span>Sair</a>
                    </div>
                </div>
                <button type="button" class="burger-right">
                    <i class="font-icon-menu-addl"></i>
                </button>
            </div>
            <div class="mobile-menu-right-overlay"></div>
            <div class="site-header-collapsed">
                <div class="site-header-collapsed-in">
                  <div class="dropdown dropdown-typical col-lg-4">
                     <fieldset class="form-group">
												<select class="select2" ng-model="filtro.LE_Status" data-width="100%">
													<option value="">Alterar Empresa</option>
													<option ng-repeat="row in dados.empresa" value="{{row.EMP_CodigoEmpresa}}">{{row.EMP_RazaoSocial}}</option>
												</select>
											</fieldset>
										</div>
                  </div>
                </div><!--.site-header-collapsed-in-->
            </div><!--.site-header-collapsed-->
        </div><!--site-header-content-in-->
      </div><!--.site-header-content-->
  </div><!--.container-fluid-->
</header><!--.site-header-->