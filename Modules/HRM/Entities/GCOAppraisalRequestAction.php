<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequestAction extends Model
{
    protected $table = 'gco_appraisal_request_actions';

    protected $fillable = ['appraisal_request_id', 'actor_id', 'rating', 'comment','total_marks', 'action'];

    public function appraisalRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }
}
