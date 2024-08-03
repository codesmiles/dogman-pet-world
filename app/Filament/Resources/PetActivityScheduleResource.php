<?php

namespace App\Filament\Resources;

use App\Models\Pet;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Models\PetActivitySchedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PetActivityScheduleResource\Pages;
use App\Filament\Resources\PetActivityScheduleResource\RelationManagers;

class PetActivityScheduleResource extends Resource
{
    protected static ?string $model = PetActivitySchedule::class;
    protected static ?string $label = "Pet Activity Schedule";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pet_id')
                    ->relationship(name: 'pet', titleAttribute: "name")
                    ->getOptionLabelFromRecordUsing(fn(Pet $record) => "{$record->name} ({$record->breed} | {$record->user->client_id})")
                    ->searchable()->preload()->required()->label("Pet")->disabled(fn($record) => $record !== null),
                Forms\Components\DateTimePicker::make('next_visit_date')->format('Y-m-d H:i')->default(now())->label("Next Visit Date"),
                Forms\Components\TextInput::make('treatment_or_vaccinations')->maxLength(255)->placeholder("Input Treatment or Vaccinations")->label("Treatment or Vaccinations")->required(),
                Forms\Components\RichEditor::make('report')->label('Reports')->placeholder("Input the following additional Information")
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pet_id'),
                Tables\Columns\TextColumn::make('next_visit_date'),
                Tables\Columns\TextColumn::make('treatment_or_vaccinations'),
                Tables\Columns\TextColumn::make('report'),
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
