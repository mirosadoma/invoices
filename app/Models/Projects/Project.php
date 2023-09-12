<?php

namespace App\Models\Projects;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $table = "projects";
    protected $guarded = ['id'];

    public function getLogoPathAttribute()
    {
        return ($this->logo) ? url($this->logo) : url('assets/mark-rise-logo-02.png');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
