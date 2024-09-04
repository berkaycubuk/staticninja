<?php

namespace App\Filament\FormBuilder\Resources;

use App\Filament\FormBuilder\Resources\FormResource\Pages;
use App\Filament\FormBuilder\Resources\FormResource\RelationManagers;
use App\Filament\FormBuilder\Resources\FormSubmissionResource\Pages\ListFormSubmissions;
use App\Filament\FormBuilder\Resources\FormSubmissionResource\Pages\ViewFormSubmission;
use App\Infolists\Components\FormExampleCode;
use App\Infolists\Components\FormExampleTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;

class FormResource extends Resource
{
    protected static ?string $model = \App\Models\Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getRecordTitle(?Model $record): string|Htmlable|null
    {
        return $record->name;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Form Information')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('name'),
                                Infolists\Components\TextEntry::make('key')
                                    ->icon('heroicon-m-key')
                                    ->copyable()
                                    ->copyMessage('Copied!'),
                                Infolists\Components\TextEntry::make('is_active')
                                    ->label('Active')
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        '1' => 'Active',
                                        '0' => 'Not active',
                                    })
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        '1' => 'success',
                                        '0' => 'warning',
                                    }),
                                Infolists\Components\TextEntry::make('submission_count')
                                    ->label('Submissions (click to see them!)')
                                    ->formatStateUsing(fn (string $state): string => $state . ' submissions')
                                    ->url(fn (\App\Models\Form $record): string => '/form-builder/forms/' . $record->id . '/submissions'),
                                Infolists\Components\TextEntry::make('preferences.is_g_captcha_enabled')
                                    ->label('Google reCAPTCHA')
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        '1' => 'Enabled',
                                        '0' => 'Not enabled',
                                    })
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        '1' => 'success',
                                        '0' => 'warning',
                                    }),
                            ]),
                    ]),
                Infolists\Components\Section::make('Code')
                    ->schema([
                        FormExampleCode::make('key')
                            ->label('Example HTML Template:'),
                    ]),
                /*
                Infolists\Components\Section::make('Test Form')
                    ->schema([
                        FormExampleTest::make('key')
                            ->label('Contact'),
                    ]),
                */
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active'),
                Forms\Components\Fieldset::make('Preferences')
                    ->relationship('preferences')
                    ->schema([
                        Forms\Components\TextInput::make('redirect_url'),
                        Forms\Components\Toggle::make('is_g_captcha_enabled')
                            ->label('Enable Google reCAPTCHA v2'),
                        Forms\Components\TextInput::make('g_captcha_secret')
                            ->label('reCAPTCHA Secret Key'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->orderBy('id', 'DESC'))
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'view' => pages\ViewForm::route('/{record}'),
            'edit' => pages\editform::route('/{record}/edit'),

            // submissions
            'form-submissions.index' => ListFormSubmissions::route('/{parent}/submissions'),
            'form-submissions.view' => ViewFormSubmission::route('/{parent}/submissions/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->roles->where('name', 'admin')->first()) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
    }
}
