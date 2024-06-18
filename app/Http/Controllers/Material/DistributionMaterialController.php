<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\TransactionMaterial;
use App\Models\Technician;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Api;
use Illuminate\Support\Str;

class DistributionMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'distributions' => TransactionMaterial::where('from_id', warehouseId())->orderBy('createed_at', 'desc')->get(),
        ];
        return view('pages.transaction.material.distribution.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'material' => Material::where('warehouse_id', warehouseId())->get(),
            'technician' => Technician::all(),
        ];
        return view('pages.transaction.material.distribution.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Api $bot)
    {
        $store = $request->validate([
            'gi_number' => 'required',
            'rfc_number' => 'required',
            'to_id' => 'required',
            'date' => 'required',
            'reservation_number' => 'required',
            'quantity' => 'required',
        ]);
        for ($i = 0; $i < count($request->id_material); $i++) {
            $materialId = $request->id_material[$i];

            // dd($request->all());
            $material = Material::where('warehouse_id', warehouseId())->where('asset_material_id', $materialId)->first();
            $distribution = DetailTransaction::whereRelation('transaction', 'from_id', warehouseId())->whereRelation('transaction', 'type', 'distribution')->where('asset_material_id', $materialId)->first();
            $tagOut = DetailTransaction::whereRelation('transaction', 'from_id', warehouseId())->whereRelation('transaction', 'type', 'tag out')->where('asset_material_id', $materialId)->first();
            $tagIn = DetailTransaction::whereRelation('transaction', 'to_id', warehouseId())->whereRelation('transaction', 'type', 'tag in')->where('asset_material_id', $materialId)->first();

            $availableStock = $material->quantity;

            if ($tagIn && $tagIn->quantity) { // Check if $tagIn is not null and has a quantity
                $availableStock += $tagIn->quantity;
            }

            if ($distribution && $distribution->quantity) { // Check if $distribution is not null and has a quantity
                $availableStock -= $distribution->quantity;
            }

            if ($tagOut && $tagOut->quantity) { // Check if $tagOut is not null and has a quantity
                $availableStock -= $tagOut->quantity;
            }
            if ($request->quantity[$i] > $availableStock || $availableStock === 0) {
                Session::flash('error', 'Stock material tidak cukup');
                return redirect()->back();
            }

            $data =   TransactionMaterial::create([
                'from_id' => warehouseId(),
                'to_id' => $store['to_id'],
                'type' => 'distribution',
                'date' => $store['date'],
                'reservation_number' => $store['reservation_number'],
                'gi_number' => $store['gi_number'],
                'rfc_number' => $store['rfc_number'],
                'order' => $request->order,
                'inet' => $request->inet,
                'berita_acara' => $request->berita_acara,
                'created_by' => auth()->user()->name,
                'updated_by' => auth()->user()->name,
            ]);
            $materials = [];
            for ($i = 0; $i < count($request->id_material); $i++) {
                $materials[] = DetailTransaction::create([
                    'transaction_material_id' => $data->id,
                    'asset_material_id' => $request->id_material[$i],
                    'quantity' =>  $request->quantity[$i]
                ]);
            }
            $teknisi = Technician::where('id',  $request->to_id)->first();
            if ($teknisi->telegram) {

                $dataMaterial = "";
                foreach ($materials as $material) {
                    $material_name = Str::replace('-', '\-', $material->assets->name);
                    $dataMaterial .= '_' . $material_name . ' \| ' . $material->quantity . ' ' . $material->assets->satuan . '_' . "\n"; // Assuming 'serial_number' is the column name
                }
                $date = \Carbon\Carbon::parse($request->date)->format('d F Y');
                $dataMaterial = rtrim($dataMaterial, " ");
                $bot->sendMessage([
                    'chat_id' => $teknisi->telegram,
                    'parse_mode' => 'MarkdownV2',
                    'text' => 'Hallo ' . $teknisi->name . ',' . "\n" .
                        'Berikut adalah detail pengambilan Material tanggal ' .   $date . ' :' . "\n" . "\n" .
                        'Warehouse *' . auth()->user()->warehouse->name . '*' . "\n" . "\n" .
                        '*Nama Material \| Jumlah*' . "\n" .
                        $dataMaterial .  "\n" .
                        'Silahkan cek *List Stok Barang* pada aplikasi Amalia' . "\n" .
                        'Terimakasih',
                ]);
            }
            Session::flash('success', 'Distribution complete');
            return redirect()->route('distribution.material.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionMaterial $transactionMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionMaterial $transactionMaterial, $id)
    {
        $data = [
            // 'detailMaterial' => DetailTransaction::where('transaction_material_id', $id)->get(),
            'transactions' => TransactionMaterial::find($id),
            'material' => Material::all(),
            'technician' => Technician::all(),
            // 'warehouses' => Warehouse::whereNot('id', auth()->user()->warehouse_id)->get(),
        ];
        return view('pages.transaction.material.distribution.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        TransactionMaterial::where('id', $id)
            ->update([
                'order' => $request->order,
                'inet' => $request->inet,
                'berita_acara' => $request->berita_acara,
                'date' => $request->date,
                'updated_by' => auth()->user()->name,
            ]);
        Session::flash('success', 'Update Complete');
        return redirect()->route('distribution.material.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionMaterial $transactionMaterial)
    {
        //
    }
}
