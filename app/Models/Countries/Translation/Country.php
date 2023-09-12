<?php

namespace App\Models\Countries\Translation;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries_translations";
    protected $fillable = ['name'];
    protected $guarded = ['country_id'];
    public $timestamps = false;
}
