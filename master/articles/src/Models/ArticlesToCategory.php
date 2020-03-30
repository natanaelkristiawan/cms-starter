<?php

namespace Master\Articles\Models;
use Illuminate\Database\Eloquent\Model;

class ArticlesToCategory extends Model 
{
	protected $table = 'article_to_category';
	protected $fillable = [
		'article_id',
		'category_id',
	];
}
