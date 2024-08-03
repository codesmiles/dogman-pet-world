<?php

namespace App\Filament\Resources\PetResource\RelationManagers;

use App\Models\Pet;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PetActivityScheduleRelationManager extends RelationManager
{
    protected static string $relationship = 'PetActivitySchedules';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('pet_id')
            ->columns([
                Tables\Columns\TextColumn::make('employee_id')->label("Employee ID")->formatStateUsing(fn($record) => "{$record->employee->employee_id}"),
                Tables\Columns\TextColumn::make('next_visit_date'),
                Tables\Columns\TextColumn::make('treatment_or_vaccinations'),
                Tables\Columns\TextColumn::make('report'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
