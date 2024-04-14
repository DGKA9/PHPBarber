<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class BranchBooking extends Model
{
    use HasFactory;

    protected $table = 'branch_bookings';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'bookingID',
        'branchID'
    ];

    public static function currentDate(): Carbon
    {
        return Carbon::now();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = static::currentDate();
            $model->updated_at = static::currentDate();
        });

        static::updating(function ($model) {
            $model->updated_at = static::currentDate();
        });
    }
}
