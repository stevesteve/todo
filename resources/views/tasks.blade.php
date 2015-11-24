@extends('layouts.app')

@section('content')

	<div id="listspanel" ng-controller="ListsCtrl">
		<form ng-submit="create()">
			<input type="text" ng-model="newList.name" placeholder="New List">
			<button type="submit">Create</button>
			<ul class="errorlist">
				<li ng-repeat="error in creationerrors">
					@{{ error }}
				</li>
			</ul>
		</form>
		<ul>
			<li ng-repeat="list in lists | orderBy:'name'" ng-click="setActiveList()">
				@{{ list.name }}
			</li>
		</ul>
	</div>
	<div id="taskspanel" ng-if="activeList" ng-controller="TasksCtrl">
		Show Done: <input type="checkbox" ng-model="filterTasks.done" ng-true-value="undefined" ng-false-value="0">
		<form ng-submit="create()">
			<input type="text" ng-model="newTask.name" placeholder="New Task">
			<button type="submit">Create</button>
			<ul class="errorlist">
				<li ng-repeat="error in creationerrors">@{{ error }}</li>
			</ul>
		</form>
		<ul>
			<li ng-repeat="task in filteredTasks = (tasks | filter:filterTasks | orderBy:['!done','id']:true)">
				<input type="checkbox"
					ng-model="task.done"
					ng-true-value="1"
					ng-false-value="0"
					ng-change="task.$save()">
				@{{ task.name }}
			</li>
		</ul>
		<div ng-if="filteredTasks.length === 0">No Tasks</div>
	</div>
	<div ng-if="!activeList">
		Select a list
	</div>

@endsection