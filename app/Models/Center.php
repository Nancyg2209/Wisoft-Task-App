<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_name',
        'center_location',
        'center_postcode',
        'opening_date',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}