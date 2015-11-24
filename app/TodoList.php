<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Task;

class TodoList extends Model
{
	public function tasks()
	{
		return $this->hasMany('\App\Task','list_id');
	}
}
