todoApp.factory('Task', ['$resource', function ($resource) {
	return $resource('api/tasks/:id', {id: '@id'}, {
		query: { method: 'GET', isArray: true},
		get: { method: 'GET' },
		create: { method: 'POST' },
		save: { method: 'PUT' },
		remove: { method: 'DELETE' },
	});
}])

