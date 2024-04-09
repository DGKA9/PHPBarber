<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'employeeID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'employeeID',
        'firstName',
        'lastName',
        'image',
        'workDay',
        'userID',
        'branchID'
    ];

    public function  User(){
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branchID', 'branchID');
    }
}
