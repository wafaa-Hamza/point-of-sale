<?php

namespace App\Models;

use App\Models\Pos;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory;
    use  LogsActivity;


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Table has been {$eventName}");
    }
    public function POS()
    {
        return $this->hasOne(Pos::class, 'id', 'pos_id');
    }
}
