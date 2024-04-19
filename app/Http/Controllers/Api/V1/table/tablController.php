<?php

namespace App\Http\Controllers\Api\V1\table;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\table\TableInterface;


class tablController extends Controller
{
    use helpers;
    private $TableInterface;


    public function __construct(TableInterface $TableInterface)
    {
        $this->TableInterface = $TableInterface;
    }

    public function index()
    {
        $tableData = $this->TableInterface->index();
        if ($tableData->first()) {
            return $this->apiResponse(new GeneralCollection($tableData, TableResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function store(Request $request)
    {
        $tableStore = $this->TableInterface->store($request);
        if (!is_string($tableStore) && $tableStore->first()) {
            return $this->apiResponse(['data' => new TableResource($tableStore)]);
        } else {
            return $this->apiResponse(['message' =>  $tableStore]);
        }
    }

    public function show(string $id)
    {
        $tableShow = $this->TableInterface->show($id);
        if (!is_string($tableShow) && $tableShow->first()) {
            return $this->apiResponse(new GeneralCollection($tableShow, TableResource::class));
        } elseif (is_string($tableShow)) {
            return $this->apiResponse(['message' => $tableShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $tableUpdate = $this->TableInterface->update($request, $id);
        if (!is_string($tableUpdate) && $tableUpdate->first()) {

            return $this->apiResponse(['data' => new TableResource($tableUpdate)]);
        } elseif (is_string($tableUpdate)) {
            return $this->apiResponse(['message' => $tableUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function destroy(string $id)
    {
        $tableTrashed = $this->TableInterface->destroy($id);
        if (is_string($tableTrashed)) {
            return $this->apiResponse(['message' => $tableTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
