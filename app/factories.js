angular.module('app.factories',[])
.factory('base_url', function(){
	return {
		get: 'http://localhost/crm2.midia9'
	}
})

.factory ('StorageService', function ($localStorage) {
  
  var _set = function() {
    $localStorage = $localStorage.$default({
      things: []
    });
  };

  var _getAll = function () {
    return $localStorage.things;
  };
  var _add = function (thing) {
    $localStorage.things.push(thing);
  }
  var _remove = function (thing) {
    $localStorage.things.splice($localStorage.things.indexOf(thing), 1);
  }
  return {
    set: _set,
    getAll: _getAll,
    add: _add,
    remove: _remove
  };
})
