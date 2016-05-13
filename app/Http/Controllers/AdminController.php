<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Domain\User\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class AdminController extends BaseController
{
    /**
     * Mostra a tela inicial.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
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
            return 'Logou! Só Alegria!';
            //return redirect()->route('admin.pessoas.index');
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
        return $this->logoutWithFlash('admin.login', 'Você saiu!', 'warning');
    }
}
