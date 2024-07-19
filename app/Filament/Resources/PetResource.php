<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Pet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('file_number')->maxLength(255)->placeholder("Input File Number")->label("File Number")->default("file_" . generateId())->disabled(),
                Forms\Components\Select::make("user_id")->relationship("user","client_id")->label("Owner ID")->searchable(),
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->placeholder("Input Name")->label("Pet Name"),
                Forms\Components\Select::make('genus')->options(["canine", "feline", "caprine", "ovine", "equine", "bovine", "pisces", "oryctolagus"])->searchable()->required()->label("Pet Genus Name"),
                Forms\Components\TextInput::make('breed')->required()->maxLength(255)->placeholder("Input Your Pet Breed")->label("Breed and/or Species"),
                Forms\Components\Select::make('gender')->options(["male", "female", "harmaphrodite"])->required()->label("Pet Gender"),
                Forms\Components\Select::make('status')->options(["alive", "dead", "neutered"])->required()->label("Pet Status")->default('alive'),
                Forms\Components\TextInput::make('weight')->maxLength(255)->placeholder("Input Pet Weight")->label("Pet Weight"),
                Forms\Components\Select::make('retainership_plan')->options(["bronze", "silver","gold", "custom","none"])->required()->label("Retainership Plan")->default('none'),
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
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }
}
