<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinsiResource\Pages;
use App\Models\Provinsi;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class; // Model yang terkait dengan resource ini
    protected static ?string $navigationIcon = 'heroicon-o-map'; // Ikon navigasi di sidebar Filament
    protected static ?string $navigationGroup = 'Data Master Lokasi'; // Grup navigasi
    protected static ?string $modelLabel = 'Provinsi'; // Label model di UI

    // Metode untuk mendefinisikan form saat membuat/mengedit data
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required() // Kolom wajib diisi
                    ->maxLength(45) // Batasan panjang karakter
                    ->unique(ignoreRecord: true) // Nama provinsi harus unik (saat edit, abaikan record saat ini)
                    ->placeholder('Contoh: Jawa Barat'), // Placeholder
                TextInput::make('ibukota')
                    ->required()
                    ->maxLength(45)
                    ->placeholder('Contoh: Bandung'),
                TextInput::make('latitude')
                    ->numeric() // Hanya menerima angka
                    ->required()
                    ->rules(['regex:/^(\-?\d+(\.\d+)?)$/']) // Regex untuk validasi format double (angka desimal, bisa negatif)
                    ->step(0.000001) // Akurasi langkah untuk input numerik
                    ->placeholder('Contoh: -6.9175'),
                TextInput::make('longitude')
                    ->numeric()
                    ->required()
                    ->rules(['regex:/^(\-?\d+(\.\d+)?)$/'])
                    ->step(0.000001)
                    ->placeholder('Contoh: 107.6191'),
            ]);
    }

    // Metode untuk mendefinisikan tabel saat menampilkan daftar data
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable() // Kolom dapat dicari
                    ->sortable(), // Kolom dapat diurutkan
                TextColumn::make('ibukota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('latitude'),
                TextColumn::make('longitude'),
                TextColumn::make('created_at') // Tampilkan timestamp pembuatan data
                    ->dateTime() // Format sebagai tanggal dan waktu
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Bisa disembunyikan/ditampilkan di tabel
                TextColumn::make('updated_at') // Tampilkan timestamp pembaruan data
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini jika dibutuhkan
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Aksi edit
                Tables\Actions\DeleteAction::make(), // Aksi delete
            ])
            ->bulkActions([ // Aksi untuk multiple records (misal: delete banyak)
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Metode untuk mendefinisikan relasi (jika ada relasi yang ingin ditampilkan di sini)
    public static function getRelations(): array
    {
        return [
            // Contoh: ProvinsiResource\RelationManagers\KabkotasRelationManager::class,
        ];
    }

    // Metode untuk mendefinisikan halaman-halaman yang terkait dengan resource ini
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}