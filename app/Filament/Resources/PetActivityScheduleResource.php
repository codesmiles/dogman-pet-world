<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetActivityScheduleResource\Pages;
use App\Filament\Resources\PetActivityScheduleResource\RelationManagers;
use App\Models\pet_activity_schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PetActivityScheduleResource extends Resource
{
    protected static ?string $model = pet_activity_schedule::class;
    protected static ?string $label = "Pet Activity Schedule";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('user_id')
                // ->relationship("user","client_id")
                // ->default(Auth::id()) // Set the default value to the currently logged-in user's ID
                // ->label('User')
                // ->disabled(),

                // next visit date
                // pet id
                // employee id
                // treatment or vaccinations
                // report
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPetActivitySchedules::route('/'),
            'create' => Pages\CreatePetActivitySchedule::route('/create'),
            'edit' => Pages\EditPetActivitySchedule::route('/{record}/edit'),
        ];
    }
}
