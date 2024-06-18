<?php

namespace App\Http\Controllers\Nte;

use App\Exports\ReportIntechExport;
use App\Exports\ResumeNteEbisExport;
use App\Exports\ResumeNteTselExport;
use App\Http\Controllers\Controller;
use App\Models\AssetNte;
use App\Models\Technician;
use App\Models\Warehouse;
use App\Models\Nte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class NteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (roleId() == 1) {
            $nte =  Nte::all();
            $nteAvailable =  Nte::where('status', 'available')->get();
            $nteDismantle =  Nte::where('status', 'dismantle')->get();
            $nteUnvailable =  Nte::where('status', 'unvailable')->get();
            $nteIntech =  Nte::where('status', 'intech')->get();
            $nteInstall =  Nte::where('status', 'install')->get();
        } else {
            $nte = Nte::where('warehouse_id', auth()->user()->warehouse->id)->get();
            $nteAvailable =  Nte::where('warehouse_id', auth()->user()->warehouse->id)->where('status', 'available')->get();
            $nteDismantle =  Nte::where('warehouse_id', auth()->user()->warehouse->id)->where('status', 'dismantle')->get();
            $nteUnvailable =  Nte::where('warehouse_id', auth()->user()->warehouse->id)->where('status', 'unvailable')->get();
            $nteIntech =  Nte::where('warehouse_id', auth()->user()->warehouse->id)->where('status', 'intech')->get();
            $nteInstall =  Nte::where('warehouse_id', auth()->user()->warehouse->id)->where('status', 'install')->get();
        }

        $data = [
            'ntes' => $nte,
            'nteAvailable' => $nteAvailable,
            'nteDismantle' => $nteDismantle,
            'nteUnvailable' => $nteUnvailable,
            'nteIntech' => $nteIntech,
            'nteInstall' => $nteInstall,
            'warehouse' => Warehouse::all(),
            'technician' => Technician::all(),
        ];
        return view('pages.nte.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [

            'warehouses' => Warehouse::all(),
            'assetNte' => AssetNte::all(),
        ];
        return view('pages.nte.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request->validate([
            'warehouse_id' => 'required',
            'asset_nte_id' => 'required',
            'serial_number' => 'required',
            'owner' => 'required',
        ]);
        $store['status'] = 'available';
        $store['note'] = 'ready to use';
        Nte::create($store);
        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('nte.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nte $nte)
    {
        return response()->json(Nte::find($nte->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nte $nte)
    {
        $data = [
            'nte' => Nte::find($nte->id),
            'warehouses' => Warehouse::all(),
            'assetNte' => AssetNte::all(),
        ];
        return view('pages.nte.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nte $nte)
    {
        $update = $request->validate([
            'warehouse_id' => 'required',
            'asset_nte_id' => 'required',
            'serial_number' => 'required',
            'owner' => 'required',
            'owner' => 'required',
        ]);
        $update['status'] = 'available';
        $update['note'] = 'ready to use';
        Nte::where('id', $nte->id)->update($update);
        Session::flash('success', 'Data berhasil diubah');
        return redirect()->route('nte.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nte $nte)
    {
        Nte::destroy($nte->id);
        Session::flash('success', 'Data berhasil dihapus');
        return redirect()->route('nte.index');
    }
    public function dismantle(Nte  $nte)
    {
        Nte::where('id', $nte->id)->update([
            'status' => 'dismantle',
            'note' => 'ready to transfer'
        ]);
        Session::flash('success', 'Dismantle berhasil');
        return redirect()->route('nte.index');
    }
    public function damage(Nte  $nte)
    {
        Nte::where('id', $nte->id)->update([
            'status' => 'unvailable',
            'note' => 'ready to transfer'
        ]);
        Session::flash('success', 'Damage berhasil');
        return redirect()->route('nte.index');
    }
    public function exportTsel()
    {
        $date = Carbon::parse(now())->format('d-m-Y');
        $filename = 'Resume NTE TSEL ' . auth()->user()->warehouse->name . ' ' . $date . '.xlsx';
        return Excel::download(new ResumeNteTselExport, $filename);
    }
    public function exportEbis()
    {
        $date = Carbon::parse(now())->format('d-m-Y');
        $filename = 'Resume NTE EBIS ' . auth()->user()->warehouse->name . ' ' . $date . '.xlsx';
        return Excel::download(new ResumeNteEbisExport, $filename);
    }
    public function exportIntech()
    {
        $date = Carbon::parse(now())->format('d_F_Y');
        $filename = 'Reporting_Intech_Jakbar_' . $date . '.xlsx';
        return Excel::download(new ReportIntechExport, $filename);
    }
    public function import()
    {
        return view('pages.nte.import');
    }
    public function importing()
    {
        ini_set('max_execution_time', 300);
        $data =   Excel::toArray([], request()->file('file'));
        foreach ($data as $value) {
            foreach ($value as $row) {
                $dataChunk = collect($row);
                $chunk = $dataChunk->chunk(200);
                foreach ($chunk as $row) {
                    // Cari item berdasarkan serial number
                    $item = AssetNte::where('name', $row[0])->first();
                    // Jika item ditemukan, buat transaksi baru
                    if ($item) {
                        Nte::create([
                            'warehouse_id' => warehouseId(),
                            'asset_nte_id' => $item->id,
                            'serial_number' => $row[1],
                            'owner' => $row[2],
                            'status' => 'available',
                            'note' => 'ready to use',
                        ]);
                    }
                }
            }
        }
        Session::flash('success', 'Data berhasil diimport');
        return redirect()->route('nte.index');
    }
    public function getData(Request $request)
    {
        $data = Nte::where('serial_number', 'LIKE', "%{$request->get('query')}%")->first();
        return response()->json($data);
    }
}
