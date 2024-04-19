<?php

namespace App\Http\Controllers\Api\V1\General;

use App\helpers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PosRequest;
use App\Http\Resources\PosResource;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isEmpty;

use App\Http\Resources\GeneralCollection;
use App\RepoInterface\General\PosInterface;
use Illuminate\Support\Facades\Config;
class PosController extends Controller
{
    use helpers;
    private $posInterface;
    public function __construct(PosInterface $posInterface)
    {
        $this->posInterface = $posInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $posData = $this->posInterface->index();
        if(!is_string($posData) && $posData->first())
        {
        return $this->apiResponse(new GeneralCollection($posData,PosResource::class));
        }elseif(is_string($posData)){
            return $this->apiResponse(['message' => $posData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PosRequest $request)
    {
        $posData = $this->posInterface->store($request);
        if(!is_string($posData) && $posData->first())
        {
        return $this->apiResponse(['data' => new PosResource($posData)]);
        }elseif(is_string($posData)){
            return $this->apiResponse(['message' => $posData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posData = $this->posInterface->show($id);
        if(!is_string($posData) && $posData->first())
        {
        return $this->apiResponse(new GeneralCollection($posData,PosResource::class));
        }elseif(is_string($posData)){
            return $this->apiResponse(['message' => $posData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posData = $this->posInterface->update($request ,$id);
        if(!is_string($posData) && $posData->first())
        {
            return $this->apiResponse(['data' => new PosResource($posData)]);
        }elseif(is_string($posData)){
            return $this->apiResponse(['message' => $posData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posData = $this->posInterface->destroy($id);
        if(is_string($posData)){
            return $this->apiResponse(['message' => $posData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
   
}
