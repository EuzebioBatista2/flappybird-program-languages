<?php

namespace App\Http\Controllers\Auth;

namespace Illuminate\Foundation\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  protected function validateLogin(Request $request)
  {
    $request->validate(
      [
        'name' => 'required|string|exists:users,name',
        'password' => 'required|string',
      ],
      [
        "name.required" => 'O campo nome precisa ser preenchido',
        "password.required" => 'O campo senha deve ser preenchido',
        "name.exists" => 'Login ou senha inválidos'
      ]
    );
  }

  public function username()
  {
    return 'name';
  }
}
