<?php

namespace App\Models;

use App\Models\User;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pos extends Model
{

    use HasFactory, LogsActivity;


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Pos has been {$eventName}");
    }


    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function tax()
    {
        return $this->belongsToMany(Tax::class)->withPivot('inc');
    }
    // public function item()
    // {
    //     return $this->belongsToMany(Item::class);
    // }
    
}