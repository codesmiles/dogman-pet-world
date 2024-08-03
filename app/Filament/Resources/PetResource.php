<?php

namespace App\Filament\Resources;

use App\Models\Pet;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PetResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Filament\Resources\PetResource\RelationManagers\PetActivityScheduleRelationManager;


class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $generate_file_number = "file_" . generateId();
        return $form
            ->schema([
                Forms\Components\TextInput::make('file_number')->maxLength(255)->placeholder("Input File Number")->label("File Number")->default($generate_file_number)->readOnly()->disabledOn('edit'),
                Forms\Components\Select::make("user_id")->relationship("user", "client_id")->label("Owner")->searchable()->getOptionLabelFromRecordUsing(function (User $record) {
                    return "{$record->name} ({$record->client_id})";
                })->required(),
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->placeholder("Input Name")->label("Pet Name"),
                Forms\Components\Select::make('genus')->options(["canine" =>"canine", "feline" =>"feline", "caprine" =>"caprine", "ovine" =>"ovine", "equine" =>"equine", "bovine" =>"bovine", "pisces" =>"pisces", "oryctolagus" =>"oryctolagus"])->searchable()->required()->label("Pet Genus Name"),
                Forms\Components\TextInput::make('breed')->required()->maxLength(255)->placeholder("Input Your Pet Breed")->label("Breed and/or Species"),
                Forms\Components\Select::make('gender')->options(["male" => "male", "female" => "female", "harmaphrodite" => "harmaphrodite"])->required()->label("Pet Gender"),
                Forms\Components\Select::make('status')->options(["alive" => "alive", "dead" => "dead", "neutered" => "neutered"])->required()->label("Pet Status")->default('alive'),
                Forms\Components\TextInput::make('weight')->numeric()->maxLength(255)->placeholder("Input Pet Weight")->label("Pet Weight(KG)"),
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
                Forms\Components\RichEditor::make('custom_plan_details')
                    ->toolbarButtons([
                        // 'attachFiles',
                        // 'codeBlock',
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
                    ->label('Custom Plan Details')
                    ->requiredIf('retainership_plan', "custom")
                    ->hidden(fn(Get $get): bool => $get('retainership_plan') !== "custom"),
                Forms\Components\DateTimePicker::make('date_of_birth')->format('Y-m-d')->label("Date of Birth"),
                Forms\Components\TextInput::make('microchip_number')->nullable()->maxLength(255)->placeholder("Input Microchip Number"),
                Forms\Components\DateTimePicker::make('date_of_adoption')->format('Y-m-d')->default(now())->label("Date of Adoption"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('file_number'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('genus'),
                Tables\Columns\TextColumn::make('breed'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('retainership_plan'),
                Tables\Columns\TextColumn::make('custom_plan_details'),
                Tables\Columns\TextColumn::make('date_of_birth'),
                Tables\Columns\TextColumn::make('microchip_number'),
                Tables\Columns\TextColumn::make('date_of_adoption'),
            ])
            ->filters([
                // Tables\Columns\TextColumn::make(''),
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
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }
}
