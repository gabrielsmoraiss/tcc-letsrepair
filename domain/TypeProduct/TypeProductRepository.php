<?php

namespace Domain\TypeProduct;

use Hash;
use Auth;

class TypeProductRepository implements TypeProductRepositoryInterface
{
    protected $users;

    public function __construct(TypeProduct $users)
    {
        $this->users = $users;
    }

    /**
     * Lista e retorna todos os eventos
     *
     * @return Domain\User\User
     */
    public function index()
    {
        return $this->users->all();
    }

    /**
     * Lista e retorna um evento espeficio
     *
     * @param  int  $id
     * @return Domain\User\User
     */
    public function show($id)
    {
        return $this->users->findOrFail($id);
    }

    /**
     * Altera  ou adiciona um evento
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Domain\User\User
     */
    public function save($request, $id = null)
    {
        $user = $id ? $this->users->findOrFail($id) : new TypeProduct();
        $user->type = $request->input('type', $user->type);

        $user->save();

        return $user;
    }

    /**
     * Remove um evento especifico
     *
     * @param  int  $id
     * @return Domain\User\User
     */
    public function destroy($id)
    {
        $user = $this->users->findOrFail($id);

        return $user->delete();
    }
}
