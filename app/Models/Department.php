<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Doctor()
    {
        return $this->hasMany(Doctor::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
