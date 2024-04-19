<?php

namespace  App\DBrepo\Order;

use Exception;
use App\helpers;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\DB;
use App\RepoInterface\Order\orderPaymentInterface;

class DBorderPayment implements orderPaymentInterface
{
    use helpers;

    private $OrderPaymentModel;

    public function __construct(OrderPayment $OrderPaymentModel)
    {
        $this->OrderPaymentModel = $OrderPaymentModel;
    }
    public function index()
    {
        try {
            return $this->OrderPaymentModel->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function show($id)
    {
        try {
            return $this->OrderPaymentModel->where('id', $id)->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function store($request)
    {


        try {
            DB::beginTransaction();
            $orderPaymentCreate = $this->OrderPaymentModel::create([
                'pos_id' => $request->pos_id,
                'order_date' => $request->order_date,
                'order_master_id' => $request->order_master_id,
                'payment_type_id' => $request->payment_type_id,
                'amount' => $request->amount,
                'is_cash' => $request->is_cash,
                // 'room_no' => $request->room_no, 
                // 'guest_id' => $request->guest_id,

            ]);

            DB::commit();
            $orderData = $this->OrderPaymentModel->where('id', $orderPaymentCreate->id)->first();
            return $orderPaymentCreate;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function update($request, $id)
    {
        try {
            $orderData = $this->show($id)->first();

            $orderPaymentUpdate = $this->OrderPaymentModel::where('id', $id)->update([
                'pos_id' => $request->pos_id,
                'order_date' => $request->order_date,
                'order_master_id' => $request->order_master_id,
                'payment_type_id' => $request->payment_type_id,
                'amount' => $request->amount,
                'is_cash' => $request->is_cash,
                // 'room_no' => $request->room_no, 
                // 'guest_id' => $request->guest_id,


            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        $orderData = $this->OrderPaymentModel->where('id', $id)->first();
        if ($orderData) {
            return 'deleted';
        } else {
            return null;
        }
    }
}
