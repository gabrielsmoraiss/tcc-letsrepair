<?php

namespace Domain\BrandsAttended;

class BrandsAttendedRepository implements BrandsAttendedRepositoryInterface
{
    protected $brandsAttendeds;

    public function __construct(BrandsAttended $brandsAttendeds)
    {
        $this->brandsAttendeds = $brandsAttendeds;
    }

    /**
     * Lista e retorna todos os produtos
     *
     * @return Domain\BrandsAttended\BrandsAttended
     */
    public function index()
    {
        return $this->brandsAttendeds->all();
    }

    /**
     * Lista e retorna todos as marcas contendo nome e id em forma de array
     *
     * @return Domain\BrandsAttended\BrandsAttended
     */
    public function listForSelect()
    {
        $brandsAttendeds = $this->brandsAttendeds->all();
        return $brandsAttendeds->pluck('description', 'id');
    }

    /**
     * Lista e retorna um produto espeficio
     *
     * @param  int  $id
     * @return Domain\BrandsAttended\BrandsAttended
     */
    public function show($id)
    {
        return $this->brandsAttendeds->findOrFail($id);
    }

    /**
     * Altera  ou adiciona um produto
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Domain\BrandsAttended\BrandsAttended
     */
    public function save($request, $id = null)
    {
        $brandsAttended = $id ? $this->brandsAttendeds->findOrFail($id) : new BrandsAttended();

        $brandsAttended->description = $request->input('description', $brandsAttended->description);

        $brandsAttended->save();

        return $brandsAttended;
    }

    /**
     * Remove um produto especifico
     *
     * @param  int  $id
     * @return Domain\BrandsAttended\BrandsAttended
     */
    public function destroy($id)
    {
        $brandsAttended = $this->brandsAttendeds->findOrFail($id);

        return $brandsAttended->delete();
    }
}
