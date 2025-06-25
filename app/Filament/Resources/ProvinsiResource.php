<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinsiResource\Pages;
use App\Models\Provinsi;
use App\Models\User; // Pastikan ini diimpor
use Illuminate\Database\Eloquent\Model; // Pastikan ini diimpor
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Data Master Lokasi';
    protected static ?string $pluralModelLabel = 'Provinsi';
    protected static ?string $modelLabel = 'Provinsi';

    // --- Otorisasi untuk ProvinsiResource ---
    // Semua metode ini akan memeriksa apakah user adalah ADMIN ATAU SUPER_ADMIN
    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public static function canCreate(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(45)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Contoh: Jawa Barat'),
                TextInput::make('ibukota')
                    ->required()
                    ->maxLength(45)
                    ->placeholder('Contoh: Bandung'),
                TextInput::make('latitude')
                    ->numeric()
                    ->required()
                    ->rules(['regex:/^(\-?\d+(\.\d+)?)$/'])
                    ->step(0.000001)
                    ->placeholder('Contoh: -6.9175'),
                TextInput::make('longitude')
                    ->numeric()
                    ->required()
                    ->rules(['regex:/^(\-?\d+(\.\d+)?)$/'])
                    ->step(0.000001)
                    ->placeholder('Contoh: 107.6191'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ibukota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('latitude'),
                TextColumn::make('longitude'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
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
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}