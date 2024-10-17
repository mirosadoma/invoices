<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Model;
use App\Models\Projects\Project;
use App\Models\User;

class Invoice extends Model {

    protected $table = "invoices";
    protected $guarded = ['id'];

    public function getSignaturePathAttribute()
    {
        return ($this->signature) ? url($this->signature) : url('assets/mark-rise-logo-02.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function invoice_activities()
    {
        return $this->hasMany(InvoiceActivities::class, 'invoice_id');
    }

    // public function getInvoiceMonthAttribute()
    // {
    //     return $this->created_at->month;
    // }
}
