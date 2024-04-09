<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'customerID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'customerID',
        'firstName',
        'lastName',
        'userID'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function Order()
    {
        return $this->hasMany(Order::class);
    }

    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function Evaluate()
    {
        return $this->hasMany(Evaluate::class);
    }
}
