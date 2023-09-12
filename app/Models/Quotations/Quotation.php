<?php

namespace App\Models\Quotations;

use Illuminate\Database\Eloquent\Model;
use App\Models\Projects\Project;
use App\Models\User;

class Quotation extends Model {

    protected $table = "quotations";
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

    public function quotation_activities()
    {
        return $this->hasMany(QuotationActivities::class, 'quotation_id');
    }
}
