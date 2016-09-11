<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Domain\BrandsAttended\BrandsAttendedRequest;
use App\Http\Controllers\BaseController;
use Domain\BrandsAttended\BrandsAttendedRepositoryInterface as BrandsAttended;

class BrandsAttendedController extends BaseController
{
    protected $brandsAttendeds;

    public function __construct(BrandsAttended $brandsAttendeds)
    {
        $this->brandsAttendeds = $brandsAttendeds;
    }

    /**
     * Lista todas as brandsAttendeds e retorna para o Index
     *
     * @return Response
     */
    public function index()
    {
        $brandsAttendeds = $this->brandsAttendeds->index();

        return view('admin.brands-attendeds.index', compact('brandsAttendeds'));
    }

    /**
     * Abre o formulario para cadastro de brandsAttendeds
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.brands-attendeds.create');
    }

    /**
     * Cria uma nova brandsAttended
     *
     * @param  Request $request
     * @return Response
     */
    public function store(BrandsAttendedRequest $request)
    {
        $brandsAttended = $this->brandsAttendeds->save($request);

        return $this->backWithFlash("Tipo de produto foi cadastrado com Sucesso!");
    }

    /**
     * Lista uma brandsAttended especifica
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $brandsAttended = $this->brandsAttendeds->show($id);

        return view('admin.brands-attendeds.show', compact('brandsAttended'));
    }

    /**
     * Mostra a tela para editar uma brandsAttended especifica
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $brandsAttended = $this->brandsAttendeds->show($id);

        return view('admin.brands-attendeds.edit', compact('brandsAttended'));
    }

    /**
     * Altera uma brandsAttended especifica
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(BrandsAttendedRequest $request, $id)
    {
        $this->brandsAttendeds->save($request, $id);

        return $this->backWithFlash("O tipo de produto foi alterada com Sucesso!");
    }

    /**
     * Remove uma brandsAttended especifica
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->brandsAttendeds->destroy($id);

        return $this->backWithFlash("Cadastro Excluido com Sucesso!", 'danger');
    }
}

