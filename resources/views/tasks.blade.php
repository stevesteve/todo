@extends('layouts.app')

@section('content')

	<div id="listspanel" ng-controller="ListsCtrl">
		<form ng-submit="create()" id="list-form" class="compact-text-form">
			<input type="text" ng-model="newList.name" placeholder="New List">
			<button type="submit">+</button>
			<ul class="errorlist">
				<li ng-repeat="error in creationerrors">
					@{{ error }}
				</li>
			</ul>
		</form>
		<ul id="listlist">
			<li ng-repeat="list in lists | orderBy:'name'" ng-click="setActiveList()"
				ng-class="{active: activeList.id === list.id}">

				@{{ list.name }}
				<button ng-click="delete($event)" class="btn-delete">x</button>
			</li>
		</ul>
	</div>
	<div id="taskspanel" ng-if="activeList" ng-controller="TasksCtrl">
		<form ng-submit="create()" id="task-form" class="compact-text-form">
			<input type="text" ng-model="newTask.name" placeholder="New Task">
			<button type="submit">+</button>
			<ul class="errorlist">
				<li ng-repeat="error in creationerrors">@{{ error }}</li>
			</ul>
		</form>
		<label for="show-done" class="checkbox-label">
			<span>Show Done: </span>
			<input id="show-done" type="checkbox"
				ng-model="filterTasks.done" ng-true-value="undefined" ng-false-value="0">
		</label>
		<ul id="tasklist">
			<li ng-repeat="task in filteredTasks = (tasks | filter:filterTasks | orderBy:['!done','id']:true)">
				<input type="checkbox"
					ng-model="task.done"
					ng-true-value="1"
					ng-false-value="0"
					ng-change="task.$save()">
				@{{ task.name }}
				<button ng-click="delete($event)" class="btn-delete">x</button>
			</li>
		</ul>
		<div ng-if="filteredTasks.length === 0">No Tasks</div>
	</div>
	<div ng-if="!activeList">
		Select a list
	</div>

@endsection