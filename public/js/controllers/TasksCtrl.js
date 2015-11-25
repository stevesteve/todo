todoApp.controller('TasksCtrl', [
'$scope',
'$rootScope',
'Task',
'ErrorParser',
function($scope,$rootScope,Task,errorparser){
	$scope.newTask = {};
	$scope.filterTasks = { done: 0 };
	$scope.creationerrors = [];

	$scope.create = function () {
		var task = new Task($scope.newTask);
		task.list_id = $rootScope.activeList.id;
		task.$create(function (created) {
			$scope.newTask = {};
			$scope.tasks.push(created);
			$scope.creationerrors = [];
		}, function (error) {
			$scope.creationerrors = errorparser.getHumanReadable(error);
		});
	};

	$scope.delete = function ($event) {
		$event.stopPropagation();
		var idToRemove = this.task.id;
		this.task.$remove(function () {
			for (var i = 0; i < $scope.tasks.length; i++) {
				if ($scope.tasks[i].id === idToRemove) {
					$scope.tasks.splice(i,1);
					break;
				}
			};
		});
	};

	$scope.toggleDone = function () {
		this.task.done = this.task.done===1?0:1;
		this.task.$save();
	};

	$scope.toggleDoneFilter = function () {
		this.filterTasks.done = this.filterTasks.done===0?undefined:0;
	};

	$rootScope.$watch('activeList', function(newValue, oldValue) {
		getListTasks();
	});

	function getListTasks () {
		if ($rootScope.activeList) {
			$scope.tasks = Task.query({
				list_id: $rootScope.activeList.id
			});
		}
	}
}]);
