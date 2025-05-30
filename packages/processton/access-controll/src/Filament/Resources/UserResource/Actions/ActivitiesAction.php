<?php

namespace Processton\AccessControll\Filament\Resources\UserResource\Actions;

use Closure;
use Filament\Actions\StaticAction;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ActivitiesAction extends Action
{
    protected ?Closure $mutateRecordDataUsing = null;

    public static function getDefaultName(): ?string
    {
        return 'activities';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Activities');

        $this->modalSubmitAction(false);

        $this->color('gray');

        $this->icon(FilamentIcon::resolve('actions::view-action') ?? 'heroicon-m-eye');

        $this->disabledForm();

        $this->fillForm(function (Model $record, Table $table): array {
            if ($translatableContentDriver = $table->makeTranslatableContentDriver()) {
                $data = $translatableContentDriver->getRecordAttributesToArray($record);
            } else {
                $data = $record->attributesToArray();
            }

            if ($this->mutateRecordDataUsing) {
                $data = $this->evaluate($this->mutateRecordDataUsing, ['data' => $data]);
            }

            return $data;
        });

        $this->action(static function (): void {});
    }

    public function mutateRecordDataUsing(?Closure $callback): static
    {
        $this->mutateRecordDataUsing = $callback;

        return $this;
    }
}
