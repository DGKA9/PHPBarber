<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_Hours extends Model
{
    use HasFactory;

    protected $table = 'working__hours';
    protected $primaryKey = 'workingHoursID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'workingHoursID',
        'startTime',
        'endTime'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'branchID', 'branchID');
    }
}
