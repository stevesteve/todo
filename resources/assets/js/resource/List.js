todoApp.factory('List', ['$resource', function ($resource) {
	return $resource('api/lists/:id', {id: '@id'}, {
		query: { method: 'GET', isArray: true},
		get: { method: 'GET' },
		create: { method: 'POST' },
		save: { method: 'PUT' },
		remove: { method: 'DELETE' },
	});
}])

