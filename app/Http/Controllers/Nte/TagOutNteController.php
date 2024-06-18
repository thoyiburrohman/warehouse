<?php

namespace App\Http\Controllers\Nte;

use App\Http\Controllers\Controller;
use App\Models\Nte;
use App\Models\TransactionNte;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\Api;

class TagOutNteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (roleId() != 3) {
            $tagOut =   tagOutNteAll();
        } else {
            $tagOut =   tagOutNteGudang();
        }

        $data = [
            'tagOut' => $tagOut,
        ];
        return view('pages.transaction.nte.tag-out.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'ntes' => Nte::where('warehouse_id', warehouseId())->whereNot('status', 'intech')->whereNot('status', 'install')->get(),
            'warehouses' => Warehouse::whereNot('id', warehouseId())->orderBy('name', 'asc')->get(),
        ];
        return view('pages.transaction.nte.tag-out.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Api $bot)
    {
        ini_set('max_execution_time', 180);
        if ($request->file) {
            $data =   Excel::toArray([], request()->file('file'));

            foreach ($data as $value) {
                $number = $request->number;
                $to = $request->to_id;
                $date = $request->date;
                foreach ($value as $serialNumber) {
                    // Cari item berdasarkan serial number
                    $item = Nte::where('serial_number', $serialNumber)->first();
                    // Jika item ditemukan, buat transaksi baru
                    if ($item) {
                        Nte::where('id', $item->id)
                            ->update([
                                'warehouse_id' => $to,
                                'note' => 'TAG In from ' . auth()->user()->warehouse->name,
                            ]);
                        TransactionNte::create([
                            'number' => $number,
                            'date' => $date,
                            'from_id' => warehouseId(),
                            'to_id' => $to,
                            'nte_id' => $item->id, // Gunakan ID item dari tabel Item
                            'type' => 'stock transfer',
                            'created_by' => auth()->user()->name,
                            'updated_by' => auth()->user()->name,
                        ]);
                    }
                }
            }
        } else {
            Nte::whereIn('id', $request->sn_id)
                ->update([
                    'warehouse_id' => $request->to_id,
                    'note' => 'TAG In from ' . auth()->user()->warehouse->name,
                ]);
            foreach ($request->sn_id as $value) {
                TransactionNte::create([
                    'date' => $request->date,
                    'number' => $request->number,
                    'from_id' => warehouseId(),
                    'to_id' => $request->to_id,
                    'nte_id' => $value,
                    'type' => 'tag out',
                    'created_by' => auth()->user()->name,
                    'updated_by' => auth()->user()->name,
                ]);
                TransactionNte::create([
                    'date' => $request->date,
                    'number' => $request->number,
                    'from_id' => warehouseId(),
                    'to_id' => $request->to_id,
                    'nte_id' => $value,
                    'type' => 'tag in',
                    'created_by' => auth()->user()->name,
                    'updated_by' => auth()->user()->name,
                ]);
            }
        }
        $admin = User::where('warehouse_id',  $request->to_id)->first();
        if ($admin->telegram) {

            $serial = Nte::whereIn('id',  $request->sn_id)->get();
            $serialNumber = "";
            foreach ($serial as $nte) {
                // $type = Str::replace('_', ' ', $nte->assetNte->name);
                $serialNumber .= '_' . $nte->assetNte->type . ' \| ' . $nte->owner . ' \| ' . $nte->serial_number . '_' . "\n"; // Assuming 'serial_number' is the column name
            }
            // change format request date to d M Y use carbon
            $date = \Carbon\Carbon::parse($request->date)->format('d F Y');

            // Remove trailing comma and space
            $serialNumber = rtrim($serialNumber, " ");
            $bot->sendMessage([
                'chat_id' => $admin->telegram,
                'parse_mode' => 'MarkdownV2',
                'text' => 'Hallo ' . $admin->name . ',' . "\n" .
                    'Berikut adalah detail TAG In NTE tanggal ' .   $date . ' :' . "\n" . "\n" .
                    'From Warehouse *' . auth()->user()->warehouse->name . '*' . "\n" . "\n" .
                    '*Jenis \| Owner \| Serial Number*' . "\n" .
                    $serialNumber .  "\n" .
                    'Silahkan cek *menu TAG In* NTE' . "\n" .
                    'Terimakasih',
            ]);
        }
        Session::flash('success', 'Transaksi berhasil');
        return redirect()->route('tag-out.nte.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionNte $transaction,)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionNte $transaction)
    {
        //
    }

    public function import(Request $request)
    {
    }
}
