<?php

namespace App\Exports;

use App\Models\TransactionNte;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ReportIntechExport implements FromView, ShouldAutoSize
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        return view('exports.report-intech', [
            'distributions' => TransactionNte::where('type', 'distribution')->whereRelation('nte', 'status', 'intech')->get(),
        ]);
    }
}
