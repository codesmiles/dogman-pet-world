<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetRelationManager extends RelationManager
{
    protected static string $relationship = 'Pet';

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('file_number')->maxLength(255)->placeholder("Input File Number")->label("File Number")->default("file_" . generateId())->disabled(),
                Forms\Components\Hidden::make("user_id")->label("Owner ID")->default($this->getOwnerRecord()->id)->disabled(fn($record)=>$record !== null),
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->placeholder("Input Name")->label("Pet Name"),
                Forms\Components\Select::make('genus')->options(["canine", "feline", "caprine", "ovine", "equine", "bovine", "pisces", "oryctolagus"])->searchable()->required()->label("Pet Genus Name"),
                Forms\Components\TextInput::make('breed')->required()->maxLength(255)->placeholder("Input Your Pet Breed")->label("Breed and/or Species"),
                Forms\Components\Select::make('gender')->options(["male", "female", "harmaphrodite"])->required()->label("Pet Gender"),
                Forms\Components\Select::make('status')->options(["alive", "dead", "neutered"])->required()->label("Pet Status")->default('alive'),
                Forms\Components\TextInput::make('weight')->maxLength(255)->placeholder("Input Pet Weight")->label("Pet Weight(KG)"),
                Forms\Components\Select::make('retainership_plan')
                    ->options([
                        'bronze' => 'Bronze',
                        'silver' => 'Silver',
                        'gold' => 'Gold',
                        'custom' => 'Custom',
                        'none' => 'None',
                    ])
                    ->required()
                    ->label('Retainership Plan')
                    ->live(),
                    Forms\Components\Textarea::make('custom_plan_details')
                    ->label('Custom Plan Details')
                    ->requiredIf('retainership_plan', "custom")
                    ->hidden(fn(Get $get): bool => $get('retainership_plan') !== "custom"),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('file_number'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('genus'),
                Tables\Columns\TextColumn::make('breed'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('retainership_plan'),
                Tables\Columns\TextColumn::make('custom_plan_details'),
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
