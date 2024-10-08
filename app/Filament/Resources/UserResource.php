<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Enums\Mocks;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\PetRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\EmployeeRelationManager;

class UserResource extends Resource
{
    protected static ?string $label = "Client";
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\FileUpload::make('profile_picture')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->circleCropper()
                    ->disk("cloudinary")
                    ->directory("assets/user/images/profile_pictures")
                    ->imageResizeMode('cover')
                    ->imageEditorEmptyFillColor('#ff0000')
                    ->uploadingMessage('Uploading Profile picture...')
                    ->acceptedFileTypes(['image/jpeg', 'image/png',])
                    ->required(false)
                    // ->default(fn($record)=> $record->profile_picture ?? null)
                    // ->getStateUsing(fn($record) => $record->profile_picture)
                    ->maxSize(2048),
                // ->preserveFilenames()
                // ->storeFileNamesIn('attachment_file_names')
                // ->imageEditorViewportWidth('1920')
                // ->imageEditorViewportHeight('1080')
                // ->imageEditorAspectRatios(['16:9','4:3','1:1',]),
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->placeholder("Input Name"),
                Forms\Components\TextInput::make('client_id')->required(fn($record) => isset ($record->client_id) ? true : false)->maxLength(20)->default("DPW/client/" . generateId())->readOnly(),
                Forms\Components\TextInput::make('email')->email()->required()->placeholder("Input Email Address")->disabled(fn($record) => isset ($record->email) ? true : false),
                Forms\Components\TextInput::make('address')->nullable()->maxLength(255)->placeholder("Input Address"),
                Forms\Components\TextInput::make('password')->required(fn ($record) => !isset($record->password) ? true : false)->minLength(8)->password()->rules(['regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/'])->default(Mocks::DEFAULT_PASSWORD->value),
                Forms\Components\TextInput::make('phone_number')->required(fn($record) => !isset ($record->phone_number) ? true : false)->tel()->label('Phone Number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture')->size(120)->url(fn($record) => $record->profile_picture),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('client_id'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('phone_number'),
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
            PetRelationManager::class,
            EmployeeRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),

        ];
    }
}

