<?php

namespace  App\DBrepo\General;

use App\Models\Service;
use App\RepoInterface\General\ServiceInterface;
use Exception;


class DBservice implements ServiceInterface
{
    private $serviceModel;

    public function __construct(Service $serviceModel)
    {
        $this->serviceModel = $serviceModel;
    }

    public function index()
    {
        try {
            $servData = $this->serviceModel::get();

            return $servData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $servShow = $this->serviceModel::where('id', $id)->get();
            return $servShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try {
            $servStore = $this->serviceModel::create([
                'name' => $request->name,
                'name_loc' => $request->name_loc,
            ]);
            return $servStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function update($request, $id)
    {
        try {
            $servdata = $this->show($id)->first();
            $servUpdate = $this->serviceModel::where('id', $id)->update([
                'name' => (!empty($request->name)) ? $request->name : $servdata->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $servdata->name_loc,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {

        $servTrashed = $this->serviceModel::where('id', $id)->first();
        if ($servTrashed) {
            $servTrashed->delete();
            return 'Service Is Deleted';
        } else {
            return null;
        }
    }
}
