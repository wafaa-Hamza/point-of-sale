<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralSetup extends Model
{
    use HasFactory;
    use LogsActivity;




    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "GeneralSetup has been {$eventName}");
    }
    public function POS()
    {
        return $this->belongsTo(Pos::class);
    }
}
