<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Str;

class SiteConfig extends Model {

    use Translatable;
    protected $table = "site_config";
    protected $translationForeignKey = "site_config_id";
    public $translatedAttributes = [
        'title','company_name','payment_methods'
    ];
    public $translationModel = 'App\Models\Settings\Translation\SiteConfig';
    protected $guarded = ['id'];

    public function getLogoPathAttribute()
    {
        return ($this->logo) ? url($this->logo) : url('assets/mark-rise-logo-02.png');
    }


    public function getFullPhoneAttribute()
    {
        $full_phone = $this->phone;
        if (Str::length($this->phone) == 9) {
            $full_phone = '+966'.$this->phone;
        }elseif (Str::length($this->phone) == 10) {
            $full_phone = '+966'.substr($this->phone, 1);
        }elseif (Str::length($this->phone) == 12) {
            $full_phone = $this->phone;
        }else{
            $full_phone = '+966'.$this->phone;
        }
        return $full_phone;
    }
}
