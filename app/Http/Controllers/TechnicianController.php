<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'technician' => Technician::all(),
        ];
        return view('pages.technician.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'mitra' => Mitra::all(),
        ];
        return view('pages.technician.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'division' => 'required',
            'mitra_id' => 'required',
        ]);
        $store['telegram'] = $request->telegram;
        Technician::create($store);
        Session::flash('success', 'Technician berhasil ditambahkan');
        return redirect()->route('technician.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technician $technician)
    {
        return response()->json(Technician::find($technician->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technician $technician)
    {
        $data = [
            'technician' => Technician::find($technician->id),
            'mitra' => Mitra::all(),
        ];
        return view('pages.technician.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technician $technician)
    {
        $update = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'division' => 'required',
            'mitra_id' => 'required',
        ]);
        $update['telegram'] = $request->telegram;
        Technician::where('id', $technician->id)->update($update);
        Session::flash('success', 'Technician berhasil diupdate');
        return redirect()->route('technician.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technician $technician)
    {
        Technician::destroy($technician->id);
        Session::flash('success', 'Technician berhasil dihapus');
        return redirect()->route('technician.index');
    }

    public function import()
    {
        return view('pages.technician.import');
    }
    public function importing()
    {
        ini_set('max_execution_time', 120);
        $data =   Excel::toArray([], request()->file('file'));
        foreach ($data as $value) {
            foreach ($value as $row) {
                $item = Mitra::where('name', $row[3])->first();
                // Jika item ditemukan, buat transaksi baru
                if ($item) {
                    Technician::create([
                        'name' => $row[0],
                        'nik' => $row[1],
                        'division' => $row[2],
                        'mitra_id' => $item->id,
                    ]);
                }
            }
        }
        Session::flash('success', 'Data berhasil diimport');
        return redirect()->route('technician.index');
    }
}
