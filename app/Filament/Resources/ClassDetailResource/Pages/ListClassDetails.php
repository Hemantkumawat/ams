<?php

namespace App\Filament\Resources\ClassDetailResource\Pages;

use App\Filament\Resources\ClassDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassDetails extends ListRecords
{
    protected static string $resource = ClassDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
