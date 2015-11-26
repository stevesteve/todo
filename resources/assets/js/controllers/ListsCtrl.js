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
	};

	$scope.delete = function ($event) {
		$event.stopPropagation();
		if (!confirm('Are you sure?')) {
			return;
		}
		var idToRemove = this.list.id;
		this.list.$remove(function () {
			for (var i = 0; i < $scope.lists.length; i++) {
				if ($scope.lists[i].id === idToRemove) {
					$scope.lists.splice(i,1);
					break;
				}
			};
			if ($rootScope.activeList && $rootScope.activeList.id === idToRemove) {
				$rootScope.activeList = null;
			}
		});
	};

	$scope.setActiveList = function () {
		$rootScope.activeList = this.list;
	};
}]);
