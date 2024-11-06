<?php

namespace App\Models\Settings\Translation;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    protected $table = "site_config_translations";
    protected $fillable = ['title','company_name','payment_methods'];
    protected $guarded = ['site_config_id'];
    public $timestamps = false;
}
