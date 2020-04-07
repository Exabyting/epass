<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class NGAppraisalRequestJobHistory extends Model
{
    protected $table = 'ng_appraisal_request_job_histories';

    protected $fillable = ['appraisal_request_id', 'designation', 'duration', 'salary_scale'];

    public function AppraisalRequest()
    {
        return $this->belongsTo(NGAppraisalRequest::class, 'appraisal_request_id', 'id');
    }
}
