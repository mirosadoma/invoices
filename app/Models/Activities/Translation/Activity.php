<?php

namespace App\Models\Activities\Translation;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activities_translations";
    protected $fillable = ['name'];
    protected $guarded = ['activity_id'];
    public $timestamps = false;
}
