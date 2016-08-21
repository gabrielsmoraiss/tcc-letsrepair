<?php

namespace App\Http\Controllers\Admin;

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
     * Lista todas as assistenceRequests e retorna para o Index
     *
     * @return Response
     */
    public function index()
    {
        $assistences = $this->assistenceRequests->index();

        return view('admin.assistence-requests.index', compact('assistences'));
    }

    /**
     * Lista uma assistenceRequest especifica
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $assistenceRequest = $this->assistenceRequests->show($id);

        return view('admin.assistence-requests.show', compact('assistenceRequest'));
    }

    /**
     * Mostra a tela para editar uma assistenceRequest especifica
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $typeProducts = $this->typeProducts->listForSelect();
        $brandsAttendeds = $this->brandsAttendeds->listForSelect();

        $assistencia = $this->assistenceRequests->show($id);

        return view('admin.assistence-requests.edit', compact('assistencia', 'typeProducts', 'brandsAttendeds'));
    }

    /**
     * Altera uma assistenceRequest especifica
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(AssistenceRequestRequest $request, $id)
    {
        $this->assistenceRequests->save($request, $id);

        return $this->backWithFlash("O tipo de produto foi alterada com Sucesso!");
    }

    /**
     * Remove uma assistenceRequest especifica
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $destroy = $this->assistenceRequests->destroy($id);

        if($request->ajax()) {
            return 'destroyed';
        }

        return $this->backWithFlash("Cadastro Excluido com Sucesso!", 'danger');
    }
}

