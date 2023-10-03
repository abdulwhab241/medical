<?php

namespace App\Models;

use App\Models\User;
use App\Models\Salary;
use App\Models\Company;
use App\Models\Expense;
use App\Models\Patient;
use App\Models\PaymentAccount;
use App\Models\ReceiptAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Receipt()
    {
        return $this->belongsTo(ReceiptAccount::class,'receipt_id');
    }

    public function Salary()
    {
        return $this->belongsTo(Salary::class,'salary_id');
    }

    public function Expense()
    {
        return $this->belongsTo(Expense::class,'expense_id');
    }

    public function Company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function Payment()
    {
        return $this->belongsTo(PaymentAccount::class,'payment_id');
    }
}
