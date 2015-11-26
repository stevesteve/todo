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
		<label for="show-done" class="checkbox-label" ng-click="toggleDoneFilter()">
			<span>Show Done: </span>
			<img src="{{ asset('media/checkbox.png') }}"class="checkbox"
				ng-if="filterTasks.done!==undefined">
			<img src="{{ asset('media/checkbox-ticked.png') }}" class="checkbox ticked"
				ng-if="filterTasks.done===undefined">
		</label>
		<ul id="tasklist">
			<li ng-repeat="task in filteredTasks = (tasks | filter:filterTasks | orderBy:['!done','id']:true)">
				<img src="{{ asset('media/checkbox.png') }}"class="checkbox"
					ng-if="!task.done" ng-click="toggleDone()">
				<img src="{{ asset('media/checkbox-ticked.png') }}" class="checkbox ticked"
					ng-if="task.done" ng-click="toggleDone()">
				@{{ task.name }}
				<span class="task-time" ng-if="task.done">
					Done: @{{ task.updated_at }}
				</span>
				<span class="task-time" ng-if="!task.done">
					Created: @{{ task.created_at }}
				</span>
				<button ng-click="delete($event)" class="btn-delete">x</button>
			</li>
		</ul>
		<div ng-if="filteredTasks.length === 0">No Tasks</div>
	</div>
	<div ng-if="!activeList" id="no-list-panel">
		Select a list
	</div>

@endsection