<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageResource;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\Item\PackageInterface;

class PackageController extends Controller
{
    use helpers;
    private $packageInterface;
    public function __construct(PackageInterface $packageInterface)
    {
        $this->packageInterface = $packageInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageData = $this->packageInterface->index();
        if(!is_string($packageData) && $packageData->first())
        {
        return $this->apiResponse(new GeneralCollection($packageData,PackageResource::class));
        }elseif(is_string($packageData)){
            return $this->apiResponse(['message' => $packageData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        $packageData = $this->packageInterface->store($request);
        if(!is_string($packageData) && $packageData->first())
        {
        return $this->apiResponse(['data' => new PackageResource($packageData)]);
        }elseif(is_string($packageData)){
            return $this->apiResponse(['message' => $packageData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $packageData = $this->packageInterface->show($id);
        if(!is_string($packageData) && $packageData->first())
        {
        return $this->apiResponse(new GeneralCollection($packageData,PackageResource::class));
        }elseif(is_string($packageData)){
            return $this->apiResponse(['message' => $packageData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, string $id)
    {
        $packageData = $this->packageInterface->update($request ,$id);
        if(!is_string($packageData) && $packageData)
        {
            return $this->apiResponse(['data' => new PackageResource($packageData)]);
        }elseif(is_string($packageData)){
            return $this->apiResponse(['message' => $packageData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $packageData = $this->packageInterface->destroy($id);
        if(is_string($packageData)){
            return $this->apiResponse(['message' => $packageData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}