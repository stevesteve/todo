
todoApp.controller('TasksCtrl', [
'$scope',
'$rootScope',
'Task',
'ErrorParser',
function($scope,$rootScope,Task,errorparser){
	$scope.newTask = {};
	$scope.filterTasks = { done: '0' };
	$scope.creationerrors = [];
	$scope.tasks = Task.query();

	$scope.create = function () {
		var task = new Task($scope.newTask);
		task.$create(function (created) {
			$scope.newTask = {};
			$scope.tasks.push(created);
			$scope.creationerrors = [];
		}, function (error) {
			$scope.creationerrors = errorparser.getHumanReadable(error);
			
		});
	};

	$rootScope.$watch('activeList', function(newValue, oldValue) {
		console.log(newValue, oldValue);
	});
}]);
