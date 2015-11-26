<!DOCTYPE html>
<html ng-app="todoApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Simple Todo</title>
	<link rel="stylesheet" href="css/app.css">
</head>
<body>

	@yield('content')

	{{-- Dependencies --}}
	<script src="{{ asset('libs/angular/angular.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('libs/angular-resource/angular-resource.min.js') }}" type="text/javascript"></script>

	{{-- App Scripts --}}
	<script src="{{ asset('js/all.js') }}" type="text/javascript"></script>

</body>
</html>
