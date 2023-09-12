<?php

namespace App\Models\Countries;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Country extends Model {

    use Translatable;
    protected $table = "countries";
    protected $translationForeignKey = "country_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Countries\Translation\Country';
    protected $guarded = ['id'];

    public function clients()
    {
        return $this->hasMany(User::class, 'country_id');
    }
}
