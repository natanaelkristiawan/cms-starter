<?php

namespace Master\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Articles\Interfaces\ArticlesRepositoryInterface;
use Master\Articles\Interfaces\ArticlesToCategoryRepositoryInterface;
use Master\Articles\Interfaces\CategoriesRepositoryInterface;
use Master\Articles\Models\Articles;
use Validator;
use Meta;
class ArticlesResourceController extends Controller {
	protected $repository;
	protected $articlesToCategory;
	protected $category;

	public function __construct(
		ArticlesRepositoryInterface $repository,
		ArticlesToCategoryRepositoryInterface $articlesToCategory,
		CategoriesRepositoryInterface $category
	)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;

		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);


		$this->articlesToCategory = $articlesToCategory;

		$this->category = $category;

		Meta::title('Articles');
	}

	public function index(Request $request)
	{	
		if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Articles\Repositories\Presenter\ArticlesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }

		return view('articles::admin.articles.index');	
	}

	public function create(Request $request)
	{
		$method = 'create';
		
		$data = $this->repository->newInstance([]);
		$data->category_id = array();

		$categories = $this->category->all();

		return view('articles::admin.articles.form', compact('data', 'method', 'categories'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' 			=> 'required',
			'slug' 			=> 'required',
			'order' 		=> 'required',
			'status' 		=> 'required',
		]);

		if ($validator->fails()) {
			return redirect()->back()
					->withErrors($validator)
					->withInput();
		}

		$dataInsert = array(
			'title' 		=> $request->title,
			'slug'			=> $request->slug,
			'order'			=> $request->order,
			'status'		=> $request->status,
			'meta'			=> $request->meta,
			'images' 		=> is_null($request->images) ? array() : array_values($request->images),
			'banners' 		=> is_null($request->banners) ? array() : array_values($request->banners),
			'banners_mobile'=> is_null($request->banners_mobile) ? array() : array_values($request->banners_mobile),
			'abstract'	=> $request->abstract,
			'content'		=> $request->content
		);


		$data = $this->repository->create($dataInsert);

		foreach ($request->category_id as $key => $category_id) {
			$dataArticleCategory = array(
				'category_id' 	=> $category_id,
				'article_id'	=> $data->id
			);
			$this->articlesToCategory->create($dataArticleCategory);
		}
		

		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.articles');
		}
		return redirect()->route('admin.articles.edit', ['id' => $data->id]);
	}

	public function edit(Request $request, Articles $data)
	{
		$method = 'create';

		$categories = $this->category->all();

		$listCategory = array();

		foreach ($data->categories as $key => $list) {
			$listCategory[] = $list->category_id;
		}

		$data->category_id = $listCategory;


	  return view('articles::admin.articles.form', compact('data', 'method', 'categories'));
	}

	public function update(Request $request, Articles $data)
	{
	  $validator = Validator::make($request->all(), [
			'title' 			=> 'required',
			'slug' 			=> 'required',
			'order' 		=> 'required',
			'status' 		=> 'required',
		]);

		if ($validator->fails()) {
			return redirect()->back()
					->withErrors($validator)
					->withInput();
		}

		$dataInsert = array(
			'title' 		=> $request->title,
			'slug'			=> $request->slug,
			'order'			=> $request->order,
			'status'		=> $request->status,
			'meta'			=> $request->meta,
			'images' 		=> is_null($request->images) ? array() : array_values($request->images),
			'banners' 		=> is_null($request->banners) ? array() : array_values($request->banners),
			'banners_mobile'=> is_null($request->banners_mobile) ? array() : array_values($request->banners_mobile),
			'abstract'	=> $request->abstract,
			'content'		=> $request->content
		);

		$data = $this->repository->update($dataInsert, $data->id);


		$this->articlesToCategory->deleteWhere(array('article_id'=>$article->id));


		// // insert ulang
		foreach ($request->category_id as $key => $category_id) {
			$dataArticleCategory = array(
				'category_id' 	=> $category_id,
				'article_id'	=> $article->id
			);
			$this->articlesToCategory->create($dataArticleCategory);
		}
		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.articles');
		}
		return redirect()->route('admin.articles.edit', ['id' => $data->id]);

	}

	public function delete(Request $request, Articles $data)
	{
		$this->articlesToCategory->deleteWhere(array('article_id'=>$article->id));
		
		$data = $this->repository->delete($data->id);
		$request->session()->flash('status', 'Success Delete Data!');

		return redirect()->route('admin.articles');
	}

}