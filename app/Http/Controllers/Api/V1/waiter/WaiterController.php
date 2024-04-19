<?php

namespace App\Http\Controllers\Api\V1\waiter;

use App\helpers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WaiterResource;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\waiter\waiterInterface;


class WaiterController extends Controller
{
    use helpers;
    private $waiterInterface;


    public function __construct(waiterInterface $waiterInterface)
    {
        $this->waiterInterface = $waiterInterface;
    }

    public function index()
    {
        $waiterData = $this->waiterInterface->index();
        if ($waiterData->first()) {
            return $this->apiResponse(new GeneralCollection($waiterData, WaiterResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function store(Request $request)
    {
        $waiterStore = $this->waiterInterface->store($request);
        if (!is_string($waiterStore) && $waiterStore->first()) {
            return $this->apiResponse(['data' => new WaiterResource($waiterStore)]);
        } else {
            return $this->apiResponse(['message' =>  $waiterStore]);
        }
    }

    public function show(string $id)
    {
        $waiterShow = $this->waiterInterface->show($id);
        if (!is_string($waiterShow) && $waiterShow->first()) {
            return $this->apiResponse(new GeneralCollection($waiterShow, WaiterResource::class));
        } elseif (is_string($waiterShow)) {
            return $this->apiResponse(['message' => $waiterShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $waiterUpdate = $this->waiterInterface->update($request, $id);
        if (!is_string($waiterUpdate) && $waiterUpdate->first()) {

            return $this->apiResponse(['data' => new WaiterResource($waiterUpdate)]);
        } elseif (is_string($waiterUpdate)) {
            return $this->apiResponse(['message' => $waiterUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function destroy(string $id)
    {
        $waiterTrashed = $this->waiterInterface->destroy($id);
        if (is_string($waiterTrashed)) {
            return $this->apiResponse(['message' => $waiterTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
