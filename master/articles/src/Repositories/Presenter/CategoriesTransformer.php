<?php

namespace Master\Articles\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CategoriesTransformer extends TransformerAbstract
{
	public function transform(\Master\Articles\Models\Categories $model)
	{
		return [
			'id'   => $model->id,
			'title' => $model->title,
			'status'=> $model->status == 0 ? 'Draft' : 'Live',
			'action'=> '<div class="btn-group">
                  <a href="'.route('admin.categories.edit', ['id'=>$model->id]).'" class="btn btn-primary btn-flat"><i class="fa fa-fw fa-pencil"></i></a>
                  <a href="'.route('admin.categories.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
		];
	}
}
