<?php

namespace Master\Articles\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class ArticlesPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new ArticlesTransformer();
	}
}