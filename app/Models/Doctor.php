<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }
}
