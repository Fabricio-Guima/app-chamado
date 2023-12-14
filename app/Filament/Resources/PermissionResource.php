<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers;
use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $modelLabel = 'Permissão';
    protected static ?string $pluralModelLabel = 'Permissões';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->label('cargo')
                    ->multiple()
                    ->relationship('roles', 'name', fn(Builder $query) => 
                        auth()->user()->hasRole('admin') 
                        ? null 
                        : $query->where('name', '!=' ,'admin'))
                    ->preload()
                // Forms\Components\TextInput::make('guard_name')
                //     ->required()
                //     ->maxLength(255),
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
            'index' => Pages\ManagePermissions::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('admin')
        ? 
        parent::getEloquentQuery()
        :
        parent::getEloquentQuery()->where('name', '!=', 'admin.access');

    }
    
}
