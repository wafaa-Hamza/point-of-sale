<?php

namespace App\Models;

use App\Models\Pos;
use App\Models\Item;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
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
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
