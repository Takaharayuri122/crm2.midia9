angular.module('app.usuario', [])

.controller('Usuario', function($scope, $http,$log,base_url, $log, $location, ngDialog, $httpParamSerializerJQLike, $timeout, $filter){
  $log.info('Load Ctrl: Usuario');
	
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

  var request = function(limit = null, load = null) {
    if(load)$scope.load = true;
    if(!load)$scope.load = false;
    $http({
      method: 'POST',
      url: base_url.get + '/gerencial/usuario/getUsuario/' + limit,
    })
    .success(function(dados){
      $log.info(dados);
      $scope.load = false;
      $scope.dados = dados;
      $('.select2').not('.manual').select2();
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
    var detalhe = $filter('filter')($scope.dados.usuarios, data);
    $scope.detalhes = detalhe[0];
    $log.info($scope.detalhes);

    ngDialog.openConfirm({ 
      template: 'v_visualizarUsuario' ,
      scope: $scope,
      width: '65%'
    })
    .then(function(result){
      if(result){

      }
      else {
        ngDialog.close();
      }
    });
  }

  $scope.setStatus = function(id, status, alertText, template = null) {
    if(!template) template = 'v_infoAlert';
    $scope.alertText = alertText;
    $scope.class = 'warning';
    ngDialog.openConfirm({ 
      template: template ,
      scope: $scope,
      width: '25%'
    }).then(function(result){
      $http({
        method: 'POST',
        url: base_url.get + '/gerencial/usuario/setStatus/'+ id + '/' + status
      })
      .success(function(dados){
        $log.info(dados);
        request(null, true);
      })
      .error(function(dados){
        $log.error(dados);
        $scope.load = false;
      });
    });
    $scope.load = false;
  }

  $scope.editar = function(data) {
    $scope.detalhes = {};
    $scope.alterarSenhaVar = 0; 
    var detalhe = $filter('filter')($scope.dados.usuarios, data);
    $scope.detalhes = detalhe[0];
    $log.info($scope.detalhes);
    ngDialog.openConfirm({ 
      template: 'v_editarUsuario' ,
      scope: $scope,
      width: '50%'
    })
    .then(function(result){
      delete result['$$hashKey'];
      delete result['EMP_RazaoSocial'];
      $http({
        method: 'POST',
        url: base_url.get + '/gerencial/usuario/update',
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
    });
  }

  $scope.adicionar = function(data) {
    $scope.detalhes = {};
    ngDialog.openConfirm({
      template: 'v_adicionarUsuario',
      width: '50%',
      scope: $scope
    })
    .then(function(result){
      if (result) {
        $http({
          method: 'POST',
          url: base_url.get + '/gerencial/usuario/addUsuario',
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

  $scope.alterarSenha = function(data) {
    if (data) {
      $scope.alterarSenhaVar = 1;
    }
    else {
     $scope.alterarSenhaVar = 0; 
    }
  }

  $scope.cancelVisualizar = function() {
    $scope.view = false;
    $scope.editable = false
    delete $scope.detalhes;
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

	request(99, false);
	jquery();
})