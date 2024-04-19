<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\Item\ItemInterface;

class ItemController extends Controller
{
    use helpers;
    private $itemInterface;
    public function __construct(ItemInterface $itemInterface)
    {
        $this->itemInterface = $itemInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemData = $this->itemInterface->index();
        if(!is_string($itemData) && $itemData->first())
        {
        return $this->apiResponse(new GeneralCollection($itemData,ItemResource::class));
        }elseif(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $itemData = $this->itemInterface->store($request);
        if(!is_string($itemData) && $itemData->first())
        {
        return $this->apiResponse(['data' => new ItemResource($itemData)]);
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
        $itemData = $this->itemInterface->show($id);
        if(!is_string($itemData) && $itemData->first())
        {
        return $this->apiResponse(new GeneralCollection($itemData,ItemResource::class));
        }elseif(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        $itemData = $this->itemInterface->update($request ,$id);
        if(!is_string($itemData) && $itemData->first())
        {
            return $this->apiResponse(['data' => new ItemResource($itemData)]);
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
        $itemData = $this->itemInterface->destroy($id);
        if(is_string($itemData)){
            return $this->apiResponse(['message' => $itemData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

}
