<?php

namespace App\RepoInterface\Item;

interface ItemInterface
{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
