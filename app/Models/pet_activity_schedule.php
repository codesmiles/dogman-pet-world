<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pet_activity_schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        "next_visit_date",
        "pet_id",
        "employee_id",
        "treatment_or_vaccinations",
    ];

    public function pet(){
        return $this->belongsTo(Pet::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
