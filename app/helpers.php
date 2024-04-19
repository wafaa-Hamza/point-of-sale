<?php

namespace App;

use App\Models\GeneralSetup;
use App\Models\Setting;
use GuzzleHttp\Psr7\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Multitenancy\Models\Tenant;

trait helpers
{


    function apiResponse($data, $status = 200)
    {
        return response()->json($data, $status);
    }
    /**
     * $request = $request that hase file
     * $path like 'storage/expensesFile'
     * $prefixName = any name pefore image NAme
     * $lastFile = the last file from DB if you want update it
     * return fileName
     */
    private function uploadFile($request, $path, $prefixName, $lastFile = null)
    {
        $arrDBNameSaved = [];
        if (is_array($request->file)) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $fileNanme = $prefixName . '_' . time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileNanme);
                $DBNameSaved = $path . '/' . $fileNanme;
                array_push($arrDBNameSaved, $DBNameSaved);
            }
            return $arrDBNameSaved;
        } else {
            $file = $request->file;
            $fileNanme = $prefixName . '_' . time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileNanme);
            $DBNameSaved = $path . '/' . $fileNanme;
        }



        if ($lastFile) {
            Storage::delete($lastFile);
        }
        return $DBNameSaved;
    }
    private function deleteFile($request)
    {

        Storage::delete($request);
        return true;
    }

    public function get_generalSetup()
    {
        $getGeneralSetup = GeneralSetup::get();
        return $getGeneralSetup;
    }

    public function create_generalSetup($request)
    {
        $generalSetupData = GeneralSetup::create([
            'pos_id' => $request->pos_id,
            'pos_date' => $request->pos_date,
            'is_inventory' => $request->is_inventory,
            'is_kitchen_printer' => $request->is_kitchen_printer,
            // 'pos_room_id' => $request->pos_room_id,
            // 'vat_number' => $request->vat_number,
        ]);
        return $generalSetupData;
    }

    public function update_generalSetup($request, $id)
    {
        $generalSetupData_update = GeneralSetup::where('id', $id)->update([
            'pos_id' => $request->pos_id,
            'pos_date' => $request->pos_date,
            'is_inventory' => $request->is_inventory,
            'is_kitchen_printer' => $request->is_kitchen_printer,
            // 'pos_room_id' => $request->pos_room_id,
            // 'vat_number' => $request->vat_number,
        ]);
        return $generalSetupData_update;
    }
    //    private function settings()
    //    {
    //     $tenant_id = Tenant::current();
    //     if($tenant_id)
    //     {
    //          $settings = cache('settings_'.$tenant_id->id);
    //     }else{
    //         $settings = Setting::get();
    //     }
    //     return $settings;
    //    }
}


 