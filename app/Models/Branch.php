<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';
    protected $primaryKey = 'branchID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'branchID',
        'branchName',
        'branchAddress',
        'branchPhone',
        'workingHoursID'
    ];

    public function workingHours()
    {
        return $this->belongsTo(Working_Hours::class, 'workingHoursID', 'workingHoursID');
    }

    public function Employee()
    {
        return $this->hasMany(Employee::class, 'employeeID', 'employeeID');
    }
}
