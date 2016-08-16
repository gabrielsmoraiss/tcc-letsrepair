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
     * Lista e retorna todos os users
     *
     * @return Domain\User\User
     */
    public function index()
    {
        return $this->users->all();
    }

    /**
     * Lista e retorna um user espeficio
     *
     * @param  int  $id
     * @return Domain\User\User
     */
    public function show($id)
    {
        return $this->users->findOrFail($id);
    }

    /**
     * retorna um user espeficio e insere o acess token do google
     *
     * @param  int  $id
     * @return Domain\User\User
     */
    public function saveTokenGoogle($id, $token = null)
    {
        $user = $this->users->findOrFail($id);
        $user->tokenGoogle = $token;
        
        $user->save();

        return $user;
    }

    /**
     * Altera  ou adiciona um user
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
     * Remove um user especifico
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
