<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LemonSqueezyCustomerResource\Pages;
use App\Filament\Resources\LemonSqueezyCustomerResource\RelationManagers;
use App\Models\LemonSqueezyCustomer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LemonSqueezy\Laravel\Customer;

class LemonSqueezyCustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

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
            'index' => Pages\ListLemonSqueezyCustomers::route('/'),
            'create' => Pages\CreateLemonSqueezyCustomer::route('/create'),
            'edit' => Pages\EditLemonSqueezyCustomer::route('/{record}/edit'),
        ];
    }
}
