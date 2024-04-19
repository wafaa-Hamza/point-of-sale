<?php

namespace App\Models;

use App\Models\PaymentType;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMode extends Model
{
    use HasFactory;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "PaymentMode has been {$eventName}");
    }

    public function paymentTypes()
    {
        return $this->hasMany(PaymentType::class, 'payment_mode_id', 'id');
    }
}
