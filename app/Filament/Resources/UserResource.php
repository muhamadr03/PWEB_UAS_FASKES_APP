<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $modelLabel = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna';


    // --- Otorisasi untuk UserResource (HANYA SUPER_ADMIN) ---
    public static function canViewAny(): bool
    {
        return auth()->user()->isSuperAdmin(); // HANYA SUPER_ADMIN
    }

    public static function canCreate(): bool
    {
        return auth()->user()->isSuperAdmin(); // HANYA SUPER_ADMIN
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->isSuperAdmin(); // HANYA SUPER_ADMIN
    }

    public static function canDelete(Model $record): bool
    {
        // Super_admin bisa menghapus user lain, tapi tidak boleh menghapus dirinya sendiri
        return auth()->user()->isSuperAdmin() && $record->id !== auth()->id(); // HANYA SUPER_ADMIN, dan bukan diri sendiri
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->isSuperAdmin(); // HANYA SUPER_ADMIN
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->isSuperAdmin(); // HANYA SUPER_ADMIN
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
                        'success' => User::ROLE_SUPER_ADMIN,
                        'primary' => User::ROLE_ADMIN,
                        'gray' => User::ROLE_USER,
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
