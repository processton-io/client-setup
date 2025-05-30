<?php

namespace Processton\Org\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Filament\Forms;
use Processton\Org\Models\Org;

use function PHPSTORM_META\type;

class OrgSettings extends Page
{
    protected static ?string $navigationLabel = 'Org';
    protected static string $view = 'org::settings';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $slug = 'org';

    public $formData = []; // Define a public property to hold form data

    public $orgSettings = [];

    public function mount(): void
    {
        $this->orgSettings = Org::all();
        $this->formData = $this->orgSettings->mapWithKeys(function ($org) {
            $value = $org->org_value;
            if ($org->type === 'multiselect') {
                $value = json_decode($org->org_value, true) ?: [];
            }
            if (in_array($org->type, ['avatar', 'image', 'file', 'logo'])) {
                $value = $org->org_value
                    ? [$org->org_value]
                    : null;
            }
            return ['org_' . $org->org_key => $value];
        })->toArray();
    }

    protected function getFormStatePath(): string
    {
        return 'formData'; // Bind the form state to the $formData property
    }

    protected function getFormSchema(): array
    {
        $items = Org::all();

        return $items->map(function ($field) {
            return $this->makeFormField($field->toArray());
        })->toArray();
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Forms\Components\Actions\Action::make('save')
                ->label('Save')
                ->submit('submit')
                ->button(),
        ];
    }

    protected function makeFormField($field)
    {
        $base = match ($field['type']) {
            'string' => Forms\Components\TextInput::make('org_' . $field['org_key']),
            'text' => Forms\Components\Textarea::make('org_' . $field['org_key']),
            'select' => Forms\Components\Select::make('org_' . $field['org_key'])
                ->options($field['org_options'] ?? []),
            'multiselect' => Forms\Components\Select::make('org_' . $field['org_key'])->multiple()
                ->options($field['org_options'] ?? []),
            'checkbox' => Forms\Components\Checkbox::make('org_' . $field['org_key']),
            'radio' => Forms\Components\Radio::make('org_' . $field['org_key'])
                ->options($field['org_options'] ?? []),
            'toggle' => Forms\Components\Toggle::make('org_' . $field['org_key']),
            'file', 'avatar', 'image', 'logo' => Forms\Components\FileUpload::make('org_' . $field['org_key'])
                ->image(in_array($field['type'], ['avatar', 'image', 'logo']))
                ->avatar($field['type'] === 'avatar'),
            'color' => Forms\Components\ColorPicker::make('org_' . $field['org_key']),
            'date' => Forms\Components\DatePicker::make('org_' . $field['org_key']),
            'datetime' => Forms\Components\DateTimePicker::make('org_' . $field['org_key']),
            'time' => Forms\Components\TimePicker::make('org_' . $field['org_key']),
            'number' => Forms\Components\TextInput::make('org_' . $field['org_key'])
                ->numeric()
                ->minValue(0)
                ->maxValue(100),
            default => Forms\Components\TextInput::make('org_' . $field['org_key']),
        };

        if ($field['org_key'] === 'primary_currency') {
            $base = $base->disabled();
        }

        return $base->label($field['title'])
            ->default($field['org_value'])
            ->placeholder($field['description'])
            ->reactive()
            ->required(in_array($field['org_key'],['description','other_currencies']) ? false : true);
    }

    private function storeFile($value, $orgKey)
    {

        $path = '';
        if(is_array($value)) {
            foreach ($value as $key => $val) {
                $filename = 'org_' . $orgKey . '_' . time() . '.' . $val->getClientOriginalExtension();
                $path = $val->storeAs('brand', $filename, 'public');
                $val->delete();

            }
            return $path;
        }
        if(is_string($value)){
            return $value;
        }

        if($value == null) {
            return null;
        }
    }

    public function submit()
    {
        $data = $this->formData;
        foreach ($data as $key => $value) {
            $orgKey = str_replace('org_', '', $key);
            if ($orgKey === 'primary_currency') {
                continue; // Prevent updating primary_currency
            }
            $org = \Processton\Org\Models\Org::where('org_key', $orgKey)->first();
            if (!$org) continue;

            if (in_array($org->type, ['file', 'avatar', 'image', 'logo'])) {
                // For FileUpload, $value is usually an array of file paths or TemporaryUploadedFile
                if (is_array($value) && isset($value[0])) {
                    $filePath = $this->storeFile($value[0], $orgKey);
                } else {
                    $filePath = $this->storeFile($value, $orgKey);
                }
                if ($filePath !== null) {
                    $org->org_value = $filePath;
                }
            } elseif ($org->type === 'multiselect') {
                $org->org_value = json_encode($value);
            } else {
                $org->org_value = $value;
            }
            $org->save();
        }

        $this->dispatch('notify', title: 'Settings updated successfully!');
        return redirect(request()->header('Referer') ?? url()->current());
    }
}
