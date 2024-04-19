<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Pos;
use App\Models\User_pos;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,
     HasFactory,HasRoles,
      Notifiable;
    use SoftDeletes;
    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    protected static $logName = 'user';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}");
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pos()
    {
        return $this->belongsToMany(Pos::class)->withPivot('is_default');;
    }
    public function pivotPos()
    {
        return $this->belongsTo(User_pos::class);
    }
}
