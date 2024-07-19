<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "is_admin",
        "employee_id",
        "employment_date",

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet_activity_schedules(){
        return $this->hasMany(pet_activity_schedule::class);
    }
}
