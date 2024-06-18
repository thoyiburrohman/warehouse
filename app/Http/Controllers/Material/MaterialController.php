<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Models\AssetMaterial;
use App\Models\DetailTransaction;
use App\Models\Material;
use App\Models\TransactionMaterial;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $material =  Material::where('warehouse_id', warehouseId())->get();
        $data = [
            'material' => $material,
            'totalDistribution' =>  DetailTransaction::whereRelation('transaction', 'from_id', warehouseId())->whereRelation('transaction', 'type', 'distribution')->get(),
            'totalTagOut' => DetailTransaction::whereRelation('transaction', 'from_id', warehouseId())->whereRelation('transaction', 'type', 'tag out')->get(),
            'totalTagIn' => DetailTransaction::whereRelation('transaction', 'to_id', warehouseId())->whereRelation('transaction', 'type', 'tag in')->get(),
        ];
        return view('pages.material.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'warehouses' => Warehouse::all(),
            'assets' => AssetMaterial::all(),
        ];
        return view('pages.material.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $store = $request->validate([
            'asset_material_id' => 'required',
            'quantity' => 'required',
        ]);
        if (roleId() == 3) {
            $store['warehouse_id'] = warehouseId();
        } else {
            $store['warehouse_id'] = $request->warehouse_id;
        }
        Material::create($store);
        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('material.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $data = [
            'warehouses' => Warehouse::all(),
            'material' => Material::find($material->id),
            'assets' => AssetMaterial::all(),
        ];
        return view('pages.material.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $update = $request->validate([
            'asset_material_id' => 'required',
            'quantity' => 'required',
        ]);
        if (roleId() == 3) {
            $update['warehouse_id'] = warehouseId();
        } else {
            $update['warehouse_id'] = $request->warehouse_id;
        }
        Material::where('id', $material->id)->update($update);
        Session::flash('success', 'Data berhasil diupdate');
        return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        Material::destroy($material->id);
        Session::flash('success', 'Data berhasil dihapus');
        return redirect()->route('material.index');
    }

    public function import()
    {
        return view('pages.material.import');
    }
    public function importing()
    {
        $data =   Excel::toArray([], request()->file('file'));
        foreach ($data as $value) {
            foreach ($value as $row) {
                $item = AssetMaterial::where('code', $row[0])->first();
                Material::where('asset_material_id', $item->id)->where('warehouse_id', warehouseId())->update([
                    'quantity' => $row[1],
                ]);
            }
        }
        Session::flash('success', 'Data berhasil diimport');
        return redirect()->route('material.index');
    }
}
