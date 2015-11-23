@extends('layouts.app')

@section('content')

	<div id="listspanel" ng-controller="ListsCtrl">
		<ul>
			<li></li>
		</ul>
	</div>
	<div id="taskspanel" ng-controller="TasksCtrl">
		<input type="text" ng-model="newTask.name" placeholder="New Task">
		<button type="submit" ng-click="create()">Create</button>
		<ul class="errorlist">
			<li ng-repeat="error in creationerrors">@{{ error }}</li>
		</ul>
		<ul>
			<li ng-repeat="task in tasks">
				<input type="checkbox" ng-checked="task.done" ng-click="toggleDone()">
				@{{ task.name }}
			</li>
		</ul>
	</div>

@endsection