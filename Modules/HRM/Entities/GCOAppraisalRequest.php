<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequest extends Model
{
    protected $table = 'gco_appraisal_requests';

    protected $fillable = [
        'employee_officer_id',
        'medical_report_photo',
        'reporting_date_start',
        'reporting_date_end',
        'requester_id',
        'receiver_id',
        'is_submitted',
        'is_submitted_personal_Info',
        'is_save_personal_Info',
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
        return $this->hasMany(GCOAppraisalRequestJobHistory::class, 'appraisal_request_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(GCOAppraisalRequestHistory::class, 'request_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(GCOAppraisalRequestEvaluation::class, 'appraisal_request_id', 'id');

    }

    public function GCOAppraisalPersonalInfoRequest()
    {
        return $this->hasOne(GCOAppraisalPersonalRequest::class, 'gco_appraisal_request_id', 'id');
    }

    public function summarizedEvaluation()
    {
        return $this->hasOne(GCOAppraisalRequestSummarizedEvaluation::class, 'appraisal_request_id', 'id');
    }

    public function action()
    {
        return $this->hasOne(GCOAppraisalRequestAction::class, 'appraisal_request_id', 'id');
    }

    public function approval()
    {
        return $this->hasOne(GCOAppraisalRequestApproval::class, 'appraisal_request_id', 'id');
    }
}

