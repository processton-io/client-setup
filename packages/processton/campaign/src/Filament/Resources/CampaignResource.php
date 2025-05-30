<?php

namespace Processton\Campaigns\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Processton\Campaigns\Models\Campaign;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(['default' => 1, 'md' => 3])
                    ->schema([
                        Forms\Components\Grid::make(['default' => 1])
                            ->columnSpan(['md' => 2])
                            ->schema([
                                Forms\Components\TextInput::make('title')->required()->columnSpanFull(),
                                Forms\Components\DatePicker::make('start_date'),
                                Forms\Components\DatePicker::make('end_date'),
                                Forms\Components\Textarea::make('description')->columnSpanFull(),
                            ])->columns(2),
                        Forms\Components\Grid::make(['default' => 1])
                            ->columnSpan(['md' => 1])
                            ->schema([
                                Forms\Components\Repeater::make('timeline')
                                    ->schema([
                                        Forms\Components\Select::make('action')
                                            ->options([
                                                'publish_form' => 'Publish Form',
                                                'send_email' => 'Send Email',
                                                'publish_page' => 'Publish Page',
                                            ])->required(),
                                        Forms\Components\TextInput::make('details')->label('Details/Config'),
                                    ])
                                    ->label('Timeline Actions'),
                            ]),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('start_date')->date(),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
