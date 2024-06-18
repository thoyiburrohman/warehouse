<?php

namespace App\Http\Controllers;

use App\Models\AssetMaterial;
use App\Models\Material;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AssetMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'assetMaterial' => AssetMaterial::all(),
        ];
        return view('pages.asset-material.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.asset-material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request->validate([
            'code' => 'required',
            'segment' => 'required',
            'satuan' => 'required',
            'name' => 'required',
        ]);

        AssetMaterial::create($store);
        Session::flash('success', 'Item berhasil ditambahkan');
        return redirect()->route('asset-material.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(AssetMaterial::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'assetMaterial' => Assetmaterial::find($id),
        ];
        return view('pages.asset-material.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $update = $request->validate([
            'code' => 'required',
            'segment' => 'required',
            'satuan' => 'required',
            'name' => 'required',
        ]);

        AssetMaterial::where('id', $id)->update($update);
        Session::flash('success', 'Item berhasil diupdate');
        return redirect()->route('asset-material.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AssetMaterial::destroy($id);
        Session::flash('success', 'Item berhasil dihapus');
        return redirect()->route('asset-material.index');
    }

    public function import()
    {
        return view('pages.asset-material.import');
    }
    public function importing()
    {
        ini_set('max_execution_time', 180);
        $data =   Excel::toArray([], request()->file('file'));
        foreach ($data as $value) {
            foreach ($value as $row) {
                $asset =    AssetMaterial::create([
                    'code' => $row[0],
                    'name' => $row[1],
                    'segment' => $row[2],
                    'satuan' => $row[3],
                ]);
                foreach (Warehouse::all() as $warehouse) {
                    Material::create([
                        'warehouse_id' => $warehouse->id,
                        'asset_material_id' => $asset->id,
                        'quantity' => 0,
                    ]);
                }
            }
        }
        Session::flash('success', 'Data berhasil diimport');
        return redirect()->route('asset-material.index');
    }
}
