<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Domain\TypeProduct\TypeProductRequest;
use App\Http\Controllers\BaseController;
use Domain\TypeProduct\TypeProductRepositoryInterface as TypeProduct;

class TypeProductController extends BaseController
{
    protected $typeProducts;

    public function __construct(TypeProduct $typeProducts)
    {
        $this->typeProducts = $typeProducts;
    }

    /**
     * Lista todas as typeProducts e retorna para o Index
     *
     * @return Response
     */
    public function index()
    {
        $typeProducts = $this->typeProducts->index();

        return view('admin.type-products.index', compact('typeProducts'));
    }

    /**
     * Abre o formulario para cadastro de typeProducts
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.type-products.create');
    }

    /**
     * Cria uma nova typeProduct
     *
     * @param  Request $request
     * @return Response
     */
    public function store(TypeProductRequest $request)
    {
        $typeProduct = $this->typeProducts->save($request);

        return $this->backWithFlash("Tipo de produto foi cadastrado com Sucesso!");
    }

    /**
     * Lista uma typeProduct especifica
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $typeProduct = $this->typeProducts->show($id);

        return view('admin.type-products.show', compact('typeProduct'));
    }

    /**
     * Mostra a tela para editar uma typeProduct especifica
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $typeProduct = $this->typeProducts->show($id);

        return view('admin.type-products.edit', compact('typeProduct'));
    }

    /**
     * Altera uma typeProduct especifica
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(TypeProductRequest $request, $id)
    {
        $this->typeProducts->save($request, $id);

        return $this->backWithFlash("O tipo de produto foi alterada com Sucesso!");
    }

    /**
     * Remove uma typeProduct especifica
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->typeProducts->destroy($id);

        return $this->backWithFlash("Cadastro Excluido com Sucesso!", 'danger');
    }
}

