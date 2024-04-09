<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'bookingID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'bookingID',
        'appointmentDate',
        'startTime',
        'endTime',
        'note',
        'customerID',
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customerID');
    }

    public function Service()
    {
        return $this->belongsToMany(Service::class, 'booking_service')
            ->using(BookingService::class);
    }
}
