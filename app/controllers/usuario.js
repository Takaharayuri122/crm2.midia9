angular.module('app.usuario', [])

.controller('Usuario', function($scope, $http,$log,base_url, $log, $location, ngDialog, $httpParamSerializerJQLike, $timeout){
  $log.info('Load Ctrl: Usuario');
	
  $scope.filtro = {};

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

  var request = function() {
    $scope.load = true;
    $http({
      method: 'POST',
      url: base_url.get + '/gerencial/usuario/getUsuario',
    })
    .success(function(dados){
      $log.info('dados');
      $scope.dados = dados;
      $scope.load = false;
    })
    .error(function(dados){
      $log.error(dados);
      $scope.load = false;
    });
  }

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
      url: base_url.get + '/gerencial/usuario/addUsuario',
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
        delete $scope.data;
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
    $scope.load = true;
    $http({
      method: 'POST',
      url: base_url.get + '/gerencial/usuario/getUsuario/0/'+ data,
    })
    .success(function(dados){
      $log.info(dados);
      $scope.detalhes = dados;
      $scope.load = false;
    })  
    .error(function(dados){
      $log.error(dados);
      $scope.load = false;
    });
    $scope.view = true;
    $scope.editable = false;
  }

  $scope.editar = function(data) {
    $log.info(data);
    $scope.load = true;
    $http({
      method: 'POST',
      url: base_url.get + '/gerencial/usuario/getUsuario/0/'+ data,
    })
    .success(function(dados){
      $log.info(dados);
      $scope.detalhes = dados;
      $scope.load = false;
    })  
    .error(function(dados){
      $log.error(dados);
      $scope.load = false;
    });
    $scope.editable = true;
    $scope.view = false;
  }

  $scope.cancelVisualizar = function() {
    $scope.view = false;
    $scope.editable = false
    delete $scope.detalhes;
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

	request();
	jquery();
})