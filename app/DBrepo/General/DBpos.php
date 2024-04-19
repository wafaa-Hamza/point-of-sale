<?php
namespace  App\DBrepo\General;

use App\helpers;
use App\Models\Pos;
use App\Models\User;
use App\RepoInterface\General\PosInterface;
use Illuminate\Support\Facades\Config;

use Exception;

class DBpos implements PosInterface{
    use helpers;

    private $posModel;
    private $userModel;
    public function __construct(Pos $posModel, User $userModel)
    {
        $this->posModel = $posModel;
        $this->userModel = $userModel;
    }
    public function index(){
        try{
        return $this->posModel->get();
    }catch(Exception $e){
        return $e->getMessage();
    }
    
    }
    public function show($id){
        try{
        return $this->posModel->where('id',$id)->get();
    }catch(Exception $e){
        return $e->getMessage();
    }
    
    }
    public function store($request){
       
       // dd($request);
        try{
            if($request->has('logo')) {
                $request->file = $request->logo;
                $logo =  $this->uploadFile($request, 'storage/posFile', 'posLogo', null);
            }
        $posCreate = $this->posModel::create([
            'name'=>$request->name,
            'name_loc'=>$request->name_loc,
            'phone'=>$request->phone,
            'logo'=>(!empty($logo)) ? $logo : null,
        ]);
        $posData = $this->posModel->where('id',$posCreate->id)->first();
        return $posData;
    }catch(Exception $e){
        return $e->getMessage();
    }

    
    }
    public function update($request, $id){
        try{
        $posData = $this->show($id)->first();
        if($request->has('logo'))
        {
            $request->file = $request->logo;
            $logo = $this->uploadFile($request,'storage/posFile','posLogo',$posData->logo);

        }
        $posUpdate = $this->posModel::where('id',$id)->update([
            'name' => (!empty($request->name)) ? $request->name : $posData->name,
            'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $posData->name_loc,
            'logo' => (!empty($request->logo)) ? $logo : $posData->logo,
            'phone' => (!empty($request->phone)) ? $request->phone : $posData->phone,
        ]);
        return  $this->show($id)->first();
    }catch(Exception $e){
        return $e->getMessage();
    }
    
    
    }
    public function destroy($id){
            $posData = $this->posModel->where('id',$id)->first();
        if($posData){
            return 'deleted';
        }else{
            return null;
            
        }
        
    }

   
}
