<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{

    protected $fillable = [
        'guid',
        'input',
        'output',
        'state',
        'correction'
    ];

    public function scopeCorrected($query) {
        return $query->where('state', 'success');
    }

}
