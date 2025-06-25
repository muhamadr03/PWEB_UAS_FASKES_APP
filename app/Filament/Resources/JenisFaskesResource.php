<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisFaskesResource\Pages;
use App\Models\JenisFaskes;
use App\Models\User; // Pastikan ini diimpor
use Illuminate\Database\Eloquent\Model; // Pastikan ini diimpor
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;

class JenisFaskesResource extends Resource
{
    protected static ?string $model = JenisFaskes::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Data Master Faskes';
    protected static ?string $pluralModelLabel = 'Jenis Fasilitas Kesehatan';
    protected static ?string $modelLabel = 'Jenis Fasilitas Kesehatan';

    // --- Otorisasi untuk JenisFaskesResource ---
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
                    ->placeholder('Contoh: Rumah Sakit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListJenisFaskes::route('/'),
            'create' => Pages\CreateJenisFaskes::route('/create'),
            'edit' => Pages\EditJenisFaskes::route('/{record}/edit'),
        ];
    }
}