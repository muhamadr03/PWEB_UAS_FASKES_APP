<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User; // Pastikan ini diimpor
use Illuminate\Database\Eloquent\Model; // Pastikan ini diimpor
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor untuk auth()->user()

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; // Icon untuk menu user
    protected static ?string $navigationGroup = 'Manajemen Pengguna'; // Kelompokkan di sidebar
    protected static ?string $modelLabel = 'Pengguna'; // Label untuk user
    protected static ?string $pluralModelLabel = 'Pengguna'; // Label jamak


    // --- Otorisasi untuk UserResource ---
    // Semua metode ini akan memeriksa apakah user adalah SUPER ADMIN
    public static function canViewAny(): bool
    {
        // Hanya super_admin yang bisa melihat daftar user
        return auth()->user()->isSuperAdmin();
    }

    public static function canCreate(): bool
    {
        // Hanya super_admin yang bisa membuat user
        return auth()->user()->isSuperAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        // Hanya super_admin yang bisa mengedit user
        return auth()->user()->isSuperAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        // Hanya super_admin yang bisa menghapus user lain (tidak bisa menghapus dirinya sendiri)
        return auth()->user()->isSuperAdmin() && $record->id !== auth()->id();
    }

    public static function canDeleteAny(): bool
    {
        // Hanya super_admin yang bisa menghapus banyak user
        return auth()->user()->isSuperAdmin();
    }
    public static function canView(Model $record): bool
    {
        // Hanya super_admin yang bisa melihat detail user
        return auth()->user()->isSuperAdmin();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->options([
                        User::ROLE_SUPER_ADMIN => 'Super Admin',
                        User::ROLE_ADMIN => 'Admin',
                        User::ROLE_USER => 'User Biasa',
                    ])
                    ->required()
                    ->default(User::ROLE_USER),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->colors([
                        'success' => User::ROLE_SUPER_ADMIN, // Warna hijau untuk Super Admin
                        'primary' => User::ROLE_ADMIN, // Warna biru untuk Admin
                        'gray' => User::ROLE_USER, // Warna abu-abu untuk User Biasa
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        User::ROLE_SUPER_ADMIN => 'Super Admin',
                        User::ROLE_ADMIN => 'Admin',
                        User::ROLE_USER => 'User Biasa',
                    ])
                    ->label('Filter Role'),
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

    // --- BAGIAN getRelations() dan getPages() masih di sini ---
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
}