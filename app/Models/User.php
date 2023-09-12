<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Str;
use App\Models\Countries\Country;
use App\Models\Projects\Project;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
    protected $table = "users";
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    Protected $guard_name ='admin';
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    public function getImagePathAttribute()
    {
        return $this->image ? url($this->image) : url('assets/user.jpeg');
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
        }
        return $full_phone;
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }
}
