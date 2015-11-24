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
					console.log(fieldErrors[j]);
					errors.push(fieldErrors[j]);
				};
			}
		}
		return errors;
	};
}
]);
