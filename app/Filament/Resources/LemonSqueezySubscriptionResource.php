<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LemonSqueezySubscriptionResource\Pages;
use App\Filament\Resources\LemonSqueezySubscriptionResource\RelationManagers;
use App\Models\LemonSqueezySubscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LemonSqueezy\Laravel\Subscription;

class LemonSqueezySubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

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
                Tables\Columns\TextColumn::make('variant_id'),
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
            'index' => Pages\ListLemonSqueezySubscriptions::route('/'),
            'create' => Pages\CreateLemonSqueezySubscription::route('/create'),
            'edit' => Pages\EditLemonSqueezySubscription::route('/{record}/edit'),
        ];
    }
}
