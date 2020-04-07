<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequestJobHistory extends Model
{
    protected $table = 'gco_appraisal_request_job_histories';

    protected $fillable = ['appraisal_request_id', 'designation', 'duration', 'salary_scale'];

    public function AppraisalRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'appraisal_request_id', 'id');
    }
}
