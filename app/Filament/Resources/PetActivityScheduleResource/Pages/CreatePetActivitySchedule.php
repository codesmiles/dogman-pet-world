<?php

namespace App\Filament\Resources\PetActivityScheduleResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PetActivityScheduleResource;

class CreatePetActivitySchedule extends CreateRecord
{
    protected static string $resource = PetActivityScheduleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data["employee_id"] = auth()->user()->employee->id;
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
