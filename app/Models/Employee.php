<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $keyType = 'string';
    public $incrementing = false;

    public static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
    protected $fillable = [
        "resume",
        "status",
        "user_id",
        "is_admin",
        "employee_id",
        "employment_date",

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function PetActivitySchedules()
    {
        return $this->hasMany(PetActivitySchedule::class);
    }
}
