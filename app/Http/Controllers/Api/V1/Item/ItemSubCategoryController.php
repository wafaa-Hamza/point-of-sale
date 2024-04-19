<?php

namespace App\Http\Controllers\Api\V1\Item;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\ItemSubCategoryResource;
use App\RepoInterface\Item\ItemSubCategoryInterface;

class ItemSubCategoryController extends Controller
{
    use helpers;
    private $ItemSubCategoryInterface;
    public function __construct(ItemSubCategoryInterface $ItemSubCategoryInterface)
    {
        $this->ItemSubCategoryInterface = $ItemSubCategoryInterface;
    }
    public function index()
    {
        $itemSubCatData = $this->ItemSubCategoryInterface->index();
        if ($itemSubCatData->first()) {
            return $this->apiResponse(new GeneralCollection($itemSubCatData, ItemSubCategoryResource::class));
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function store(Request $request)
    {
        $itemSubCatStore = $this->ItemSubCategoryInterface->store($request);
        if (!is_string($itemSubCatStore) && $itemSubCatStore->first()) {
            return $this->apiResponse(['data' => new ItemSubCategoryResource($itemSubCatStore)]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function show(string $id)
    {
        $itemSubCatShow = $this->ItemSubCategoryInterface->show($id);
        if (!is_string($itemSubCatShow) && $itemSubCatShow->first()) {
            return $this->apiResponse(new GeneralCollection($itemSubCatShow, ItemSubCategoryResource::class));
        } elseif (is_string($itemSubCatShow)) {
            return $this->apiResponse(['message' => $itemSubCatShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $itemSubCatUpdate = $this->ItemSubCategoryInterface->update($request, $id);
        if (!is_string($itemSubCatUpdate) && $itemSubCatUpdate->first()) {

            return $this->apiResponse(['data' => new ItemSubCategoryResource($itemSubCatUpdate)]);
        } elseif (is_string($itemSubCatUpdate)) {
            return $this->apiResponse(['message' => $itemSubCatUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function destroy(string $id)
    {
        $itemSubCatTrashed = $this->ItemSubCategoryInterface->destroy($id);
        if (is_string($itemSubCatTrashed)) {
            return $this->apiResponse(['message' => $itemSubCatTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
