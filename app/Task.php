<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

	protected $casts = [
		'done' => 'boolean',
	];

	public function todoList()
	{
		return $this->belongsTo('List','list_id');
	}
}
