<?php

namespace  App\DBrepo\Item;

use Exception;
use App\helpers;
use App\Models\Package;
use App\Models\Package_item;
use Illuminate\Support\Facades\DB;
use App\RepoInterface\Item\PackageInterface;

class DBPackage implements PackageInterface
{
    use helpers;
    private $packageModel;
    private $packageItemModel;

    public function __construct(Package $packageModel, Package_item $packageItemModel)
    {
        $this->packageModel = $packageModel;
        $this->packageItemModel = $packageItemModel;
    }
    public function index()
    {
        try {
            $packageData = $this->packageModel::get();

            return $packageData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $packageShow = $this->packageModel::where('id', $id)->get();
            return $packageShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store($request)
    {
        try{

            DB::beginTransaction();
        $packageCreate = $this->packageModel::create([
            'name'=>$request->name,
            'name_loc'=>$request->name_loc,
            'price'=>$request->price,
            'pos_id'=>$request->pos_id,
        ]);
        
        if($request->has('pivote'))
        {
            foreach($request->pivote as $pivote)
            {
                $pivoteCreate = $this->packageItemModel::create([
                    'package_id' => $packageCreate->id,
                    'item_id' =>  $pivote['item_id'],
                ]);
            }
        }
        DB::commit();
        $packageData = $this->packageModel->where('id',$packageCreate->id)->first();
        return $packageData;
    }catch(Exception $e){
        DB::rollBack();
        return $e->getMessage();
    }

    }


    public function update($request, $id)
    {
        try{
            $packageData = $this->show($id)->first();

            $posUpdate = $this->packageModel::where('id',$id)->update([
                'name' => (!empty($request->name)) ? $request->name : $packageData->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $packageData->name_loc,
                'price' => (!empty($request->price)) ? $request->price : $packageData->price,
                'pos_id'=>(!empty($request->pos_id)) ? $request->pos_id : $packageData->pos_id,
            ]);
            
            if($request->has('pivote'))
            {
                foreach($request->pivote as $pivote)
                {
                    $pivoteCreate = $this->packageItemModel::where('id',$id)->update([
                        'package_id' => $id,
                        'item_id' =>  $pivote['item_id'],
                    ]);
                }
            }
            return  $this->show($id)->first();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {

        $packageTrashed = $this->packageModel::where('id', $id)->first();
        if ($packageTrashed) {
            $packageTrashed->delete();
            return 'Package Deleted';
        } else {
            return null;
        }
    }
}