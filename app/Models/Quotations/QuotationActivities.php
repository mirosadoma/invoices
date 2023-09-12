<?php

namespace App\Models\Quotations;

use App\Models\Activities\Activity;
use Illuminate\Database\Eloquent\Model;

class QuotationActivities extends Model {

    protected $table = "quotations_activities";
    protected $guarded = ['id'];

    public function quotation()
    {
        return $this->belongsTo(Quotations::class, 'quotation_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
