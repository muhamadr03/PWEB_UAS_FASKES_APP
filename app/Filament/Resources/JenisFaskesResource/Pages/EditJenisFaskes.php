<?php

namespace App\Filament\Resources\JenisFaskesResource\Pages;

use App\Filament\Resources\JenisFaskesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisFaskes extends EditRecord
{
    protected static string $resource = JenisFaskesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected ?string $redirectUrl = null; // Default: null, akan mengarahkan ke halaman edit record yang baru dibuat
    protected function getRedirectUrl(): string
    {
        // Mengarahkan kembali ke halaman list (daftar) setelah create
        // Ini adalah perilaku yang paling umum diinginkan
        return $this->getResource()::getUrl('index');
    }
}
