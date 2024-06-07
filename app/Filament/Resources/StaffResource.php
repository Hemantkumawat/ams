<?php

namespace App\Filament\Resources;

use App\Enums\StaffDesignation;
use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Filament\Infolists\Components\{TextEntry, ImageEntry};
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->required(),
                Forms\Components\TextInput::make('last_name'),
                Forms\Components\Select::make('designation')->options(StaffDesignation::toSelectArray())->required(),
                Forms\Components\TextInput::make('contact_number')->required()->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),

                Forms\Components\TextInput::make('email')->unique()->required(),
                Forms\Components\Textarea::make('address'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('designation'),
                Tables\Columns\TextColumn::make('contact_number'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('first_name')->label('First Name'),
                TextEntry::make('last_name')->label('Last Name'),
                TextEntry::make('designation')
                    ->formatStateUsing(fn(Staff $staff) => $staff->designation)
                    ->label('Designation'),
                TextEntry::make('contact_number')->label('Contact Number'),
                TextEntry::make('email')->label('Email'),
                TextEntry::make('address')->label('Address'),
                ImageEntry::make('qrCode.qr_code')
                    ->label('QR Code')
                    // ->visibility('public')
                    /*->url(function (Staff $staff) {
                        return Storage::url($staff->qrCode->qr_code);
                    })*/,
            ])->columns(3);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
