<?php

namespace App\Http\Controllers;

use App\Models\AssetNte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AssetNteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'assetNte' => AssetNte::all(),
        ];
        return view('pages.asset-nte.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.asset-nte.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request->validate([
            'type' => 'required',
            'supplier' => 'required',
            'name' => 'required',
        ]);

        AssetNte::create($store);
        Session::flash('success', 'Item berhasil ditambahkan');
        return redirect()->route('asset-nte.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        return response()->json(AssetNte::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'item' => AssetNte::find($id),
        ];
        return view('pages.asset-nte.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $update = $request->validate([
            'supplier' => 'required',
            'type' => 'required',
            'name' => 'required',

        ]);

        AssetNte::where('id', $id)->update($update);
        Session::flash('success', 'Item berhasil diupdate');
        return redirect()->route('asset-nte.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AssetNte::destroy($id);
        Session::flash('success', 'Item berhasil dihapus');
        return redirect()->route('asset-nte.index');
    }

    public function import()
    {
        return view('pages.asset-nte.import');
    }
    public function importing()
    {
        $data =   Excel::toArray([], request()->file('file'));
        foreach ($data as $value) {
            foreach ($value as $row) {
                AssetNte::create([
                    'type' => $row[0],
                    'supplier' => $row[1],
                    'name' => $row[2],
                ]);
            }
        }
        Session::flash('success', 'Data berhasil diimport');
        return redirect()->route('asset-nte.index');
    }
}
