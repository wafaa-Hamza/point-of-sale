<?php

namespace App\Models;

use App\Models\Item;
use App\Models\OrderMaster;
use App\Models\Pos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderDetail extends Model
{
    use HasFactory, LogsActivity;


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Pos has been {$eventName}");
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
    public function master()
    {
        return $this->belongsTo(OrderMaster::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
   
}
