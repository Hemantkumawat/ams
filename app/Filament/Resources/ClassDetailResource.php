<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassDetailResource\Pages;
use App\Filament\Resources\ClassDetailResource\RelationManagers;
use App\Models\ClassDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassDetailResource extends Resource
{
    protected static ?string $model = ClassDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'course_name')
                    ->required()->nullable(),
                Forms\Components\TextInput::make('class_name')
                    ->required(),
                Forms\Components\DateTimePicker::make('class_time'),
                Forms\Components\TextInput::make('location'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('class_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('class_time')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')

                    ->searchable()

                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassDetails::route('/'),
            'create' => Pages\CreateClassDetail::route('/create'),
            'edit' => Pages\EditClassDetail::route('/{record}/edit'),
        ];
    }
}
