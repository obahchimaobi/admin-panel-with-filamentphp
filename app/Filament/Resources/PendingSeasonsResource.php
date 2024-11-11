<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingSeasonsResource\Pages;
use App\Filament\Resources\PendingSeasonsResource\RelationManagers;
use App\Models\Movies;
use App\Models\Seasons;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;

class PendingSeasonsResource extends Resource
{
    protected static ?string $model = Seasons::class;

    protected static ?string $navigationIcon = 'bi-hourglass';

    protected static ?string $activeNavigationIcon = 'bi-hourglass-bottom';

    protected static ?string $pluralModelLabel = "Pending seasons";

    protected static ?string $navigationGroup = 'Others';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Seasons::query()->where('status', 'pending'))
            ->columns([
                //
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('season_number'),
                Tables\Columns\TextColumn::make('episode_number'),
                Tables\Columns\TextColumn::make('episode_name'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                    }),
                Tables\Columns\TextColumn::make('download_url')
                    ->limit(20),
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

                                TextInput::make('season_number')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('episode_number')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('episode_name')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('status')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                TextInput::make('download_url')
                                    ->disabled()
                                    ->columnSpan([
                                        'sm' => 2,
                                        'xl' => 3,
                                        '2xl' => 4,
                                    ]),

                                Textarea::make('overview')
                                    ->columnSpanFull()

                            ])
                    ]),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),

                    BulkAction::make('movies')
                        ->label('Approve Selected')
                        ->color('success')
                        ->icon('heroicon-m-check-circle')
                        ->action(function ($records) { // Use $records as a collection
                            foreach ($records as $record) {
                                $record->update([
                                    'status' => 'approved',
                                    'approved_at' => Carbon::now(),
                                ]);
                            }

                            Notification::make()
                                ->title('Approval Successful')
                                ->success()
                                ->send();
                        })
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
            'index' => Pages\ListPendingSeasons::route('/'),
            // 'edit' => Pages\EditPendingSeasons::route('/{record}/edit'),
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
