<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public function todoList()
	{
		return $this->belongsTo('List','list_id');
	}
}
