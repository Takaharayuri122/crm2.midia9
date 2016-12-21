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

  $scope.adicionar = function() {
    ngDialog.openConfirm({
      template: 'v_AdicionarEmpresa',
      width: '45%',
      scope: $scope
    })
    .then(function(result){
      $log.info(result);
      if (result) {
        $http({
          method: 'POST',
          url: base_url.get + '/gerencial/empresa/addEmpresa',
          data:  $httpParamSerializerJQLike(result),
          headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
          }
        })
        .success(function(dados){
          $log.info(dados);
          request(20, true);
        })
        .error(function(dados){
          $log.error(dados);
          $scope.load = false;
        });
      }
      else {
        ngDialog.close();
      }
    });
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

	var request = function(limit = null, load = null) {
    /*ESSA PARTE AQUI É ONDE VOCê MANDA AO VIVO lul */
		$scope.load = load;
		$scope.filtro = {};
		$http({
			method: 'POST',
			url: base_url.get + '/gerencial/empresa/getEmpresas/'+limit,
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

  $scope.$on('ngDialog.opened', function (e, $dialog) {
    $('.select2').each(function(){
      $('.select2').selectpicker({
        width: '100%'
      });
    });
    $('#tags-editor-textarea').tagEditor();
    $('.datetimepicker-1').datetimepicker({
        widgetPositioning: {
          horizontal: 'right'
        },
        debug: false,
        format: 'YYYY-DD-MM',
        locale: 'pt-br'
      });
  });

	request(99, false);
	jquery();
})