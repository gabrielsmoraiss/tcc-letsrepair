<?php

namespace Domain\User;

use Hash;
use Auth;

class UserRepository implements UserRepositoryInterface
{
    protected $users;

    public function __construct(User $users)
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
        $user = $id ? $this->users->findOrFail($id) : new User();
        $user->type = $request->input('type', $user->type);
        $user->email = $request->input('email', $user->email);
        $user->name = $request->input('name', $user->name);
        $user->city = $request->input('city', $user->city);
        $user->password = is_null($request->password) ? $user->password : Hash::make($request->password);

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
