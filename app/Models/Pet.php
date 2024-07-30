<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "breed",
        "photo",
        "genus",
        "weight",
        "gender",
        "status",
        "species",
        "user_id",
        "file_number",
        "date_of_birth",
        "microchip_number",
        "date_of_adoption",
        "retainership_plan",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pet_activity_schedules(){
        return $this->hasMany(pet_activity_schedule::class);
    }
}
