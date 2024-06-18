<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'mitra' => Mitra::all(),
        ];
        return view('pages.mitra.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request->validate([
            'name' => 'required',
        ]);

        Mitra::create($store);
        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('mitra.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        return response()->json(Mitra::find($mitra->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        $data = [
            'mitra' => Mitra::find($mitra->id),
        ];
        return view('pages.mitra.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        $update = $request->validate([
            'name' => 'required',
        ]);

        Mitra::where('id', $mitra->id)->update($update);
        Session::flash('success', 'Data berhasil diupdate');
        return redirect()->route('mitra.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        Mitra::destroy($mitra->id);
        Session::flash('success', 'Data berhasil dihapus');
        return redirect()->route('mitra.index');
    }

    public function import()
    {
        return view('pages.mitra.import');
    }
    public function importing()
    {
        $data =   Excel::toArray([], request()->file('file'));
        foreach ($data as $value) {
            foreach ($value as $row) {
                Mitra::create([
                    'name' => $row[0],
                ]);
            }
        }
        Session::flash('success', 'Data berhasil diimport');
        return redirect()->route('mitra.index');
    }
}
