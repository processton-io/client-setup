<?php

namespace Processton\Abacus\Filament\Pages;

use Processton\Abacus\Models\AbacusTransaction;
use Processton\Abacus\Models\AbacusChartOfAccount;
use Processton\Abacus\Models\AbacusYear;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\Response;

class TrialBalance extends Page implements HasForms
{
    use InteractsWithForms;

    // protected static ?string $navigationIcon = 'heroicon-o-table';
    protected static string $view = 'abacus.trial-balance';
    protected static ?string $title = 'Trial Balance';

    protected static ?string $navigationGroup = 'Reporting';
    protected static ?int $navigationSort = 11;

    public ?int $yearId = null;
    public ?string $startDate = null;
    public ?string $endDate = null;

    public Collection $rows;
    public bool $showPdf = false;

    public function mount(): void
    {
        $this->rows = collect();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\Select::make('yearId')
                        ->label('Year')
                        ->options(
                            AbacusYear::orderByDesc('start_date')->get()->map(
                                fn (AbacusYear $year) => [
                                    'label' => $year->start_date->format('Y') . ' - ' . $year->end_date->format('Y'),
                                    'value' => $year->id,
                                ]
                            )->pluck('label', 'value')
                        ),

                    Forms\Components\DatePicker::make('startDate')->label('From'),
                    Forms\Components\DatePicker::make('endDate')->label('To'),

                    Forms\Components\Actions::make([
                        Forms\Components\Actions\Action::make('View Report')
                            ->submit('viewReport'),
                        // Forms\Components\Actions\Action::make('View PDF')
                        //     ->action('viewPdf')
                        //     ->color('info')
                        //     ->icon('heroicon-o-eye'),
                            // ->visible(fn () => $this->rows->isNotEmpty()),
                        Forms\Components\Actions\Action::make('Download PDF')
                            ->action('downloadPdf')
                            ->color('success')
                            ->icon('heroicon-o-document-arrow-down')
                            ->visible(fn () => $this->rows->isNotEmpty()),
                    ])->columnSpanFull(),
                ]
            )
            ->columns(1);
    
    }

    public function viewReport(): void
    {
        $accounts = AbacusChartOfAccount::orderBy('code')->get();

        $this->rows = $accounts->map(function ($account) {
            $query = AbacusTransaction::where('abacus_chart_of_account_id', $account->id);

            if ($this->yearId) {
                $query->where('abacus_year_id', $this->yearId);
            }

            if ($this->startDate) {
                $query->whereDate('date', '>=', $this->startDate);
            }

            if ($this->endDate) {
                $query->whereDate('date', '<=', $this->endDate);
            }

            $debit = $query->clone()->where('entry_type', 'debit')->sum('amount');
            $credit = $query->clone()->where('entry_type', 'credit')->sum('amount');

            $net = $debit - $credit;

            return [
                'code' => $account->code,
                'name' => $account->name,
                'debit' => $net > 0 ? $net : 0,
                'credit' => $net < 0 ? abs($net) : 0,
            ];
        })->filter(fn($row) => $row['debit'] != 0 || $row['credit'] != 0);
    }

    public function downloadPdf(): Response
    {
        // Get year information
        $year = $this->yearId ? AbacusYear::find($this->yearId) : null;
        
        $data = [
            'rows' => $this->rows,
            'year' => $year,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'totalDebit' => $this->rows->sum('debit'),
            'totalCredit' => $this->rows->sum('credit'),
            'generatedAt' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('abacus.trial-balance-pdf', $data);
        
        $filename = 'trial-balance-' . now()->format('Y-m-d') . '.pdf';
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename, ['Content-Type' => 'application/pdf']);
    }

    public function viewPdf(): void
    {
        $this->showPdf = true;
    }

    public function streamPdf(): Response
    {
        $this->yearId = request()->input('yearId', $this->yearId);
        $this->startDate = request()->input('startDate', $this->startDate);
        $this->endDate = request()->input('endDate', $this->endDate);
        // Get year information
        $year = $this->yearId ? AbacusYear::find($this->yearId) : null;

        $this->mount();

        // Ensure rows are populated
        if ($this->rows->isEmpty()) {
            $this->viewReport();
        }
        
        $data = [
            'rows' => $this->rows,
            'year' => $year,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'totalDebit' => $this->rows->sum('debit'),
            'totalCredit' => $this->rows->sum('credit'),
            'generatedAt' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = \App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('abacus.trial-balance-pdf', $data);
        
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="trial-balance-' . now()->format('Y-m-d') . '.pdf"'
        ]);
    }
}