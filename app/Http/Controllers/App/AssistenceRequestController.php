<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Domain\AssistenceRequest\AssistenceRequestRequest;
use App\Http\Controllers\BaseController;
use Domain\AssistenceRequest\AssistenceRequestRepositoryInterface as AssistenceRequest;
use Domain\TypeProduct\TypeProductRepositoryInterface as TypeProduct;
use Domain\BrandsAttended\BrandsAttendedRepositoryInterface as BrandsAttended;

class AssistenceRequestController extends BaseController
{
    protected $typeProducts;
    protected $brandsAttendeds;
    protected $assistenceRequests;


    public function __construct(
            AssistenceRequest $assistenceRequests,
            TypeProduct $typeProducts,
            BrandsAttended $brandsAttendeds
        )
    {
        $this->typeProducts = $typeProducts;
        $this->brandsAttendeds = $brandsAttendeds;
        $this->assistenceRequests = $assistenceRequests;
    }

    /**
     * Abre o formulario para cadastro de assistenceRequests
     *
     * @return Response
     */
    public function create()
    {
        $typeProducts = $this->typeProducts->listForSelect();
        $brandsAttendeds = $this->brandsAttendeds->listForSelect();

        return view('admin.assistence-requests.create', compact('typeProducts', 'brandsAttendeds'));
    }

    /**
     * Cria uma nova assistenceRequest
     *
     * @param  Request $request
     * @return Response
     */
    public function store(AssistenceRequestRequest $request)
    {
        $assistenceRequest = $this->assistenceRequests->save($request);

        return $this->routeRedirectWithFlash('index', '', "Solicitação de cadastro realizado com Sucesso!");
    }
}

