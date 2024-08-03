<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory, HasUuids;


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
        "name",
        "breed",
        "photo",
        "genus",
        "weight",
        "gender",
        "status",
        "user_id",
        "file_number",
        "date_of_birth",
        "microchip_number",
        "date_of_adoption",
        "retainership_plan",
        "custom_plan_details"
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




