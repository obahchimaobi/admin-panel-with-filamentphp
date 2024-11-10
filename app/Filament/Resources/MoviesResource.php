<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Movies;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\MoviesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MoviesResource\RelationManagers;
use Filament\Notifications\Notification;

class MoviesResource extends Resource
{
    protected static ?string $model = Movies::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $activeNavigationIcon = 'heroicon-s-film';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('movieId')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('isAdult')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('originalTitleText')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('imageUrl')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('backdrop_path')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('language')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('plotText')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('releaseDate')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('releaseYear')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('aggregateRating')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('titleType')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('runtime')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('genres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('trailer')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('download_url')
                    ->maxLength(255)
                    ->default(0),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('downloads')
                    ->required()
                    ->maxLength(255)
                    ->default(0),
                Forms\Components\DateTimePicker::make('approved_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('releaseYear')
                    ->searchable(),
                Tables\Columns\TextColumn::make('aggregateRating')
                    ->searchable(),
                Tables\Columns\TextColumn::make('genres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('download_url')
                    ->searchable()
                    ->limit(10),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                    }),
                Tables\Columns\TextColumn::make('downloads')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('approved_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                //
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        Section::make()
                            ->columns([
                                'sm' => 3,
                                'xl' => 6,
                                '2xl' => 8,
                            ])
                            ->schema([
                                TextInput::make('full_name')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('genres')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('aggregateRating')
                                    // ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('status')
                                    // ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('download_url')
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('runtime')
                                    // ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                Textarea::make('plotText')
                                    ->columnSpanFull()
                                // ...
                            ])
                    ]),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),

                Action::make('movies')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-m-check-circle')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_at' => Carbon::now(),
                        ]);

                        Notification::make()
                            ->title('Approval Successful')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListMovies::route('/'),
            // 'edit' => Pages\EditMovies::route('/{record}/edit'),
        ];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             // ...
    //             TextEntry::make('full_name')
    //                 ->copyable(),

    //             TextEntry::make(name: 'country')
    //                 ->copyable(),

    //             TextEntry::make('plotText')
    //                 ->copyable(),

    //             TextEntry::make('releaseYear')
    //                 ->copyable(),

    //             TextEntry::make(name: 'releaseDate')
    //                 ->copyable(),

    //             TextEntry::make('aggregateRating')
    //                 ->copyable(),

    //             TextEntry::make('runtime')
    //                 ->copyable(),

    //             TextEntry::make(name: 'status')
    //                 ->copyable(),

    //             TextEntry::make('downloads')
    //                 ->copyable(),

    //             TextEntry::make('approved_at')
    //                 ->since()
    //                 ->copyable(),
    //         ]);
    // }

    // public static function getGloballySearchableAttributes(): array
    // {
    //     return ['full_name', 'country', 'releaseYear'];
    // }
}
