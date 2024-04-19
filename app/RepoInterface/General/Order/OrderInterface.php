<?php 
namespace App\RepoInterface\Order;
interface OrderInterface{
    public function index();
    public function show($id);
    public function store($request);
    public function storeOrderDetails($request,$orderMasterI);
    public function update($request,$id);
    public function destroy($id);
}
