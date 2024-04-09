<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'serviceID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'serviceID',
        'serviceName'.
        'description',
        'price',
        'serviceTime'
    ];

    public function Booking()
    {
        return $this->belongsToMany(Booking::class, 'booking_service')
            ->using(BookingService::class);
    }
}
