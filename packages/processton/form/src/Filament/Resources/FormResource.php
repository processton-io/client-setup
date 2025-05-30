<?php

namespace Processton\Form\Filament\Resources;


use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms;
use Filament\Tables;
use Processton\Form\Filament\Components\FormBuilder;
use Processton\Form\Filament\Components\FormEditor;
use Processton\Form\Models\Form as FormModel;

class FormResource extends Resource
{
    protected static ?string $model = FormModel::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\Section::make([
                        Forms\Components\TextInput::make('name')
                            ->label('Form Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('campaign_id')
                            ->label('Campaign')
                            ->relationship('campaign', 'title')
                            ->required(),
                        Forms\Components\Toggle::make('is_published')
                    ])->grow(false),
                    Forms\Components\Section::make([
                        FormBuilder::make('schema')
                            ->label('Form Editor'),
                    ])->grow(true),
                ])->from('lg')->columnSpan('full'),
            ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('campaign.name'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                // ...
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}
