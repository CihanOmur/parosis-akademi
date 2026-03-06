<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class StudentPaymentsInstallment extends Model
{
    protected $fillable = [
        'student_id', 'student_payment_id', 'order',
        'payment_date', 'installment_price', 'payed_price',
        'payment_type', 'payyed_date', 'note',
    ];
}
