<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $modelLabel = 'Cargo';
    protected static ?string $pluralModelLabel = 'Cargos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('nome')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('guard_name')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\Select::make('permissions')
                    ->label('permissões')
                    ->multiple()
                    ->relationship('permissions', 'name')
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
                // Tables\Columns\TextColumn::make('guard_name')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('criado em')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('atualizado em')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(!auth()->user()->hasRole('admin'))->disabled(!auth()->user()->hasRole('admin')),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRoles::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('admin')
        ? 
        parent::getEloquentQuery()
        :
        parent::getEloquentQuery()->where('name', '!=', 'admin');

    }
}
