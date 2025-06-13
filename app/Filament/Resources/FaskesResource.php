<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaskesResource\Pages;
use App\Models\Faskes;
use App\Models\Kabkota; // Impor model terkait
use App\Models\JenisFaskes; // Impor model terkait
use App\Models\Kategori; // Impor model terkait
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea; // Untuk kolom alamat yang lebih besar
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class FaskesResource extends Resource
{
    protected static ?string $model = Faskes::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $modelLabel = 'Fasilitas Kesehatan';
    protected static ?string $navigationGroup = 'Manajemen Faskes'; // Grup navigasi terpisah

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
                Textarea::make('alamat') // Menggunakan Textarea untuk alamat
                    ->required()
                    ->maxLength(100)
                    ->rows(3) // Tinggi textarea 3 baris
                    ->placeholder('Contoh: Jl. Diponegoro No. 123'),
                TextInput::make('website')
                    ->maxLength(45)
                    ->url() // Validasi input harus URL
                    ->nullable()
                    ->label('Website (URL)')
                    ->placeholder('Contoh: https://www.rsud-arifinachmad.go.id'),
                TextInput::make('email')
                    ->maxLength(45)
                    ->email() // Validasi input harus email
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

                // Dropdown untuk Foreign Keys
                Select::make('kabkota_id')
                    ->label('Kabupaten/Kota')
                    ->options(Kabkota::all()->pluck('nama', 'id')) // Ambil data dari model Kabkota
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jenisFaskes.nama') // Menampilkan nama jenis faskes dari relasi
                    ->label('Jenis Faskes')
                    ->sortable(),
                TextColumn::make('kategori.nama') // Menampilkan nama kategori dari relasi
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('kabkota.nama') // Menampilkan nama kab/kota dari relasi
                    ->label('Kab/Kota')
                    ->sortable(),
                TextColumn::make('alamat')
                    ->wrap() // Bungkus teks jika terlalu panjang
                    ->limit(50), // Batasi tampilan 50 karakter
                TextColumn::make('rating'),
                TextColumn::make('nama_pengelola')
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyikan default
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
                SelectFilter::make('jenis_faskes_id') // Filter data tabel berdasarkan jenis faskes
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