<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalRequest extends Model
{
    protected $fillable = [
        'job_name',
        'employee_officer_id',
//        'reporting_date_range',
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
        'is_submitted',
        'is_evaluated',
        'is_evaluation_submitted',
        'is_action_taken',
        'comment',
//        'status'
    ];

    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'receiver_id', 'id');
    }

    public function jobHistories()
    {
        return $this->hasMany(AppraisalRequestJobHistory::class, 'appraisal_request_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(AppraisalRequestHistory::class, 'request_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(AppraisalRequestEvaluation::class, 'appraisal_request_id', 'id');
    }

    public function summarizedEvaluation()
    {
        return $this->hasOne(AppraisalRequestSummarizedEvaluation::class, 'appraisal_request_id', 'id');
    }

    public function action()
    {
        return $this->hasOne(AppraisalRequestAction::class, 'appraisal_request_id', 'id');
    }

    public function approval()
    {
        return $this->hasOne(AppraisalRequestApproval::class, 'appraisal_request_id', 'id');
    }

}
