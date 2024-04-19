<?php

namespace App\Models;

use App\Models\Pos;
use App\Models\Table;
use App\Models\Waiter;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMaster extends Model
{
    use HasFactory, LogsActivity;


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "OrderMaster has been {$eventName}");
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function waiter()
    {
        return $this->belongsTo(Waiter::class);
    }
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function canceBy()
    {
        return $this->belongsTo(User::class, 'cancel_by', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function finishedBy()
    {
        return $this->belongsTo(User::class, 'finish_by', 'id');
    }
    public function lastUpdatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by', 'id');
    }
}
