<?php

namespace Master\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Meta;

class DashboardResourceController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin');
		Meta::title('Dashboard');
	}

	public function index()
	{
		return view('core::admin.core.dashboard');
	}
}