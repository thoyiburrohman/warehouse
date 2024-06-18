<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Material;
use App\Models\TransactionMaterial;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Api;
use Illuminate\Support\Str;

class TagOutMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'tagOut' => TransactionMaterial::where('from_id', warehouseId())->where('type', 'tag out')->get(),
        ];
        return view('pages.transaction.material.tag-out.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'material' => Material::where('warehouse_id', warehouseId())->get(),
            'warehouses' => Warehouse::whereNot('id', warehouseId())->orderBy('name', 'asc')->get(),
        ];
        return view('pages.transaction.material.tag-out.create', $data);
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
                'type' => 'tag out',
                'date' => $store['date'],
                'reservation_number' => $store['reservation_number'],
                'gi_number' => $store['gi_number'],
                'rfc_number' => $store['rfc_number'],
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
            $dataIn =   TransactionMaterial::create([
                'from_id' => warehouseId(),
                'to_id' => $store['to_id'],
                'type' => 'tag in',
                'date' => $store['date'],
                'reservation_number' => $store['reservation_number'],
                'gi_number' => $store['gi_number'],
                'rfc_number' => $store['rfc_number'],
                'created_by' => auth()->user()->name,
                'updated_by' => auth()->user()->name,
            ]);
            $materialsIn = [];
            for ($i = 0; $i < count($request->id_material); $i++) {
                $materialsIn[] = DetailTransaction::create([
                    'transaction_material_id' => $dataIn->id,
                    'asset_material_id' => $request->id_material[$i],
                    'quantity' =>  $request->quantity[$i]
                ]);
            }
            $admin = User::where('warehouse_id',  $request->to_id)->first();
            if ($admin->telegram) {

                $dataMaterial = "";
                foreach ($materials as $material) {
                    $material_name = Str::replace('-', '\-', $material->assets->name);
                    $dataMaterial .= '_' . $material_name . ' \| ' . $material->quantity . ' ' . $material->assets->satuan . '_' . "\n"; // Assuming 'serial_number' is the column name
                }
                $date = \Carbon\Carbon::parse($request->date)->format('d F Y');
                $dataMaterial = rtrim($dataMaterial, " ");
                $bot->sendMessage([
                    'chat_id' => $admin->telegram,
                    'parse_mode' => 'MarkdownV2',
                    'text' => 'Hallo ' . $admin->name . ',' . "\n" .
                        'Berikut adalah detail TAG In Material tanggal ' .   $date . ' :' . "\n" . "\n" .
                        'From Warehouse *' . auth()->user()->warehouse->name . '*' . "\n" . "\n" .
                        '*Nama Material \| Jumlah*' . "\n" .
                        $dataMaterial .  "\n" .
                        'Silahkan cek *menu TAG In* Material' . "\n" .
                        'Terimakasih',
                ]);
            }
            Session::flash('success', 'Tag complete');
            return redirect()->route('tag-out.material.index');
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
    public function edit(TransactionMaterial $transactionMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionMaterial $transactionMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionMaterial $transactionMaterial)
    {
        //
    }
}
