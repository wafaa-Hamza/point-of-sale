<?php

namespace App\RepoInterface\waiter;

interface waiterInterface
{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
