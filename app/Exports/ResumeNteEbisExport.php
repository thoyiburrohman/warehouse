<?php

namespace App\Exports;

use App\Models\AssetNte;
use App\Models\Nte;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ResumeNteEbisExport implements WithMultipleSheets, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function sheets(): array
    {
        return [
            'Sheet 1' => new class implements FromView
            {
                public function view(): View
                {
                    return view('exports.resume-nte-ebis', [
                        'assetNte' => AssetNte::WhereRelation('nte', 'owner', 'EBIS')->orderBy('name', 'asc')->get(),
                    ]);
                }
            },
            'Sheet 2' => new class implements FromView
            {
                public function view(): View
                {
                    return view('exports.barcode-nte-ebis', [
                        'nte' => Nte::where('owner', 'EBIS')->orderBy('name', 'asc')->get(),
                    ]);
                }
            },
        ];
    }
}
