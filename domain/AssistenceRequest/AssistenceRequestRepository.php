<?php

namespace Domain\AssistenceRequest;

class AssistenceRequestRepository implements AssistenceRequestRepositoryInterface
{
    protected $assistenceRequests;

    public function __construct(AssistenceRequest $assistenceRequests)
    {
        $this->assistenceRequests = $assistenceRequests;
    }

    /**
     * Lista e retorna todos os produtos
     *
     * @return Domain\AssistenceRequest\AssistenceRequest
     */
    public function index()
    {
        return $this->assistenceRequests->all();
    }

    /**
     * Lista e retorna todos as marcas contendo nome e id em forma de array
     *
     * @return Domain\AssistenceRequest\AssistenceRequest
     */
    public function listForSelect()
    {
        $assistenceRequests = $this->assistenceRequests->all();
        return $assistenceRequests->pluck('description', 'id');
    }

    /**
     * Lista e retorna um produto espeficio
     *
     * @param  int  $id
     * @return Domain\AssistenceRequest\AssistenceRequest
     */
    public function show($id)
    {
        return $this->assistenceRequests->findOrFail($id);
    }

    /**
     * Altera  ou adiciona um produto
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Domain\AssistenceRequest\AssistenceRequest
     */
    public function save($request, $id = null)
    {
        $assistence = $id ? $this->assistenceRequests->findOrFail($id) : new AssistenceRequest();

        $request->typeProduct = $request->typeProduct ? json_encode($request->typeProduct) : null;
        $request->brandsAttended = $request->brandsAttended ? json_encode($request->brandsAttended) : null;
        $request->brandsAttendedWarranty = $request->brandsAttendedWarranty ? json_encode($request->brandsAttendedWarranty) : null;

        $assistence->name = $request->input('name', $assistence->name);
        $assistence->location = $request->input('location', $assistence->location);
        $assistence->category = $request->input('category', $assistence->category);
        $assistence->typeProduct = $request->typeProduct;
        $assistence->brandsAttended = $request->brandsAttended;
        $assistence->brandsAttendedWarranty = $request->brandsAttendedWarranty;
        $assistence->fone = $request->input('fone', $assistence->fone);
        $assistence->businessHours = $request->input('businessHours', $assistence->businessHours);
        $assistence->info = $request->input('info', $assistence->info);
        $assistence->placeId = $request->input('placeId', $assistence->placeId);

        $assistence->save();

        return $assistence;
    }

    /**
     * Remove uma assistencia especifica
     *
     * @param  int  $id
     * @return Domain\AssistenceRequest\AssistenceRequest
     */
    public function destroy($id)
    {
        $assistenceRequests = $this->assistenceRequests->findOrFail($id);

        return $assistenceRequests->delete();
    }
}
