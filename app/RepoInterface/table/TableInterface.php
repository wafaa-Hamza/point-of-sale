<?php

namespace App\RepoInterface\table;

interface TableInterface
{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
