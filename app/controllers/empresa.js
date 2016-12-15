angular.module('app.empresa', [])

.controller('Empresa', function($scope, $http,$log,base_url, $log, $location, ngDialog, $httpParamSerializerJQLike, $timeout){
	$log.info('Load Ctrl: Empresa');

	var jquery = function() {
		$('#tags-editor-textarea').tagEditor();
    //$('.bootstrap-select').selectpicker({width: '100%'});
	}

	$scope.buscar = function(dados) {
    $log.info(dados);
    $scope.load = true;
    $scope.filtro = dados;
    $scope.load = false;
  }

  $scope.setAdd = function() {
    $scope.add = true;
  }

  $scope.cancelAdd = function() {
    $scope.add = false;
  }

  $scope.limpar = function() {
    $scope.filtro = {};
    $("option:selected").prop("selected", false)
  }

  $scope.salvar = function(data) {
  	$http({
      method: 'POST',
      url: base_url.get + '/gerencial/empresa/addEmpresa',
      data:  $httpParamSerializerJQLike(data),
      headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
      }
    })
    .success(function(data){
      $log.info(data);
      $log.info(data);
      if(!data.error) {
        $scope.dados = data;
        $scope.load = false;
      }
    })
    .error(function(data){
      $log.info(data);
      $scope.dados = data;
      $scope.load = false;
    });
  }

  $scope.request = function() {
  	request();
  }

  $scope.visualizar = function(data) {
    $log.info(data);
    $scope.editable = true;
  }

  $scope.cancelVisualizar = function() {
    $scope.editable = false;
  }

  /*var checarCampos = function(campo) {
  	$http({
			method: 'GET',
			url: base_url.get + '/gerencial/empresa/checarCampos',
		})
		.success(function(dados){
			$scope.load = false;
			$log.info(dados);
			$scope.dados = dados;
		})
		.error(function(dados){
			$log.error(dados);
			$scope.load = false;
		});
  }*/

	var request = function() {
		$scope.load = true;
		$scope.filtro = {};
		$http({
			method: 'POST',
			url: base_url.get + '/gerencial/empresa/getEmpresas',
		})
		.success(function(dados){
			$scope.load = false;
			$log.info(dados);
			$scope.dados = dados;
		})
		.error(function(dados){
			$log.error(dados);
			$scope.load = false;
		});
	}

	$scope.$watch('load', function() {
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

	request();
	jquery();
})