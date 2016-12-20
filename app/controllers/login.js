angular.module('app.login', ['app.factories', 'ngDialog', 'ngStorage'])

.controller('Login', function($scope, $http,$log, $httpParamSerializerJQLike, base_url, $log, $location, StorageService) {
	$log.info('Ctrl: Login');
	StorageService.set();
	StorageService.remove();
	$scope.Login = function(dados) {
		$log.info('Fct: Login');
		$http({
			method: 'POST',
			url: base_url.get + '/login/auth',
				data:  $httpParamSerializerJQLike(dados),
				headers: {
	      'Content-Type': 'application/x-www-form-urlencoded'
	    	}
		})
		.success(function(dados){
			if (dados.error) {
				$scope.retorno = dados.error;
				
			}
			else {
				$log.info(dados);
				StorageService.add(dados);
				location.reload();
			}
		})
		.error(function(dados){
			$log.error(dados);
		});
	}
});