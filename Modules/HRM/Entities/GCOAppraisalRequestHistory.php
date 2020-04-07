<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequestHistory extends Model
{
    protected $table = 'gco_appraisal_request_histories';

    protected $fillable = ['transition', 'from', 'to', 'actor_id', 'recipient_id', 'request_id'];

    public function request()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'request_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(Employee::class, 'recipient_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }
}
