<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalRequestAction extends Model
{
    protected $fillable = ['appraisal_request_id', 'actor_id', 'rating', 'comment', 'action'];

    public function appraisalRequest()
    {
        return $this->belongsTo(AppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }
}
