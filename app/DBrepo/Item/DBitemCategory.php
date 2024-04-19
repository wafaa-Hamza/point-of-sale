<?php

namespace  App\DBrepo\Item;

use App\helpers;
use Exception;
use App\Models\ItemCategory;
use App\RepoInterface\Item\ItemCategoryInterface;

class DBitemCategory implements ItemCategoryInterface
{
    use helpers;
    private $ItemCategoryModel;

    public function __construct(ItemCategory $ItemCategoryModel)
    {
        $this->ItemCategoryModel = $ItemCategoryModel;
    }
    public function index()
    {
        try {
            $itemCatData = $this->ItemCategoryModel::get();
            // $itemCatData2 = $this->get_generalSetup();
            // dd($itemCatData2);
            return $itemCatData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $itemCatShow = $this->ItemCategoryModel::where('id', $id)->get();
            return $itemCatShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try {

            // $eee = $this->create_generalSetup($request);
            // return $eee;
            if ($request->has('image')) {

                if ($request->hasFile('image')) {

                    $request->file = $request->images;
                    $images =  $this->uploadFile($request, 'storage/iten/itemCat', 'itemCatImage', null);
                }
            }
            $itemCatStore = $this->ItemCategoryModel::create([
                'pos_id' => $request->pos_id,
                'name' => $request->name,
                'name_loc' => $request->name_loc,
                'color' => $request->color,
                'image' => (!empty($images)) ? $images : null,
            ]);
            return $itemCatStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function update($request, $id)
    {

        try {
            // $eee = $this->update_generalSetup($request, $id);
            // dd($eee);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                // You may also store the image path in the database if needed
                $imagePath = 'images/' . $imageName;
            }
            $itemCatdata = $this->show($id)->first();
            $itemCatUpdate = $this->ItemCategoryModel::where('id', $id)->update([
                'pos_id' => (!empty($request->pos_id)) ? $request->pos_id : $itemCatdata->pos_id,
                'name' => (!empty($request->name)) ? $request->name : $itemCatdata->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $itemCatdata->name_loc,
                'color' => (!empty($request->color)) ? $request->color : $itemCatdata->color,
                'image' => (!empty($imagePath)) ? $imagePath : $itemCatdata->imagePath,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }




    public function destroy($id)
    {
        $itemCatTrashed = $this->ItemCategoryModel::where('id', $id)->first();
        if ($itemCatTrashed) {
            $itemCatTrashed->delete();
            return 'ItemCategory Is Deleted';
        } else {
            return null;
        }
    }
}