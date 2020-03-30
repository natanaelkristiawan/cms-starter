<?php

namespace Master\Articles\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model 
{
	use SoftDeletes;
	protected $table = 'articles';
	protected $fillable = [
		'title',
		'slug',
		'order',
		'meta',
		'banners',
		'banners_mobile',
		'images',
		'abstract',
		'content',
		'status',
	];

  protected $casts = [
		'meta' => 'array',
		'banners' => 'array',
		'banners_mobile' => 'array',
		'images' => 'array',
  ];


  public function categories()
  {
  	return $this->hasMany(\Master\Articles\Models\ArticlesToCategory::class, 'article_id', 'id');
  }
}
