<?php

namespace App\Filament\Resources\ClassDetailResource\Pages;

use App\Filament\Resources\ClassDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassDetail extends EditRecord
{
    protected static string $resource = ClassDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
