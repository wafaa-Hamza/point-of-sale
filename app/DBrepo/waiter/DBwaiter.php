<?php

namespace  App\DBrepo\waiter;

use Exception;
use App\Models\Table;
use App\Models\Waiter;
use App\RepoInterface\waiter\waiterInterface;

class DBwaiter implements waiterInterface
{

    private $WaiterModel;
    public function __construct(Waiter $WaiterModel)
    {
        $this->WaiterModel = $WaiterModel;
    }

    public function index()
    {
        try {

            $waiterData = $this->WaiterModel::get();
            return $waiterData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try {

            $waiterStore = $this->WaiterModel::create([
                'pos_id' => $request->pos_id,
                'name' => $request->name,
                'name_loc' => $request->name_loc,
            ]);

            return $waiterStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $waiterShow = $this->WaiterModel::where('id', $id)->get();
            return $waiterShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($request, $id)
    {
        try {

            $waiterdata = $this->show($id)->first();
            $waiterUpdate = $this->WaiterModel::where('id', $id)->update([
                'pos_id' => (!empty($request->pos_id)) ? $request->pos_id : $waiterdata->pos_id,
                'name' => (!empty($request->name)) ? $request->name : $waiterdata->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $waiterdata->name_loc,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {

        $waiterTrashed = $this->WaiterModel::where('id', $id)->first();
        if ($waiterTrashed) {
            return 'Table Is Deleted';
        } else {
            return null;
        }
    }
}
