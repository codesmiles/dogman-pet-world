<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Filament\Resources\EmployeeResource\RelationManagers\PetActivityScheduleRelationManager;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user', "client_id")->searchable()->preload()->required()->label("Client Id")->disabled(fn($record) => $record !== null)->getOptionLabelFromRecordUsing(function (User $record) {
                    return "{$record->name} ({$record->client_id})";
                }),
                Forms\Components\FileUpload::make('resume')->directory('assets/employee/resumes')->uploadingMessage('Uploading attachment...')->acceptedFileTypes(['application/pdf'])->maxSize(1024),
                Forms\Components\Select::make("status")->options(['active' => 'Active','inactive' => 'Inactive'])->default("active")->label("Status"),
                Forms\Components\TextInput::make("employee_id")->default("DPW/employee/" . generateId())->readOnly(),
                Forms\Components\DateTimePicker::make('employment_date')->format('Y-m-d H:i')->default(now())->label("Employment Date")->disabled(fn($record) => $record !== null),
                Forms\Components\Toggle::make('is_admin')->default(false)->label("Is an admin?"),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_id'),
                Tables\Columns\TextColumn::make('employment_date'),
                Tables\Columns\IconColumn::make('is_admin')->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PetActivityScheduleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
