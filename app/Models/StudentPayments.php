<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentPayments extends Model
{
    protected $guarded = [];
    /**
     * Get all of the installments for the StudentPayments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function installments(): HasMany
    {
        return $this->hasMany(StudentPaymentsInstallment::class, 'student_payment_id', 'id');
    }
}
