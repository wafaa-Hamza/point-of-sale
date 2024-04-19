<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\ItemCategoryResource;
use App\RepoInterface\Item\ItemCategoryInterface;

class ItemCategoryController extends Controller
{
    use helpers;
    private $ItemCategoryInterface;

    public function __construct(ItemCategoryInterface $ItemCategoryInterface)
    {
        $this->ItemCategoryInterface = $ItemCategoryInterface;
    }

    public function index()
    {
        $itemCatData = $this->ItemCategoryInterface->index();
        if ($itemCatData->first()) {
            return $this->apiResponse(new GeneralCollection($itemCatData, ItemCategoryResource::class));
        } else {
            return $this->apiResponse(['message' =>  $itemCatData]);
        }
    }

    public function store(Request $request)
    {
        $itemCatStore = $this->ItemCategoryInterface->store($request);
        if (!is_string($itemCatStore) && $itemCatStore->first()) {
            return $this->apiResponse(['data' => new ItemCategoryResource($itemCatStore)]);
        } else {
            return $this->apiResponse(['message' =>  $itemCatStore]);
        }
    }
    public function show(string $id)
    {
        $itemCatShow = $this->ItemCategoryInterface->show($id);
        if (!is_string($itemCatShow) && $itemCatShow->first()) {
            return $this->apiResponse(new GeneralCollection($itemCatShow, ItemCategoryResource::class));
        } elseif (is_string($itemCatShow)) {
            return $this->apiResponse(['message' => $itemCatShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $itemCatUpdate = $this->ItemCategoryInterface->update($request, $id);
        if (!is_string($itemCatUpdate) && $itemCatUpdate->first()) {

            return $this->apiResponse(['data' => new ItemCategoryResource($itemCatUpdate)]);
        } elseif (is_string($itemCatUpdate)) {
            return $this->apiResponse(['message' => $itemCatUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function destroy(string $id)
    {
        $itemCatTrashed = $this->ItemCategoryInterface->destroy($id);
        if (is_string($itemCatTrashed)) {
            return $this->apiResponse(['message' => $itemCatTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
