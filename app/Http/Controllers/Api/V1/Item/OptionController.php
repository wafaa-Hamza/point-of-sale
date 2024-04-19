<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Http\Resources\OptionResource;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\Item\OptionsInterface;

class OptionController extends Controller
{
    use helpers;
    private $optionInterface;
    public function __construct(OptionsInterface $optionInterface)
    {
        $this->optionInterface = $optionInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemData = $this->optionInterface->index();
        if(!is_string($itemData) && $itemData->first())
        {
        return $this->apiResponse(new GeneralCollection($itemData,OptionResource::class));
        }elseif(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionRequest $request)
    {
        $itemData = $this->optionInterface->store($request);
        if(!is_string($itemData) && $itemData->first())
        {
        return $this->apiResponse(['data' => new OptionResource($itemData)]);
        }elseif(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itemData = $this->optionInterface->show($id);
        if(!is_string($itemData) && $itemData->first())
        {
        return $this->apiResponse(new GeneralCollection($itemData,OptionResource::class));
        }elseif(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionRequest $request, string $id)
    {
        $itemData = $this->optionInterface->update($request ,$id);
        if(!is_string($itemData) && $itemData->first())
        {
            return $this->apiResponse(['data' => new OptionResource($itemData)]);
        }elseif(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itemData = $this->optionInterface->destroy($id);
        if(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
