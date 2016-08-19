<?php

namespace Domain\TypeProduct;

class TypeProductRepository implements TypeProductRepositoryInterface
{
    protected $typeProducts;

    public function __construct(TypeProduct $typeProducts)
    {
        $this->typeProducts = $typeProducts;
    }

    /**
     * Lista e retorna todos os eventos
     *
     * @return Domain\TypeProduct\TypeProduct
     */
    public function index()
    {
        return $this->typeProducts->all();
    }

    /**
     * Lista e retorna um evento espeficio
     *
     * @param  int  $id
     * @return Domain\TypeProduct\TypeProduct
     */
    public function show($id)
    {
        return $this->typeProducts->findOrFail($id);
    }

    /**
     * Altera  ou adiciona um evento
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Domain\TypeProduct\TypeProduct
     */
    public function save($request, $id = null)
    {
        $typeProduct = $id ? $this->typeProducts->findOrFail($id) : new TypeProduct();

        $typeProduct->description = $request->input('description', $typeProduct->description);

        $typeProduct->save();

        return $typeProduct;
    }

    /**
     * Remove um evento especifico
     *
     * @param  int  $id
     * @return Domain\TypeProduct\TypeProduct
     */
    public function destroy($id)
    {
        $typeProduct = $this->typeProducts->findOrFail($id);

        return $typeProduct->delete();
    }
}
