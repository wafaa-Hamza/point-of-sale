<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pivote_Tax_Item extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}");
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
    
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}