<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data["profile_picture"] = Storage::disk('cloudinary')->url($data["profile_picture"]);
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
