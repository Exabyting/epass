<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalRequestJobHistory extends Model
{
    protected $fillable = ['appraisal_request_id', 'designation', 'duration', 'salary_scale'];

    public function appraisalRequest()
    {
        return $this->belongsTo(AppraisalRequest::class, 'appraisal_request_id', 'id');
    }
}
