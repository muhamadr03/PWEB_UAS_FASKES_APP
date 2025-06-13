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
}
