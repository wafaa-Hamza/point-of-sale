<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Requests\TaxRequest;
use App\Http\Resources\TaxResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\RepoInterface\payment\TaxInterface;

class TaxController extends Controller
{
    use helpers;
    private $taxInterface;
    public function __construct(TaxInterface $taxInterface)
    {
        $this->taxInterface = $taxInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxData = $this->taxInterface->index();
        if(!is_string($taxData) && $taxData->first())
        {
        return $this->apiResponse(new GeneralCollection($taxData,TaxResource::class));
        }elseif(is_string($taxData)){
            return $this->apiResponse(['message' => $taxData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxRequest $request)
    {
        $taxData = $this->taxInterface->store($request);
        if(!is_string($taxData) && $taxData->first())
        {
        return $this->apiResponse(['data' => new TaxResource($taxData)]);
        }elseif(is_string($taxData)){
            return $this->apiResponse(['message' => $taxData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taxData = $this->taxInterface->show($id);
        if(!is_string($taxData) && $taxData->first())
        {
        return $this->apiResponse(new GeneralCollection($taxData,TaxResource::class));
        }elseif(is_string($taxData)){
            return $this->apiResponse(['message' => $taxData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaxRequest $request, string $id)
    {
        $taxData = $this->taxInterface->update($request ,$id);
        if(!is_string($taxData) && $taxData)
        {
            return $this->apiResponse(['data' => new TaxResource($taxData)]);
        }elseif(is_string($taxData)){
            return $this->apiResponse(['message' => $taxData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taxData = $this->taxInterface->destroy($id);
        if(is_string($taxData)){
            return $this->apiResponse(['message' => $taxData]);
        }else{
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}