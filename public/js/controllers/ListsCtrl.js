todoApp.controller('ListsCtrl', [
'$scope',
'$rootScope',
'List',
'ErrorParser',
function($scope,$rootScope,List,errorparser){
	$scope.newList = {};
	$scope.creationerrors = [];

	$scope.lists = List.query();

	$scope.create = function () {
		var list = new List($scope.newList);
		list.$create(function (created) {
			$scope.newList = {};
			$scope.lists.push(created);
			$scope.creationerrors = [];
		}, function (error) {
			$scope.creationerrors = errorparser.getHumanReadable(error);
		});
	}
}]);
