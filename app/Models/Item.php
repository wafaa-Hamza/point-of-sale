<?php

namespace App\Models;

use App\Models\Pos;
use App\Models\Service;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, LogsActivity;


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Pos has been {$eventName}");
    }

    public function service()
    {
        return $this->belongsToMany(Service::class,'pivote_service_items');
    }
    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
    public function category()
    {
        return $this->belongsTo(ItemCategory::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(ItemSubCategory::class);
    }

    
    public function tax()
    {
        return $this->belongsToMany(Tax::class)->withPivot('inc');
    }


}