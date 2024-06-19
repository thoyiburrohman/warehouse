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
        if (roleId() != 3) {
            $intech = TransactionNte::where('type', 'distribution')->whereRelation('nte', 'status', 'intech')->orderBy('date', 'asc')->get();
        } else {
            $intech = TransactionNte::where('type', 'distribution')->whereRelation('nte', 'warehouse_id', warehouseId())
                ->whereRelation('nte', 'status', 'intech')->orderBy('date', 'asc')->get();
        }
        return view('exports.report-intech', [
            'distributions' => $intech,
        ]);
    }
}
