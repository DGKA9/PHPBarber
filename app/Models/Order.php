<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'orderID',
        'orderDate',
        'deliveryDate',
        'orderStatus',
        'totalInvoice',
        'customerID',
        'paymentID'
    ];

    public function Cutomer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customerID');
    }

    public  function Payment()
    {
        return $this->belongsTo(Payment::class, 'paymentID', 'paymentID');
    }

    public function Product()
    {
        return $this->belongsToMany(Product::class, 'detail__products')
            ->using(Detail_Product::class);
    }
}
