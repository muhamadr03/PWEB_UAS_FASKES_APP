<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KabkotaResource\Pages;
use App\Models\Kabkota;
use App\Models\Provinsi; // Penting: Impor model Provinsi
use App\Models\User; // Pastikan ini diimpor
use Illuminate\Database\Eloquent\Model; // Pastikan ini diimpor
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class KabkotaResource extends Resource
{
    protected static ?string $model = Kabkota::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Data Master Lokasi';
    protected static ?string $pluralModelLabel = 'Kabupaten/Kota';
    protected static ?string $modelLabel = 'Kabupaten/Kota';

    // --- Otorisasi untuk KabkotaResource ---
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
                Select::make('provinsi_id')
                    ->label('Provinsi')
                    ->options(Provinsi::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false),
                TextInput::make('nama')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Contoh: Bandung Kota'),
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
                TextColumn::make('provinsi.nama')
                    ->label('Provinsi')
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
                SelectFilter::make('provinsi_id')
                    ->label('Filter per Provinsi')
                    ->options(Provinsi::all()->pluck('nama', 'id'))
                    ->native(false),
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
            'index' => Pages\ListKabkotas::route('/'),
            'create' => Pages\CreateKabkota::route('/create'),
            'edit' => Pages\EditKabkota::route('/{record}/edit'),
        ];
    }
}