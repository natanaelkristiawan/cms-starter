<?php

namespace Master\Articles\Repositories\Eloquent;

use Master\Articles\Interfaces\ArticlesRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class ArticlesRepository extends BaseRepository implements ArticlesRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'title'      => 'like',
		'status'    => '='
	];

	public function model()
	{
		return \Master\Articles\Models\Articles::class;
	}

	public function newInstance(array $attributes)
	{
		$model = $this->model->newInstance($attributes);
		$this->resetModel();
		return $this->parserResult($model);
	}

	public function setPageLimit($pageLimit)
	{
		$this->pageLimit = $pageLimit;
		return  $this;
	}


	public function getDataTable()
	{        
		$data = $this->paginate($this->pageLimit);
		$data['recordsTotal'] = $data['meta']['pagination']['total'];
		$data['recordsFiltered'] = $data['meta']['pagination']['total'];
		$data['request'] = request()->all();
		return $data;
	}

}
