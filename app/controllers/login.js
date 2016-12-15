angular.module('app.login', ['app.factories', 'ngDialog'])

.controller('Login', function($scope, $http,$log, $httpParamSerializerJQLike, base_url, $log, $location) {
	$log.info('Ctrl: Login');

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
				location.reload();
			}
		})
		.error(function(dados){
			$log.error(dados);
		});
	}
});