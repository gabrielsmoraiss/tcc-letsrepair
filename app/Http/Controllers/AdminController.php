<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Domain\User\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class AdminController extends BaseController
{
    /**
     * Mostra a tela inicial de admin.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Mostra a tela inicial para usuários logados.
     *
     * @return Response
     */
    public function indexAdmin()
    {
        return view('index');
    }
}
