<?php

namespace App\Models;

use App\Models\Pos;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $guarded = ['id'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Service has been {$eventName}");
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
    
    public function item()
    {
        return $this->belongsToMany(Item::class)->withPivot('inc');
    }  
}