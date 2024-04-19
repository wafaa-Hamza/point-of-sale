<?php

namespace App\Models;

use App\Models\Pos;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_pos extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }

}
