<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class NGAppraisalRequest extends Model
{
    protected $table = 'ng_appraisal_requests';

    protected $fillable = [
        'employee_officer_id',
        'reporting_date_start',
        'reporting_date_end',
        'requester_id',
        'receiver_id',
        'educational_qualifications',
        'birth_date',
        'salary_scale',
        'current_post_joining_date',
        'joining_date_govt_job',
        'is_divisional_exam_passed',
        'divisional_exam_passed_date',
        'job_state',
        'languages',
        'special_training',
        'reporting_job_period',
        'is_submitted',
        'is_evaluated',
        'is_evaluation_submitted',
        'is_action_taken',
        'comment',

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
        return $this->hasMany(NGAppraisalRequestJobHistory::class, 'appraisal_request_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(NGAppraisalRequestHistory::class, 'request_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(NGAppraisalRequestEvaluation::class, 'appraisal_request_id', 'id');
    }

    public function summarizedEvaluation()
    {
        return $this->hasOne(NGAppraisalRequestSummarizedEvaluation::class, 'appraisal_request_id', 'id');
    }

    public function action()
    {
        return $this->hasOne(NGAppraisalRequestAction::class, 'appraisal_request_id', 'id');
    }

    public function approval()
    {
        return $this->hasOne(NGAppraisalRequestApproval::class, 'appraisal_request_id', 'id');
    }
}
