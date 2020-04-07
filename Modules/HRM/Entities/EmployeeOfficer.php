<?php


namespace Modules\HRM\Entities;


use Illuminate\Database\Eloquent\Model;

class EmployeeOfficer extends Model
{
    protected $fillable = [
        'employee_id',
        'iro_id',
        'cro_id',
        'is_complete',
        'start_date',
        'end_date',
    ];

    public function iroOfficer(){
        return $this->belongsTo(Employee::class, 'iro_id', 'id');
    }

    public function croOfficer(){
        return $this->belongsTo(Employee::class, 'cro_id', 'id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
