<?php

namespace App\Models;

use App\Models\Pos;
use App\Models\OrderMaster;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderPayment extends Model
{
    use HasFactory, LogsActivity;


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "OrderPayment has been {$eventName}");
    }
    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }

    public function OrderMaster()
    {
        return $this->belongsTo(OrderMaster::class);
    }
    public function paymentType()
    {
        return $this->belongsTo(paymentType::class);
    }
}
