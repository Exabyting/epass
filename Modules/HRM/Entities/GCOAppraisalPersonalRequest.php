<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalPersonalRequest extends Model
{
    protected $table = 'gco_appraisal_personal_requests';

    protected $fillable = [
        'employee_officer_id',
        'gco_appraisal_request_id',
        'name',
        'designation',
        'birth_date',
        'father_name',
        'marital_status',
        'number_of_children',
        'service_cadre_name',
        'govt_service_start_date',
        'gazetted_service_start_date',
        'cadre_service_start_date',
        'current_post_joining_date',
        'salary_scale',
        'current_salary_scale',
        'educational_qualifications',
        'training_country',
        'training_forign',
        'forign_skill_reading',
        'forign_skill_speaking',
        'forign_skill_writing',
        'comment_one',
        'comment_two',
        'comment_three',
        'comment_four',
        'comment_five',
        'office_name',
        'reporting_date_start',
        'reporting_date_end',
        'requester_id',
        'receiver_id',
        'is_submitted',
        'is_evaluated',
        'is_evaluation_submitted',
        'is_action_taken'

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
        return $this->hasMany(GCOAppraisalRequestHistory::class, 'request_id', 'id');
    }

    public function evaluations()
    {
        return $this->hasMany(GCOAppraisalRequestHistory::class, 'appraisal_request_id', 'id');
    }

    public function summarizedEvaluation()
    {
        return $this->hasOne(GCOAppraisalRequestHistory::class, 'appraisal_request_id', 'id');
    }

    public function action()
    {
        return $this->hasOne(GCOAppraisalRequestHistory::class, 'appraisal_request_id', 'id');
    }

    public function approval()
    {
        return $this->hasOne(GCOAppraisalRequestHistory::class, 'appraisal_request_id', 'id');
    }

    public function appraisalRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'employee_officer_id', 'id');
    }
    public function GCOAppraisalPersonalInfoRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'gco_appraisal_request_id', 'id');
    }
}
