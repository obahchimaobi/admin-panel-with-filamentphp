<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Movies;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkAction;

class LatestMovies extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static bool $isLazy = false;

    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                Movies::query()->whereDate('created_at', Carbon::today()),
            )
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('releaseYear'),
                Tables\Columns\TextColumn::make('genres')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                    }),
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
                                    // ->disabled()
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
}
