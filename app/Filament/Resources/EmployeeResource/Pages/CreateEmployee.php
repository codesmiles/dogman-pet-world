<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\EmployeeResource;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // array_map(function ($data) {
        //     $data["attachments"] = Storage::disk('cloudinary')->url($data["attachments"]);
        //     return $data;
        // }, $data);
        // Storage::disk('cloudinary')->url($attachment);
        dd($data);
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
