<?php

namespace App\RepoInterface\User;

interface UserInterface
{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
