angular.module('app.header', [])

.controller('Header', function($scope, $log, StorageService){
	$log.info("Ctrl: Header");
	$log.info(StorageService.getAll()['0']);
	$scope.dados = StorageService.getAll()['0'];
});