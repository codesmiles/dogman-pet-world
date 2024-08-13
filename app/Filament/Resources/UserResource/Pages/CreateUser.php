<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Services\FileService;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
