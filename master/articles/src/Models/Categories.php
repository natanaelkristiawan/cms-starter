<?php

namespace Master\Articles\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model 
{
	use SoftDeletes;
	protected $table = 'categories';
	protected $fillable = [
		'title',
		'slug',
		'order',
		'status',
	];
}
