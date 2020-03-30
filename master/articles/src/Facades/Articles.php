<?php

namespace Master\Articles\Facades;

use Illuminate\Support\Facades\Facade;

class Articles extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.articles';
	}
}
