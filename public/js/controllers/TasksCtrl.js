
todoApp.controller('TasksCtrl', [
'$scope',
'$rootScope',
'Task',
function($scope,$rootScope,Task){
	$scope.newTask = {};
	$scope.creationerrors = [];
	$scope.tasks = Task.query(function () {
		console.log($scope.tasks);
	});

	$scope.create = function () {
		var task = new Task($scope.newTask);
		task.$create(function (created) {
			$scope.newTask = {};
			$scope.tasks.push(created);
			$scope.creationerrors = [];
		}, function (error) {
			$scope.creationerrors = [];
			// iterate over the validator messages and add all
			// messages to $scope.creationerrors
			for (field in error.data) {
				if (error.data.hasOwnProperty(field)) {
					var fieldErrors = error.data[field];
					console.log(fieldErrors);
					for (var j = 0; j < fieldErrors.length; j++) {
						console.log(fieldErrors[j]);
						$scope.creationerrors.push(fieldErrors[j]);
					};
				}
			}
		});
	};

	$scope.toggleDone = function () {
		this.task.done = this.task.done===1?0:1;
		// route not yet implemented
		// this.task.$save();
	};

	$rootScope.$watch('activeList', function(newValue, oldValue) {
		console.log(newValue, oldValue);
	});
}]);
