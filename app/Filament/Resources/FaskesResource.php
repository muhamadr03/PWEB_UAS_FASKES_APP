<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaskesResource\Pages;
use App\Models\Faskes;
use App\Models\Kabkota;
use App\Models\JenisFaskes;
use App\Models\Kategori;
use App\Models\User; // Pastikan ini diimpor untuk otorisasi
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;


class FaskesResource extends Resource
{
    protected static ?string $model = Faskes::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $modelLabel = 'Fasilitas Kesehatan';
    protected static ?string $pluralModelLabel = 'Fasilitas Kesehatan';
    protected static ?string $navigationGroup = 'Manajemen Faskes';


    // --- Otorisasi untuk FaskesResource ---
    // Semua metode ini akan memeriksa apakah user adalah ADMIN ATAU SUPER_ADMIN
    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(); // Izinkan Admin ATAU Super Admin
    }

    public static function canCreate(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(); // Izinkan Admin ATAU Super Admin
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(); // Izinkan Admin ATAU Super Admin
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(); // Izinkan Admin ATAU Super Admin
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(); // Izinkan Admin ATAU Super Admin
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isSuperAdmin(); // Izinkan Admin ATAU Super Admin
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('Contoh: RSUD Arifin Achmad'),
                TextInput::make('nama_pengelola')
                    ->maxLength(45)
                    ->nullable()
                    ->placeholder('Contoh: Dinas Kesehatan'),
                Textarea::make('alamat')
                    ->required()
                    ->maxLength(100)
                    ->rows(3)
                    ->placeholder('Contoh: Jl. Diponegoro No. 123'),
                TextInput::make('website')
                    ->maxLength(45)
                    ->url()
                    ->nullable()
                    ->label('Website (URL)')
                    ->placeholder('Contoh: https://www.rsud-arifinachmad.go.id'),
                TextInput::make('email')
                    ->maxLength(45)
                    ->email()
                    ->nullable()
                    ->placeholder('Contoh: info@rsud-arifinachmad.go.id'),
                TextInput::make('rating')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(5)
                    ->nullable()
                    ->placeholder('0-5'),
                TextInput::make('latitude')
                    ->numeric()
                    ->nullable()
                    ->rules(['regex:/^(\-?\d+(\.\d+)?)$/'])
                    ->step(0.000001)
                    ->placeholder('Contoh: -0.5070'),
                TextInput::make('longitude')
                    ->numeric()
                    ->nullable()
                    ->rules(['regex:/^(\-?\d+(\.\d+)?)$/'])
                    ->step(0.000001)
                    ->placeholder('Contoh: 101.4477'),

                Select::make('kabkota_id')
                    ->label('Kabupaten/Kota')
                    ->options(Kabkota::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false),
                Select::make('jenis_faskes_id')
                    ->label('Jenis Faskes')
                    ->options(JenisFaskes::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false),
                Select::make('kategori_id')
                    ->label('Kategori')
                    ->options(Kategori::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false),
                FileUpload::make('foto')
                    ->label('Foto Faskes')
                    ->image()
                    ->directory('faskes-photos')
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->size(50)
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jenisFaskes.nama')
                    ->label('Jenis Faskes')
                    ->sortable(),
                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('kabkota.nama')
                    ->label('Kab/Kota')
                    ->sortable(),
                TextColumn::make('alamat')
                    ->wrap()
                    ->limit(50),
                TextColumn::make('rating'),
                TextColumn::make('nama_pengelola')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('website')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('latitude')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('longitude')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('jenis_faskes_id')
                    ->label('Filter Jenis Faskes')
                    ->options(JenisFaskes::all()->pluck('nama', 'id')),
                SelectFilter::make('kategori_id')
                    ->label('Filter Kategori')
                    ->options(Kategori::all()->pluck('nama', 'id')),
                SelectFilter::make('kabkota_id')
                    ->label('Filter Kabupaten/Kota')
                    ->options(Kabkota::all()->pluck('nama', 'id')),
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
                'index' => Pages\ListFaskes::route('/'),
                'create' => Pages\CreateFaskes::route('/create'),
                'edit' => Pages\EditFaskes::route('/{record}/edit'),
            ];
        }
    }
