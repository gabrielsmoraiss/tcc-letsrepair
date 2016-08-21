<?php
namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Domain\User\UserRequest;
use App\Http\Controllers\BaseController;
use Domain\TypeProduct\TypeProductRepositoryInterface as TypeProduct;
use Domain\BrandsAttended\BrandsAttendedRepositoryInterface as BrandsAttended;

class AdminController extends BaseController
{
    protected $typeProducts;
    protected $brandsAttendeds;

    public function __construct(TypeProduct $typeProducts, BrandsAttended $brandsAttendeds)
    {
        $this->loggedUser = Auth::user();
        $this->typeProducts = $typeProducts;
        $this->brandsAttendeds = $brandsAttendeds;
    }

    /**
     * Mostra a tela inicial
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
        $typeProducts = $this->typeProducts->listForSelect();
        $brandsAttendeds = $this->brandsAttendeds->listForSelect();

        return view('index', compact('typeProducts', 'brandsAttendeds'));
    }
}
