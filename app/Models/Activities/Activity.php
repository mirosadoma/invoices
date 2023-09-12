<?php

namespace App\Models\Activities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Activity extends Model {

    use Translatable;
    protected $table = "activities";
    protected $translationForeignKey = "activity_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Activities\Translation\Activity';
    protected $guarded = ['id'];
}
