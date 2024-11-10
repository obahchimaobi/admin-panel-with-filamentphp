<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use App\Models\Movies;
use Filament\Forms\Form;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PendingMoviesResource\Pages;
use App\Filament\Resources\PendingMoviesResource\RelationManagers;

class PendingMoviesResource extends Resource
{
    protected static ?string $model = Movies::class;

    protected static ?string $navigationIcon = 'far-hourglass';

    protected static ?string $activeNavigationIcon = 'fas-hourglass-end';

    protected static ?string $pluralModelLabel = "Pending movies";

    protected static ?string $navigationGroup = 'Others';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('full_name')
                    ->disabled(),
                Forms\Components\TextInput::make('genres')
                    ->disabled(),
                Forms\Components\TextInput::make('runtime')
                    ->disabled(),
                Forms\Components\Textarea::make('genres')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Movies::query()->where('status', 'pending'))
            ->columns([
                //
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('releaseYear')
                    ->searchable(),
                Tables\Columns\TextColumn::make('aggregateRating'),
                Tables\Columns\TextColumn::make('genres')
                    ->searchable()
                    ->disabled(),
                Tables\Columns\TextColumn::make('download_url')
                    ->limit(10),
                Tables\Columns\TextColumn::make('trailer')
                    ->limit(10),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'pending' => 'warning',
                        'approved' => 'success'
                    ]),

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

                                TextInput::make('runtime')
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('trailer')
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

                                TextInput::make('aggregateRating')
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                Textarea::make('plotText')
                                    ->disabled()
                                    ->columnSpanFull()
                            ])
                    ]),



                Tables\Actions\DeleteAction::make(),

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
                    ->visible(fn($record) => $record->status === 'pending'),
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
            'index' => Pages\ListPendingMovies::route('/'),
            'create' => Pages\CreatePendingMovies::route('/create'),
            // 'edit' => Pages\EditPendingMovies::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }
}
