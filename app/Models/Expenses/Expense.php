<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    protected $table = "expenses";
    protected $guarded = ['id'];

    public function getFilePathAttribute()
    {
        return ($this->file) ? url($this->file) : '#';
    }
}
