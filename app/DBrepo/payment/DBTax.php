<?php

namespace App\DBrepo\payment;

use App\Models\Tax;
use Exception;
use App\RepoInterface\payment\TaxInterface;

class DBTax implements TaxInterface
{
    private $taxModel;
    public function __construct(Tax $taxModel)
    {
        $this->taxModel = $taxModel;
    }

    public function index()
    {
        try {
            $taxData = $this->taxModel::get();
            return  $taxData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function store($request)
    {

        try {
            $taxStore = $this->taxModel::create([
                'name' => $request->name,
                'name_loc' => $request->name_loc,
                'pos_id' => $request->pos_id,
                'per' => $request->per,
                'amount' => $request->amount,
                'formula' => $request->formula,
                'extra' => $request->extra,
                'accept_per' =>($request->has('accept_per')) ? $request->accept_per : 1,
            ]);
            return $taxStore;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function show($id)
    {
        try {
            $taxShow = $this->taxModel::where('id', $id)->get();
            return $taxShow;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($request, $id)
    {
        try {
            $taxData = $this->show($id)->first();
            $taxUpdate = $this->taxModel::where('id', $id)->update([
                'name' => (!empty($request->name)) ? $request->name : $taxData->name,
                'name_loc' => (!empty($request->name_loc)) ? $request->name_loc : $taxData->name_loc,
                'pos_id' => (!empty($request->pos_id)) ? $request->pos_id : $taxData->pos_id,
                'per' => (!empty($request->per)) ? $request->per : $taxData->per,
                'amount' => (!empty($request->amount)) ? $request->amount : $taxData->amount,
                'formula' => (!empty($request->formula)) ? $request->formula : $taxData->formula,
                'extra' => (!empty($request->extra)) ? $request->extra : $taxData->extra,
                'accept_per' => (!empty($request->accept_per)) ? $request->accept_per : $taxData->accept_per,

            ]);
            return  $this->show($id)->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {

        $taxTrashed = $this->taxModel::where('id', $id)->first();
        if ($taxTrashed) {
            $taxTrashed->delete();
            return 'Tax Deleted';
        } else {
            return null;
        }
    }
}