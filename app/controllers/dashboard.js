angular.module('app.dashboard', [])

.controller('Dashboard', function($scope, $http,$log,base_url, $log, $location, ngDialog, StorageService){
	$log.info('Load Ctrl: Dashboard');

	var request = function() {
		$http({
			method: 'POST',
			url: base_url.get + '/dashboard/getDashboardInfos',
		})
		.success(function(dados){
			$log.info(dados);
			$scope.dados = dados;
			$scope.load = false;
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
          template: '<div class="alert alert-primary alert-fill alert-close alert-dismissible fade in" role="alert">' +
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
								'<span aria-hidden="true">×</span>' +
							'</button>' +
							'Carregando informações, aguarde.' +
						'</div>',
          plain: true,
          showClose: false,
          closeByDocument : false,
          width:'23%'
        });
      }
  });

	request();

})