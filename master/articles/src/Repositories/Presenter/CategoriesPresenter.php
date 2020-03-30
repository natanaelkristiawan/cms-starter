<?php

namespace Master\Articles\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class CategoriesPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new CategoriesTransformer();
	}
}