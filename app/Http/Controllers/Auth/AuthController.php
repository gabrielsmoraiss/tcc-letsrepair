<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Domain\User\UserRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Domain\TypeProduct\TypeProductRepositoryInterface as TypeProduct;
use Domain\BrandsAttended\BrandsAttendedRepositoryInterface as BrandsAttended;

class AuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $typeProducts;
    protected $brandsAttendeds;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(TypeProduct $typeProducts, BrandsAttended $brandsAttendeds)
    {
        $this->typeProducts = $typeProducts;
        $this->brandsAttendeds = $brandsAttendeds;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Mostra a tela inicial.
     *
     * @return Response
     */
    public function index()
    {
        $typeProducts = $this->typeProducts->listForSelect();
        $brandsAttendeds = $this->brandsAttendeds->listForSelect();

        return view('index', compact('typeProducts', 'brandsAttendeds'));
    }

     /**
     * Redireciona para a tela de login.
     *
     * @return Request
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Login e autenticação de usuario.
     *
     * @return Request
     */
    public function authenticate(UserRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.index');
        }
        return $this->backWithFlash('Usuário não cadastrado!', 'danger');
    }

    /**
     * Efetua Logout de usuario.
     *
     * @return Response
     */
    public function logout()
    {
        return $this->logoutWithFlash('index', 'Você saiu!', 'warning');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
