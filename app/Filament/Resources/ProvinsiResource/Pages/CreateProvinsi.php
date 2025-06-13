<?php

namespace App\Filament\Resources\ProvinsiResource\Pages;

use App\Filament\Resources\ProvinsiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProvinsi extends CreateRecord
{
    protected static string $resource = ProvinsiResource::class;
    protected ?string $redirectUrl = null; // Default: null, akan mengarahkan ke halaman edit record yang baru dibuat
    protected function getRedirectUrl(): string
    {
        // Mengarahkan kembali ke halaman list (daftar) setelah create
        // Ini adalah perilaku yang paling umum diinginkan
        return $this->getResource()::getUrl('index');
    }
}
