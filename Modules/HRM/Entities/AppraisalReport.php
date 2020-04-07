<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalReport extends Model
{
    protected $fillable = [
        'job_name',
        'reporting_date_start',
        'reporting_date_end',
        'requester_id',
        'receiver_id',
        'educational_qualifications',
        'total_job_period',
        'birth_date',
        'languages',
        'special_training',
        'reporting_job_period',
        'job_history_designation',
        'job_history_duration',
        'job_history_salary_scale',
        'job_history_comment',
        'is_submitted'
    ];


    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'receiver_id', 'id');
    }
}
