<?php

namespace  App\DBrepo\table;

use App\Models\Table;
use App\RepoInterface\table\TableInterface;
use Exception;

class DBtable implements TableInterface
{

    private $TableModel;
    public function __construct(Table $TableModel)
    {
        $this->TableModel = $TableModel;
    }

    public function index()
    {
        try {

            $tableData = $this->TableModel::get();
            return $tableData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try {

            $tableStore = $this->TableModel::create([
                'pos_id' => $request->pos_id,
                'name' => $request->name,
                'name_loc' => $request->name_loc,
                //'is_used' => $request->is_used,
            ]);

            return $tableStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $tableShow = $this->TableModel::where('id', $id)->get();
            return $tableShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($request, $id)
    {
        try {

            $tabledata = $this->show($id)->first();
            $tableUpdate = $this->TableModel::where('id', $id)->update([
                'pos_id' => (!empty($request->pos_id)) ? $request->pos_id : $tabledata->pos_id,
                'name' => (!empty($request->name)) ? $request->name : $tabledata->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $tabledata->name_loc,
                'is_used' => (!empty($request->is_used)) ? $request->is_used : $tabledata->is_used,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {

        $tableTrashed = $this->TableModel::where('id', $id)->first();
        if ($tableTrashed) {
            return 'Table Is Deleted';
        } else {
            return null;
        }
    }
}
