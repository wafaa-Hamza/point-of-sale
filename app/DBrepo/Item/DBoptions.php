<?php

namespace  App\DBrepo\Item;

use Exception;
use App\helpers;
use App\Models\Option;
use App\RepoInterface\Item\OptionsInterface;

class DBoptions implements OptionsInterface
{
    use helpers;
    private $optionModel;

    public function __construct(Option $optionModel)
    {
        $this->optionModel = $optionModel;
    }
    public function index()
    {
        try {
            $optionData = $this->optionModel::get();

            return $optionData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $optionshow = $this->optionModel::where('id', $id)->get();
            return $optionshow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try{
        $optionCreate = $this->optionModel::create([
            'name'=>$request->name,
            'name_loc'=>$request->name_loc,
            'pos_id'=>$request->pos_id,
            'item_id'=>$request->item_id,
        ]);
        $optionData = $this->optionModel->where('id',$optionCreate->id)->first();
        return $optionData;
    }catch(Exception $e){
        return $e->getMessage();
    }

    }


    public function update($request, $id)
    {
        try{
            $optionData = $this->show($id)->first();
           
            $posUpdate = $this->optionModel::where('id',$id)->update([
                'name' => (!empty($request->name)) ? $request->name : $optionData->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $optionData->name_loc,
                'pos_id'=>(!empty($request->pos_id)) ? $request->pos_id : $optionData->pos_id,
                'item_id'=>(!empty($request->item_id)) ? $request->item_id : $optionData->item_id,
            ]);
            return  $this->show($id)->first();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {

        $optionTrashed = $this->optionModel::where('id', $id)->first();
        if ($optionTrashed) {
            $optionTrashed->delete();
            return 'Item Is Deleted';
        } else {
            return null;
        }
    }
}
