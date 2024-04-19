<?php
namespace  App\DBrepo\General;

use Exception;
use App\helpers;
use App\Models\OrderDetail;
use App\Models\OrderMaster;
use Illuminate\Support\Facades\DB;
use App\RepoInterface\Order\OrderInterface;

class DBOrder implements OrderInterface{
    use helpers;

    private $orderModel;
    private $orderDetailsModel;
    public function __construct(OrderMaster $orderModel, OrderDetail $orderDetailsModel)
    {
        $this->orderModel = $orderModel;
        $this->orderDetailsModel = $orderDetailsModel;
    }
    public function index(){
        try{
        return $this->orderModel->get();
    }catch(Exception $e){
        return $e->getMessage();
    }
    
    }
    public function show($id){
        try{
        return $this->orderModel->where('id',$id)->get();
    }catch(Exception $e){
        return $e->getMessage();
    }
    
    }
    public function store($request){
                                                                                                    
        
        try{
            DB::beginTransaction();
        $orderCreate = $this->orderModel::create([
            'pos_id'=>$request->pos_id,
            'order_date'=>$request->order_date,
            'order_no'=>$request->order_no,//*********************************** */
            'logo'=>$request->prefix ,//*************************************** */
            'service_id'=>$request->service_id ,
            'table_no'=>$request->table_no ,
            'room_no'=>$request->room_no,
            'guest_id'=>$request->guest_id,
            'gross_amount'=>$request->gross_amount ,//*********************** */
            'discount_amount'=>$request->discount_amount ,//**************** */
            'service_charge'=>$request->service_charge ,//***************** */
            'taxes_amount'=>$request->taxes_amount ,//******************** */
            'paid_amount'=>$request->paid_amount ,//********************* */
            'is_multi_payment'=>$request->is_multi_payment ,
            'is_cancel'=>$request->is_cancel ,
            'cancel_by'=>$request->cancel_by,
            'cancel_at'=>$request->cancel_at ,
            'fo_post'=>$request->fo_post ,
            'created_by'=>auth()->user()->id,
            'finish_by'=>$request->finish_by,
            'sys_ip'=>$request->sys_ip,//***************************** */
            'last_updated_by'=>$request->last_updated_by ,
            'guest_name'=>$request->guest_name,
            'no_of_guest'=>$request->no_of_guest,
            'waiter_id'=>$request->waiter_id ,
            'qr_code'=>$request->qr_code ,
        ]);
        $this->storeOrderDetails($request,$orderCreate->id);
        DB::commit();
        $orderData = $this->orderModel->where('id',$orderCreate->id)->first();
        return $orderData;
    }catch(Exception $e){
        DB::rollBack();
        return $e->getMessage();
    }

    
    }
    public function storeOrderDetails($request,$orderMasterID){
                                                                                                    
        try{
            foreach($request->details as $detail)
            {
                $orderCreate = $this->orderModel::create([
                    'pos_id'=>$request->pos_id,
                    'order_date'=>$request->order_date,
                    'order_master_id'=>$orderMasterID,
                    'srl_no'=>$detail['srl_no'] ,//*************************************** */
                    'item_id'=>$detail['item_id'] ,
                    'item_price'=>$detail['item_price'] ,
                    'discount'=>$detail['discount'],
                    'qty'=>$detail['qty'],
                    'void'=>$detail['void'] ,
                    'printed'=>$detail['printed'] ,
                    'edit_flag'=>$detail['edit_flag'] ,
                    'options'=>$detail['options'] ,//******************** */
                ]);
            }   
        return 'true';
    }catch(Exception $e){
        return $e->getMessage();
    }

    
    }
   
    public function update($request, $id){
        try{
        $orderData = $this->show($id)->first();

        $orderUpdate = $this->orderModel::where('id',$id)->update([
            'name' => (!empty($request->name)) ? $request->name : $orderData->name,
           
        ]);
        return  $this->show($id)->first();
    }catch(Exception $e){
        return $e->getMessage();
    }
    
    
    }
    public function destroy($id){
            $orderData = $this->orderModel->where('id',$id)->first();
        if($orderData){
            return 'deleted';
        }else{
            return null;
            
        }
        
    }

   
}
