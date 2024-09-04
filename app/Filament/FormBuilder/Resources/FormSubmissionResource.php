<?php

namespace App\Filament\FormBuilder\Resources;

use App\Filament\FormBuilder\Resources\FormSubmissionResource\Pages;
use App\Filament\FormBuilder\Resources\FormSubmissionResource\RelationManagers;
use App\Models\FormSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormSubmissionResource extends Resource
{
    public static string $parentResource = FormResource::class;

    protected static ?string $model = FormSubmission::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(1)
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Submitted at'),
                        Infolists\Components\TextEntry::make('ip_address'),
                        Infolists\Components\RepeatableEntry::make('fields')
                            ->schema([
                                Infolists\Components\Grid::make(2)
                                    ->schema([
                                        Infolists\Components\TextEntry::make('name'),
                                        Infolists\Components\TextEntry::make('value'),
                                     ]),
                            ]),
                    ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /*
                Tables\Columns\TextColumn::make('form.name')
                    ->label('Form'),
                Tables\Columns\IconColumn::make('is_spam')
                    ->boolean(),
                */
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->orderBy('id', 'DESC'))
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Reply with mail')
                    ->hidden(fn (FormSubmission $record): bool => $record->fields()->where('name', 'email')->first()->value == null)
                    ->url(fn (FormSubmission $record): string => 'mailto:' . $record->fields()->where('name', 'email')->first()->value),
                Tables\Actions\ViewAction::make()
                    ->url(fn (FormSubmission $record): string => '/form-builder/forms/' . $record->form_id . '/submissions/' . $record->id),
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
            'index' => Pages\ListFormSubmissions::route('/'),
            'create' => Pages\CreateFormSubmission::route('/create'),
            'view' => Pages\ViewFormSubmission::route('/{record}'),
            'edit' => Pages\EditFormSubmission::route('/{record}/edit'),
        ];
    }
}
