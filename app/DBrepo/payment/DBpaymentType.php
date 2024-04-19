<?php

namespace App\DBrepo\payment;

use Exception;
use App\Models\PaymentType;
use App\RepoInterface\Payment\PaymentTypeInterface;

class DBpaymentType implements PaymentTypeInterface
{
    private $PaymentTypeModel;
    public function __construct(PaymentType $PaymentTypeModel)
    {
        $this->PaymentTypeModel = $PaymentTypeModel;
    }

    public function index()
    {
        try {
            $paymentData = $this->PaymentTypeModel::get();
            return  $paymentData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function store($request)
    {
        try {
            $paymentStore = $this->PaymentTypeModel::create([
                'name' => $request->name,
                'name_loc' => $request->name_loc,
                'type' => $request->type,
                'payment_mode_id' => $request->payment_mode_id,
                'gl_account' => $request->gl_account,
                'fo_pay_id' => $request->fo_pay_id,
                'is_cash' => $request->is_cash,
                'active' => $request->active,

            ]);
            return $paymentStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function show($id)
    {
        try {
            $paymentShow = $this->PaymentTypeModel::where('id', $id)->get();
            return $paymentShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($request, $id)
    {
        try {
            $PaymentData = $this->show($id)->first();
            $paymentUpdate = $this->PaymentTypeModel::where('id', $id)->update([
                'name' => (!empty($request->name)) ? $request->name : $PaymentData->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $PaymentData->name_loc,
                'type' => (!empty($request->type)) ? $request->type : $PaymentData->type,
                'payment_mode_id' => (!empty($request->payment_mode_id)) ? $request->payment_mode_id : $PaymentData->payment_mode_id,
                'gl_account' => (!empty($request->gl_account)) ? $request->gl_account : $PaymentData->gl_account,
                'fo_pay_id' => (!empty($request->fo_pay_idme)) ? $request->fo_pay_idme : $PaymentData->fo_pay_idme,
                'is_cash' => (!empty($request->is_cash)) ? $request->is_cash : $PaymentData->is_cash,
                'active' => (!empty($request->active)) ? $request->active : $PaymentData->active,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {

        $paymentTrashed = $this->PaymentTypeModel::where('id', $id)->first();
        if ($paymentTrashed) {
            $paymentTrashed->delete();
            return 'PaymentType Is Deleted';
        } else {
            return null;
        }
    }
}
