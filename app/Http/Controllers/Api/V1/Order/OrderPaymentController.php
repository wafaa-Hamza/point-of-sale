<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\OrderPaymentResource;
use App\RepoInterface\Order\orderPaymentInterface;

class OrderPaymentController extends Controller
{
    use helpers;
    private $orderPaymentInterface;

    public function __construct(orderPaymentInterface $orderPaymentInterface)
    {
        $this->orderPaymentInterface = $orderPaymentInterface;
    }

    public function index()
    {
        $orderPaymentData = $this->orderPaymentInterface->index();
        if ($orderPaymentData->first()) {
            return $this->apiResponse(new GeneralCollection($orderPaymentData, OrderPaymentResource::class));
        } else {

            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function store(Request $request)
    {
        $orderPaymentStore = $this->orderPaymentInterface->store($request);
        if (!is_string($orderPaymentStore) && $orderPaymentStore->first()) {
            return $this->apiResponse(['data' => new OrderPaymentResource($orderPaymentStore)]);
        } else {
            return $this->apiResponse(['message' =>  $orderPaymentStore]);
        }
    }
    public function show(string $id)
    {
        $orderPaymentShow = $this->orderPaymentInterface->show($id);
        if (!is_string($orderPaymentShow) && $orderPaymentShow->first()) {
            return $this->apiResponse(new GeneralCollection($orderPaymentShow, OrderPaymentResource::class));
        } elseif (is_string($orderPaymentShow)) {
            return $this->apiResponse(['message' => $orderPaymentShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $orderPaymentUpdate = $this->orderPaymentInterface->update($request, $id);
        if (!is_string($orderPaymentUpdate) && $orderPaymentUpdate->first()) {

            return $this->apiResponse(['data' => new OrderPaymentResource($orderPaymentUpdate)]);
        } elseif (is_string($orderPaymentUpdate)) {
            return $this->apiResponse(['message' => $orderPaymentUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function destroy(string $id)
    {
        $orderPaymentTrashed = $this->orderPaymentInterface->destroy($id);
        if (is_string($orderPaymentTrashed)) {
            return $this->apiResponse(['message' => $orderPaymentTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
