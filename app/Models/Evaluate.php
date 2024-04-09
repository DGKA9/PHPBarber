<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    use HasFactory;
    protected $table = 'evaluates';
    protected $primaryKey = 'evaluateID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'evaluateID',
        'rating',
        'comment',
        'lastUpdate',
        'productID',
        'customerID'
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class,'customerID', 'customerID');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }
}
