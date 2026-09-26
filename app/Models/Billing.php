<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'billing_date'      => 'date',
        'consultation_fee'  => 'decimal:2',
        'medicine_charges'  => 'decimal:2',
        'other_charges'     => 'decimal:2',
        'discount'          => 'decimal:2',
        'total_amount'      => 'decimal:2',
        'paid_amount'       => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * Outstanding balance still owed on this invoice.
     */
    public function getBalanceAttribute()
    {
        return $this->total_amount - $this->paid_amount;
    }
}
