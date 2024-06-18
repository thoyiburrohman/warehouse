<?php

namespace App\Exports;

use App\Models\AssetNte;
use App\Models\Nte;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ResumeNteTselExport implements WithMultipleSheets, ShouldAutoSize
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
                    return view('exports.resume-nte-tsel', [
                        'assetNte' => AssetNte::WhereRelation('nte', 'owner', 'TSEL')->orderBy('name', 'asc')->get(),
                    ]);
                }
            },
            'Sheet 2' => new class implements FromView
            {
                public function view(): View
                {
                    return view('exports.barcode-nte-tsel', [
                        'nte' => Nte::where('owner', 'TSEL')->orderBy('name', 'asc')->get(),
                    ]);
                }
            },
        ];
    }
}
