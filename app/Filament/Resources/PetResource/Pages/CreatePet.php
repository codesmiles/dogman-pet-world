<?php

namespace App\Filament\Resources\PetResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PetResource;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;

class CreatePet extends CreateRecord
{
    protected static string $resource = PetResource::class;

    // protected function handleRecordCreation(array $data): Model
    // {
    //     dd($data);
    //     return static::getModel()::create($data);
    // }
}
