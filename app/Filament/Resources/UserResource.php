<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Usuário';
    protected static ?string $pluralModelLabel = 'Usuários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->label('senha')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->label('cargo')
                    ->multiple()
                    ->relationship('roles', 'name', fn(Builder $query) => 
                        auth()->user()->hasRole('admin') 
                        ? null 
                        : $query->where('name', '!=' ,'admin')
                    )
                    ->preload()
            ]);
                   
                
    }

    public static function table(Table $table): Table
    {       
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Cargo')
                    ->searchable(),                                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('criado em')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(!auth()->user()->hasRole('admin'))->disabled(!auth()->user()->hasRole('admin')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('admin')
        ? 
        parent::getEloquentQuery()
        :
        parent::getEloquentQuery()->whereHas('roles', fn(Builder $query) => $query->where('name', '!=', 'admin'));
    }   
    
}
