<?php

namespace  App\Http\Controllers\Api\V1\Payment;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\PaymentTypeResource;
use App\RepoInterface\payment\PaymentTypeInterface;


class PaymentTypeController extends Controller
{
    use helpers;
    private $PaymentTypeInterface;

    public function __construct(PaymentTypeInterface $PaymentTypeInterface)
    {
        $this->PaymentTypeInterface = $PaymentTypeInterface;
    }
    public function index()
    {

        $paymentData = $this->PaymentTypeInterface->index();
        if (!is_string($paymentData) && $paymentData->first()) {
            return $this->apiResponse(['data' => new PaymentTypeResource($paymentData)]);
        } elseif (is_string($paymentData)) {
            return $this->apiResponse(['message' => $paymentData]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
    public function store(Request $request)
    {
        $paymentStore = $this->PaymentTypeInterface->store($request);
        if (!is_string($paymentStore) && $paymentStore->first()) {
            return $this->apiResponse(['data' => new PaymentTypeResource($paymentStore)]);
        } elseif (is_string($paymentStore)) {
            return $this->apiResponse(['message' => $paymentStore]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
    public function show(string $id)
    {
        $paymentShow = $this->PaymentTypeInterface->show($id);
        if (!is_string($paymentShow) && $paymentShow->first()) {
            return $this->apiResponse(new GeneralCollection($paymentShow, PaymentTypeResource::class));
        } elseif (is_string($paymentShow)) {
            return $this->apiResponse(['message' => $paymentShow]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }

    public function update(Request $request, $id)
    {

        $paymentUpdate = $this->PaymentTypeInterface->update($request, $id);
        if (!is_string($paymentUpdate) && $paymentUpdate->first()) {

            return $this->apiResponse(['data' => new PaymentTypeResource($paymentUpdate)]);
        } elseif (is_string($paymentUpdate)) {
            return $this->apiResponse(['message' => $paymentUpdate]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
    public function destroy(string $id)
    {
        $paymentTrashed = $this->PaymentTypeInterface->destroy($id);
        if (is_string($paymentTrashed)) {
            return $this->apiResponse(['message' => $paymentTrashed]);
        } else {
            return $this->apiResponse(['message' => 'Not Found']);
        }
    }
}
