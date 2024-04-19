<?php

namespace  App\DBrepo\Item;

use Exception;
use App\helpers;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Models\pivote_service_item;
use App\RepoInterface\Item\ItemInterface;

class DBitem implements ItemInterface
{
    use helpers;
    private $ItemModel;
    private $PivoteServiceItemModel;

    public function __construct(Item $ItemModel,pivote_service_item $PivoteServiceItemModel)
    {
        $this->ItemModel = $ItemModel;
        $this->PivoteServiceItemModel = $PivoteServiceItemModel;
    }
    public function index()
    {
        try {
            $itemData = $this->ItemModel::get();

            return $itemData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $itemShow = $this->ItemModel::where('id', $id)->get();
            return $itemShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try{
if($request->has('item_img')) {
    $request->file = $request->item_img;
    $itemImg =  $this->uploadFile($request, 'storage/item', 'itemImg', null);
}
            DB::beginTransaction();
        $itemCreate = $this->ItemModel::create([
            'name'=>$request->name,
            'name_loc'=>$request->name_loc,
            'pos_id'=>$request->pos_id,
            'item_img'=>(!empty($itemImg)) ? $itemImg : null,
            'cost'=>$request->cost,
            'inv_store_code'=>null,//$request->inv_store_code,*************
            'inv_item_code'=>null,//$request->inv_store_code,*************
            'kitchen_printer'=>$request->kitchen_printer,
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id,
            'active'=>($request->active == 0 && $request->has('active')) ? 0 : 1,
        ]);
        
        if($request->has('pivote'))
        {
            foreach($request->pivote as $pivote)
            {
                $pivoteCreate = $this->PivoteServiceItemModel::create([
                    'service_id' => $pivote['service_id'],
                    'item_id' =>  $itemCreate['id'],
                    'price' =>$pivote['price'] ,
                ]);
            }
        }
        DB::commit();
        $itemData = $this->ItemModel->where('id',$itemCreate->id)->first();
        return $itemData;
    }catch(Exception $e){
        DB::rollBack();
        return $e->getMessage();
    }

    }


    public function update($request, $id)
    {
        try{
            $itemData = $this->show($id)->first();
            if($request->has('item_img'))
            {
                $request->file = $request->item_img;
                $itemImg =  $this->uploadFile($request,'storage/item','itemImg',$itemData->item_img);
    
            }
            $posUpdate = $this->ItemModel::where('id',$id)->update([
                'name' => (!empty($request->name)) ? $request->name : $itemData->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $itemData->name_loc,
                'item_img' => (!empty($request->item_img)) ? $itemImg : $itemData->item_img,
                'pos_id'=>(!empty($request->pos_id)) ? $request->pos_id : $itemData->pos_id,
                'cost'=>(!empty($request->cost)) ? $request->cost : $itemData->cost,
                'inv_store_code'=>null, //(!empty($request->inv_store_code)) ? $request->inv_store_code : $itemData->inv_store_code,
                'inv_item_code'=>null,//(!empty($request->inv_item_code)) ? $request->inv_item_code : $itemData->inv_item_code,
                'kitchen_printer'=>(!empty($request->kitchen_printer)) ? $request->kitchen_printer : $itemData->kitchen_printer,
                'category_id'=>(!empty($request->category_id)) ? $request->category_id : $itemData->category_id,
                'sub_category_id'=>(!empty($request->sub_category_id)) ? $request->sub_category_id : $itemData->sub_category_id,
                'active'=>($request->active == 0 && $request->has('active')) ? 0 : 1,
            ]);
            return  $this->show($id)->first();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {

        $itemTrashed = $this->ItemModel::where('id', $id)->first();
        if ($itemTrashed) {
            $itemTrashed->delete();
            return 'Item Is Deleted';
        } else {
            return null;
        }
    }
}