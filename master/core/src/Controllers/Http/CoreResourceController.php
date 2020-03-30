<?php

namespace Master\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class CoreResourceController extends Controller
{
	use AuthenticatesUsers;


	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function login()
	{
		return view('core::admin.core.login');
	}

	public function doLogin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
		]);

		if ($validator->fails()) {
			return redirect()->back()
			->withErrors(array('credential' => 'Credential Wrong'))
			->withInput($request->only('email'));
		}


		$credentials = $request->only('email', 'password');

		$remember = $request->remember;

		if (Auth::guard('admin')->attempt($credentials, $remember)) {
			echo "sukses";
		}

		return redirect()->back()
		->withErrors(array('credential' => 'Credential Wrong'))
		->withInput($request->only('email'));
	}


	public function logout()
	{
		Auth::guard('admin')->logout();
    session()->flush();
    return redirect()->route('admin.login');
	}
}