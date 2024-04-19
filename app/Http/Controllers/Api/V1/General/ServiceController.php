<?php

namespace App\Http\Controllers\Api\V1\General;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\serviceResource;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\General\ServiceInterface;

class ServiceController extends Controller
{
    use helpers;
    private $ServiceInterface;

    public function __construct(ServiceInterface $ServiceInterface)
    {
        $this->ServiceInterface = $ServiceInterface;
    }


    public function index()
    {
        $servData = $this->ServiceInterface->index();
        if (!is_string($servData) && $servData->first()) {
            return $this->apiResponse(new GeneralCollection($servData, serviceResource::class));
        } elseif (is_string($servData)) {
            return $this->apiResponse(['message' => $servData]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
    public function store(Request $request)
    {

        $servStore = $this->ServiceInterface->store($request);
        if (!is_string($servStore) && $servStore->first()) {
            return $this->apiResponse(['data' => new serviceResource($servStore)]);
        } elseif (is_string($servStore)) {
            return $this->apiResponse(['message' => $servStore]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }



    public function update(Request $request, string $id)
    {
        $servUpdate = $this->ServiceInterface->update($request, $id);
        if (!is_string($servUpdate) && $servUpdate->first()) {
            return $this->apiResponse(['data' => new serviceResource($servUpdate)]);
        } elseif (is_string($servUpdate)) {
            return $this->apiResponse(['message' => $servUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
    public function show(string $id)
    {
        $servShow = $this->ServiceInterface->show($id);
        if (!is_string($servShow) && $servShow->first()) {
            return $this->apiResponse(new GeneralCollection($servShow, serviceResource::class));
        } elseif (is_string($servShow)) {
            return $this->apiResponse(['message' => $servShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function destroy(string $id)
    {
        $servTrashed = $this->ServiceInterface->destroy($id);
        if (is_string($servTrashed)) {
            return $this->apiResponse(['message' => $servTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
