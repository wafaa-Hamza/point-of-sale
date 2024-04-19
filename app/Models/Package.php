<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
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
        return $this->belongsToMany(Item::class,'package_items');
    }
    // public function scopItemCategory(Builder $query)
    // {
    // }
    // public function subCategory()
    // {
    //     return $this->belongsTo(ItemSubCategory::class);
    // }

    
    // public function tax()
    // {
    //     return $this->belongsToMany(Tax::class)->withPivot('inc');
    // }
}