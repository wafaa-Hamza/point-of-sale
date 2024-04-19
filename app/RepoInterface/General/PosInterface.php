<?php 
namespace App\RepoInterface\General;
interface PosInterface{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
  //  public function sowitchPos($request);
}
