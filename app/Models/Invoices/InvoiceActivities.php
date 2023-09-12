<?php

namespace App\Models\Invoices;

use App\Models\Activities\Activity;
use Illuminate\Database\Eloquent\Model;

class InvoiceActivities extends Model {

    protected $table = "invoices_activities";
    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
