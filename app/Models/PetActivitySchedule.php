<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetActivitySchedule extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'pet_activity_schedules';

    public static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
    protected $fillable = [
        "report",
        "pet_id",
        "employee_id",
        "next_visit_date",
        "treatment_or_vaccinations",
    ];

    public function pet(){
        return $this->belongsTo(Pet::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
