angular.module('app.marketing', [])

.controller('Lead', function($scope, $http,$log,base_url, $log, $location, ngDialog, $httpParamSerializerJQLike, $filter){
	$scope.filtro = {};
  

  $scope.$watch('load', function() {
  		$log.info($scope.load);
      if (!$scope.load){
        ngDialog.close();
        $('.page-content').removeClass('hidden');
      }
      else {
         ngDialog.open({
          template: '<div class="alert alert-success alert-no-border alert-close alert-dismissible fade in text-center" role="alert">' +
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                      '</button>' +
                      '<i class="fa fa-refresh  fa-spin fa-2x fa-fw"></i> Aguarde, carregando informações.' +
                    '</div>', 
          plain: true,
          showClose: false,
          /*closeByDocument : false,*/
          width:'25%'
        });
      }
  });

  $scope.$watch('filtro', function(){
    $log.warn($scope.filtro);
  });

  var request = function(limit = null, load = null) {
    if(load)$scope.load = true;
    if(!load)$scope.load = false;
    $http({
      method: 'POST',
      url: base_url.get + '/marketing/Lead/getLeads/' + limit,
    })
    .success(function(dados){
      $log.info(dados);
      $scope.dados = dados;
     	$scope.load = false;
      $('.select2').not('.manual').select2();
    })
    .error(function(dados){
      $log.error(dados);
      $scope.load = false;
    });
  }

  $scope.limpar = function() {
    $scope.filtro = {};
    $("option:selected").prop("selected", false);
    $('input').val('');
  }

  $scope.novoLead = function() {
    ngDialog.open({ 
      template: 'v_cadastroLead' ,
      scope: $scope,
      width: '65%'
    });
    $scope.load = false;
  }

  $scope.buscar = function(dados) {
    $log.info(dados);
  }

  $scope.interacaoLead = function(id) {
    $scope.INT_CodigoLead = id;
    ngDialog.open({ 
      template: 'v_interacaoLead' ,
      scope: $scope,
      width: '65%',
    });
    $log.info($scope.inte);
    $scope.load = false;
  }

  $scope.createInteracao = function(msg) {
    $http({
      method: 'POST',
      url: base_url.get + '/marketing/Lead/interacao/'+ $scope.INT_CodigoLead + '/' + msg + '/' + 10,
    })
    .success(function(dados){
      $log.info(dados);
      request(20, false);
    })
    .error(function(dados){
      $log.error(dados);
      $scope.load = false;
    });
  }

  $scope.setLeadStatus = function(id, status, statusNome, template = null) {
    if(!template) template = 'v_infoAlert';
    $scope.load = true;
    $scope.leadStatus = statusNome;
    $scope.class = 'warning';
    ngDialog.openConfirm({ 
      template: template ,
      scope: $scope,
      width: '25%'
    }).then(function(result){
      $http({
        method: 'POST',
        url: base_url.get + '/marketing/Lead/setStatusLead/'+ id + '/' + status + '/' + result,
      })
      .success(function(dados){
        $log.info(dados);
        request(20, true);
      })
      .error(function(dados){
        $log.error(dados);
        $scope.load = false;
      });
    });
    $scope.load = false;
  }

  $scope.salvarLead = function(data) {
    $http({
      method: 'POST',
      url: base_url.get + '/marketing/lead/addLead',
      data:  $httpParamSerializerJQLike(data),
      headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
      }
    })
    .success(function(data){
      /*$log.info(data);*/
      if(!data.error) {
        $scope.dados = data;
        $scope.add = false;
        ngDialog.close();
      }
    })
    .error(function(data){
      $log.info(data);
      $scope.dados = data;
      ngDialog.close();
    });
  }

  $scope.visualzarLead = function(data) {
    var detalhe = $filter('filter')($scope.dados.leads, data);
    $scope.detalhe = detalhe[0];
    $log.info($scope.detalhe);

    ngDialog.open({ 
      template: 'v_visualizarLead' ,
      scope: $scope,
      width: '65%'
    });
    $scope.load = false;
  }

  $scope.requestAll = function() {
    $scope.class = 'danger';
    ngDialog.openConfirm({
      template: 'v_infoAlertRequestAll' ,
      scope: $scope,
      width: '25%'
    })
    .then(function(result){
      if (result == 1) {
        request();
      }
      else {
        ngDialog.close();
      }
    });
  }

  $scope.$on('ngDialog.opened', function (e, $dialog) {
    $('#select2').each(function(){
      $('#select2').selectpicker({
        width: '100%'
      });
    });
    $('.datetimepicker-1').datetimepicker({
        widgetPositioning: {
          horizontal: 'right'
        },
        debug: false,
        format: 'YYYY-DD-MM',
        locale: 'pt-br'
      });
  });

  request(20, true);
});