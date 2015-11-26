var todoApp = angular.module('todoApp', [
	'ngResource',
]);

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

todoApp.controller('TasksCtrl', [
'$scope',
'$rootScope',
'Task',
'ErrorParser',
function($scope,$rootScope,Task,errorparser){
	$scope.newTask = {};
	$scope.filterTasks = { done: false };
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
		this.task.done = !this.task.done;
		this.task.$save();
	};

	$scope.toggleDoneFilter = function () {
		this.filterTasks.done = this.filterTasks.done===false?undefined:false;
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

todoApp.factory('List', ['$resource', function ($resource) {
	return $resource('api/lists/:id', {id: '@id'}, {
		query: { method: 'GET', isArray: true},
		get: { method: 'GET' },
		create: { method: 'POST' },
		save: { method: 'PUT' },
		remove: { method: 'DELETE' },
	});
}])


todoApp.factory('Task', ['$resource', function ($resource) {
	return $resource('api/tasks/:id', {id: '@id'}, {
		query: { method: 'GET', isArray: true},
		get: { method: 'GET' },
		create: { method: 'POST' },
		save: { method: 'PUT' },
		remove: { method: 'DELETE' },
	});
}])


todoApp.service('ErrorParser', [
function () {
	this.getHumanReadable = function (ValidatorResponse) {
		if (ValidatorResponse.status !== 422) {
			return ['An unexpected server error has occured'];
		}
		var errors = [];
		for (field in ValidatorResponse.data) {
			if (ValidatorResponse.data.hasOwnProperty(field)) {
				var fieldErrors = ValidatorResponse.data[field];
				for (var j = 0; j < fieldErrors.length; j++) {
					errors.push(fieldErrors[j]);
				};
			}
		}
		return errors;
	};
}
]);

//# sourceMappingURL=all.js.map
