<?php

namespace Domain\Base;

interface RepositoryInterface
{
    public function index();
    public function destroy($id);
    public function save($request, $id = null);
    public function show($id);
}
