<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    
    protected function handleRecordCreation(array $data): Model
    {
        $data["client_id"] = "DPW/client/".generateId();
        return static::getModel()::create($data);
    }
}
