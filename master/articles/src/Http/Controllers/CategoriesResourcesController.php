<?php

namespace Master\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Articles\Interfaces\CategoriesRepositoryInterface;
use Master\Articles\Models\Categories;
use Validator;
use Meta;
class CategoriesResourceController extends Controller
{
	protected $repository;

	public function __construct(CategoriesRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;

		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);

		Meta::title('Categories');
	}

	public function index(Request $request)
	{	
		if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Articles\Repositories\Presenter\CategoriesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }

		return view('articles::admin.categories.index');	
	}

	public function create(Request $request)
	{
		$method = 'create';
		
		$data = $this->repository->newInstance([]);

		return view('articles::admin.categories.form', compact('data', 'method'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' 		=> 'required',
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
		);


		$data = $this->repository->create($dataInsert);

		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.categories');
		}
		return redirect()->route('admin.categories.edit', ['id' => $data->id]);
	}

	public function edit(Request $request, Categories $data)
	{
		$method = 'create';

	  	return view('articles::admin.categories.form', compact('data', 'method'));
	}

	public function update(Request $request, Categories $data)
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
		);

		$data = $this->repository->update($dataInsert, $data->id);

		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.categories');
		}
		return redirect()->route('admin.categories.edit', ['id' => $data->id]);

	}

	public function delete(Request $request, Categories $data)
	{

		$data = $this->repository->delete($data->id);
		$request->session()->flash('status', 'Success Delete Data!');

		return redirect()->route('admin.categories');
	}

}