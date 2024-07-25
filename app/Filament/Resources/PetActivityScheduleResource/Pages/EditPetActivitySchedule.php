<?php

namespace App\Filament\Resources\PetActivityScheduleResource\Pages;

use App\Filament\Resources\PetActivityScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPetActivitySchedule extends EditRecord
{
    protected static string $resource = PetActivityScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
