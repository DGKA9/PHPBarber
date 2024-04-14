<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ServiceEmployee extends Model
{
    use HasFactory;

    protected $table = 'service_employees';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'serviceID',
        'employeeID'
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
