<?php

namespace  App\DBrepo\Item;

use Exception;
use App\Models\ItemSubCategory;
use App\RepoInterface\Item\ItemSubCategoryInterface;

class DBitemSubCategory implements ItemSubCategoryInterface
{
    private $ItemSubCategoryModel;

    public function __construct(ItemSubCategory $ItemSubCategoryModel)
    {
        $this->ItemSubCategoryModel = $ItemSubCategoryModel;
    }
    public function index()
    {
        try {
            $itemSubCatData = $this->ItemSubCategoryModel::get();

            return $itemSubCatData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $itemSubCatShow = $this->ItemSubCategoryModel::where('id', $id)->get();
            return $itemSubCatShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                // You may also store the image path in the database if needed
                $imagePath = 'images/' . $imageName;
            }
            $itemSubCatStore = $this->ItemSubCategoryModel::create([
                'pos_id' => $request->pos_id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'name_loc' => $request->name_loc,
                'color' => $request->color,
                'image' => $imagePath,
            ]);


            return $itemSubCatStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function update($request, $id)
    {

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                // You may also store the image path in the database if needed
                $imagePath = 'images/' . $imageName;
            }
            $itemSubCatdata = $this->show($id)->first();
            $itemSubCatUpdate = $this->ItemSubCategoryModel::where('id', $id)->update([
                'pos_id' => (!empty($request->pos_id)) ? $request->pos_id : $itemSubCatdata->pos_id,
                'pos_id' => (!empty($request->category_id)) ? $request->category_id : $itemSubCatdata->category_id,
                'name' => (!empty($request->name)) ? $request->name : $itemSubCatdata->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $itemSubCatdata->name_loc,
                'color' => (!empty($request->color)) ? $request->color : $itemSubCatdata->color,
                'image' => (!empty($imagePath)) ? $imagePath : $itemSubCatdata->imagePathge,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {

        $itemSubCatTrashed = $this->ItemSubCategoryModel::where('id', $id)->first();
        if ($itemSubCatTrashed) {
            $itemSubCatTrashed->delete();
            return 'ItemSubCategory Is Deleted';
        } else {
            return null;
        }
    }
}