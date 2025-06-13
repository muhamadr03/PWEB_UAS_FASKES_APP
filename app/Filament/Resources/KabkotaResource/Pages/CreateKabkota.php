<?php

namespace App\Filament\Resources\KabkotaResource\Pages;

use App\Filament\Resources\KabkotaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKabkota extends CreateRecord
{
    protected static string $resource = KabkotaResource::class;
    protected ?string $redirectUrl = null; // Default: null, akan mengarahkan ke halaman edit record yang baru dibuat
    protected function getRedirectUrl(): string
    {
        // Mengarahkan kembali ke halaman list (daftar) setelah create
        // Ini adalah perilaku yang paling umum diinginkan
        return $this->getResource()::getUrl('index');
    }
}
