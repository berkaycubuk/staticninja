<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LemonSqueezyOrderResource\Pages;
use App\Filament\Resources\LemonSqueezyOrderResource\RelationManagers;
use App\Models\LemonSqueezyOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LemonSqueezy\Laravel\Order;

class LemonSqueezyOrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('billable_type'),
                Tables\Columns\TextColumn::make('billable_id'),
                Tables\Columns\TextColumn::make('lemon_squeezy_id'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
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
            'index' => Pages\ListLemonSqueezyOrders::route('/'),
            'create' => Pages\CreateLemonSqueezyOrder::route('/create'),
            'edit' => Pages\EditLemonSqueezyOrder::route('/{record}/edit'),
        ];
    }
}
